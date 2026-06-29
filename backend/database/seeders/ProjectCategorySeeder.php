<?php

namespace Database\Seeders;

use App\Models\ProjectCategory;
use Illuminate\Database\Seeder;

class ProjectCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name_ar' => 'مساكن', 'name_en' => 'Residential', 'slug' => 'residential', 'icon' => 'home', 'sort_order' => 1],
            ['name_ar' => 'تجاري', 'name_en' => 'Commercial', 'slug' => 'commercial', 'icon' => 'building-2', 'sort_order' => 2],
            ['name_ar' => 'ضيافة وفنادق', 'name_en' => 'Hospitality', 'slug' => 'hospitality', 'icon' => 'hotel', 'sort_order' => 3],
            ['name_ar' => 'تصميم داخلي', 'name_en' => 'Interior Design', 'slug' => 'interior', 'icon' => 'sofa', 'sort_order' => 4],
            ['name_ar' => 'تطوير عقاري', 'name_en' => 'Real Estate', 'slug' => 'real-estate', 'icon' => 'landmark', 'sort_order' => 5],
        ];

        foreach ($categories as $cat) {
            ProjectCategory::updateOrCreate(['slug' => $cat['slug']], $cat);
        }
    }
}
