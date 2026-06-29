<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        $partners = [
            ['name' => 'شركة الأمل للمقاولات', 'logo' => '', 'website_url' => '', 'sort_order' => 1, 'is_active' => true],
            ['name' => 'مؤسسة الشروق للمواد', 'logo' => '', 'website_url' => '', 'sort_order' => 2, 'is_active' => true],
            ['name' => 'مجموعة البنيان العقارية', 'logo' => '', 'website_url' => '', 'sort_order' => 3, 'is_active' => true],
            ['name' => 'شركة التقنية للديكور', 'logo' => '', 'website_url' => '', 'sort_order' => 4, 'is_active' => true],
            ['name' => 'مؤسسة الرافدين للحديد', 'logo' => '', 'website_url' => '', 'sort_order' => 5, 'is_active' => true],
            ['name' => 'مجموعة الفجر للاستثمار', 'logo' => '', 'website_url' => '', 'sort_order' => 6, 'is_active' => true],
        ];

        foreach ($partners as $p) {
            Partner::create($p);
        }
    }
}
