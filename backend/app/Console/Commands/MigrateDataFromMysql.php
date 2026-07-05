<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MigrateDataFromMysql extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:migrate-data-from-mysql';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate real data from old MySQL database to the new PostgreSQL database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting data migration from MySQL to PostgreSQL...');

        // Verify connections
        try {
            DB::connection('mysql_old')->getPdo();
            $this->info('Successfully connected to mysql_old.');
        } catch (\Exception $e) {
            $this->error('Could not connect to mysql_old: ' . $e->getMessage());
            return;
        }

        try {
            DB::connection('pgsql')->getPdo();
            $this->info('Successfully connected to pgsql.');
        } catch (\Exception $e) {
            $this->error('Could not connect to pgsql: ' . $e->getMessage());
            return;
        }

        // Table copying order (Independent first, then dependent)
        $tables = [
            'users',
            'cache',
            'cache_locks',
            'jobs',
            'job_batches',
            'failed_jobs',
            'personal_access_tokens',
            'admin_otp',
            'project_categories',
            'services',
            'blog_categories',
            'testimonials',
            'partners',
            'faqs',
            'contact_messages',
            'consultation_requests',
            'team_members',
            'timeline_events',
            'our_process',
            'site_settings',
            'pages',
            'media_library',
            'newsletter_subscribers',
            'projects', // depends on project_categories
            'blog_posts', // depends on blog_categories
        ];

        // Ensure we disable foreign keys in pgsql temporarily to avoid any constraint issues
        $this->info('Disabling foreign key constraints on PostgreSQL...');
        DB::connection('pgsql')->statement('SET session_replication_role = \'replica\';');

        $report = [];

        foreach ($tables as $table) {
            $this->info("Migrating table: {$table}");
            
            try {
                // Check if table exists in old db
                if (!Schema::connection('mysql_old')->hasTable($table)) {
                    $this->warn("Table {$table} does not exist in MySQL. Skipping.");
                    $report[$table] = ['status' => 'skipped', 'count' => 0];
                    continue;
                }

                $rows = DB::connection('mysql_old')->table($table)->get();
                $count = 0;

                // Disable constraint check for specific transaction if needed, but session_replication_role should cover it
                DB::connection('pgsql')->beginTransaction();

                // Delete existing records to avoid duplicate key errors if ran multiple times
                DB::connection('pgsql')->table($table)->delete();

                // Insert in chunks to avoid memory issues
                $chunks = $rows->chunk(500);

                // Find boolean columns in PostgreSQL for this table
                $boolColumns = collect(DB::connection('pgsql')->select("
                    SELECT column_name 
                    FROM information_schema.columns 
                    WHERE table_schema = 'public' 
                      AND table_name = ? 
                      AND data_type = 'boolean'
                ", [$table]))->pluck('column_name')->toArray();

                foreach ($chunks as $chunk) {
                    $insertData = [];
                    foreach ($chunk as $row) {
                        $rowData = (array) $row;
                        
                        // Cast boolean columns
                        foreach ($boolColumns as $boolCol) {
                            if (array_key_exists($boolCol, $rowData) && $rowData[$boolCol] !== null) {
                                $rowData[$boolCol] = (bool) $rowData[$boolCol];
                            }
                        }
                        
                        $insertData[] = $rowData;
                    }
                    DB::connection('pgsql')->table($table)->insert($insertData);
                    $count += count($insertData);
                }

                DB::connection('pgsql')->commit();

                // Update PostgreSQL sequence if table has 'id' column
                if (Schema::connection('pgsql')->hasColumn($table, 'id')) {
                    $maxId = DB::connection('pgsql')->table($table)->max('id') ?? 0;
                    if ($maxId > 0) {
                        DB::connection('pgsql')->statement("SELECT setval(pg_get_serial_sequence('{$table}', 'id'), {$maxId})");
                    }
                }

                $this->info("Successfully migrated {$count} rows for {$table}.");
                $report[$table] = ['status' => 'success', 'count' => $count];
            } catch (\Exception $e) {
                DB::connection('pgsql')->rollBack();
                $this->error("Failed to migrate table {$table}: " . $e->getMessage());
                $report[$table] = ['status' => 'failed', 'count' => 0, 'error' => $e->getMessage()];
            }
        }

        // Re-enable foreign keys
        $this->info('Re-enabling foreign key constraints on PostgreSQL...');
        DB::connection('pgsql')->statement('SET session_replication_role = \'origin\';');

        // Print final report
        $this->info("\n--- Migration Report ---");
        foreach ($report as $table => $data) {
            if ($data['status'] === 'success') {
                $this->line("<fg=green>{$table}: Migrated {$data['count']} rows.</>");
            } elseif ($data['status'] === 'skipped') {
                $this->line("<fg=yellow>{$table}: Skipped (not found).</>");
            } else {
                $this->line("<fg=red>{$table}: Failed - {$data['error']}</>");
            }
        }
        $this->info("------------------------\n");
    }
}
