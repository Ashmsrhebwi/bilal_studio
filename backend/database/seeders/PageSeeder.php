<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'slug'                => 'privacy-policy',
                'title_ar'            => 'سياسة الخصوصية',
                'title_en'            => 'Privacy Policy',
                'content_ar'          => '<p>نحترم خصوصيتك ونلتزم بحماية بياناتك الشخصية...</p>',
                'content_en'          => '<p>We respect your privacy and are committed to protecting your personal data...</p>',
                'meta_title_ar'       => 'سياسة الخصوصية | سرديني استوديو',
                'meta_title_en'       => 'Privacy Policy | Sardini Studio',
                'meta_description_ar' => 'سياسة الخصوصية الخاصة بموقع سرديني استوديو.',
                'meta_description_en' => 'Privacy policy for Sardini Studio website.',
                'is_active'           => true,
            ],
            [
                'slug'                => 'terms-of-service',
                'title_ar'            => 'شروط الخدمة',
                'title_en'            => 'Terms of Service',
                'content_ar'          => '<p>باستخدامك لموقعنا، أنت توافق على الشروط والأحكام التالية...</p>',
                'content_en'          => '<p>By using our website, you agree to the following terms and conditions...</p>',
                'meta_title_ar'       => 'شروط الخدمة | سرديني استوديو',
                'meta_title_en'       => 'Terms of Service | Sardini Studio',
                'meta_description_ar' => 'شروط وأحكام استخدام موقع سرديني استوديو.',
                'meta_description_en' => 'Terms and conditions for using the Sardini Studio website.',
                'is_active'           => true,
            ],
        ];

        foreach ($pages as $page) {
            Page::updateOrCreate(['slug' => $page['slug']], $page);
        }
    }
}
