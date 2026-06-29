<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::updateOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@sardinistudio.com')],
            [
                'name'     => 'Bilal Sardini',
                'email'    => env('ADMIN_EMAIL', 'admin@sardinistudio.com'),
                'password' => Hash::make(env('ADMIN_INITIAL_PASSWORD', 'Sardini@2025!')),
            ]
        );

        $this->call([
            SiteSettingSeeder::class,
            PageSeeder::class,
            ProjectCategorySeeder::class,
            ProjectSeeder::class,
            ServiceSeeder::class,
            BlogSeeder::class,
            TestimonialSeeder::class,
            PartnerSeeder::class,
            FaqSeeder::class,
            TeamSeeder::class,
        ]);
    }
}
