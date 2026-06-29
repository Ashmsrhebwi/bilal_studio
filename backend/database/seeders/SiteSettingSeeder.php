<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General
            ['group' => 'general', 'key' => 'site_name_ar', 'value' => 'سرديني استوديو', 'type' => 'string', 'label' => 'اسم الموقع (عربي)'],
            ['group' => 'general', 'key' => 'site_name_en', 'value' => 'Sardini Studio', 'type' => 'string', 'label' => 'Site Name (English)'],
            ['group' => 'general', 'key' => 'tagline_ar', 'value' => 'نصمم المستقبل', 'type' => 'string', 'label' => 'الشعار (عربي)'],
            ['group' => 'general', 'key' => 'tagline_en', 'value' => 'We Design the Future', 'type' => 'string', 'label' => 'Tagline (English)'],
            ['group' => 'general', 'key' => 'logo', 'value' => '', 'type' => 'string', 'label' => 'الشعار'],
            ['group' => 'general', 'key' => 'favicon', 'value' => '', 'type' => 'string', 'label' => 'أيقونة المتصفح'],

            // Contact
            ['group' => 'contact', 'key' => 'phone', 'value' => '+963991234567', 'type' => 'string', 'label' => 'رقم الهاتف'],
            ['group' => 'contact', 'key' => 'whatsapp', 'value' => '963991234567', 'type' => 'string', 'label' => 'واتساب'],
            ['group' => 'contact', 'key' => 'email', 'value' => 'info@sardinistudio.com', 'type' => 'string', 'label' => 'البريد الإلكتروني'],
            ['group' => 'contact', 'key' => 'address_ar', 'value' => 'حلب، سوريا – شارع المتنبي، بناء رقم 14', 'type' => 'string', 'label' => 'العنوان (عربي)'],
            ['group' => 'contact', 'key' => 'address_en', 'value' => 'Aleppo, Syria – Al-Mutanabbi St., Building 14', 'type' => 'string', 'label' => 'Address (English)'],
            ['group' => 'contact', 'key' => 'google_maps_url', 'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d105003.16451374!2d36.98955!3d36.20257!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1526eff34f5e1beb%3A0x7e11dcc0f72e5fc8!2sAleppo!5e0!3m2!1sen!2ssy!4v1234567890', 'type' => 'string', 'label' => 'رابط خريطة غوغل'],

            // Social
            ['group' => 'social', 'key' => 'instagram', 'value' => 'https://instagram.com/sardinistudio', 'type' => 'string', 'label' => 'انستغرام'],
            ['group' => 'social', 'key' => 'facebook', 'value' => 'https://facebook.com/sardinistudio', 'type' => 'string', 'label' => 'فيسبوك'],
            ['group' => 'social', 'key' => 'linkedin', 'value' => 'https://linkedin.com/company/sardinistudio', 'type' => 'string', 'label' => 'لينكدإن'],
            ['group' => 'social', 'key' => 'youtube', 'value' => '', 'type' => 'string', 'label' => 'يوتيوب'],

            // Stats
            ['group' => 'stats', 'key' => 'projects_count', 'value' => '150', 'type' => 'string', 'label' => 'عدد المشاريع'],
            ['group' => 'stats', 'key' => 'years_experience', 'value' => '15', 'type' => 'string', 'label' => 'سنوات الخبرة'],
            ['group' => 'stats', 'key' => 'clients_count', 'value' => '120', 'type' => 'string', 'label' => 'عدد العملاء'],
            ['group' => 'stats', 'key' => 'countries_count', 'value' => '5', 'type' => 'string', 'label' => 'عدد الدول'],

            // SEO
            ['group' => 'seo', 'key' => 'meta_title_ar', 'value' => 'سرديني استوديو | مكتب هندسي معماري', 'type' => 'string', 'label' => 'عنوان الصفحة الرئيسية (عربي)'],
            ['group' => 'seo', 'key' => 'meta_title_en', 'value' => 'Sardini Studio | Architectural Design Office', 'type' => 'string', 'label' => 'Meta Title (English)'],
            ['group' => 'seo', 'key' => 'meta_description_ar', 'value' => 'سرديني استوديو للتصميم المعماري والداخلي في سوريا. نحول أفكارك إلى مبانٍ استثنائية.', 'type' => 'string', 'label' => 'وصف الصفحة (عربي)'],
            ['group' => 'seo', 'key' => 'meta_description_en', 'value' => 'Sardini Studio for architectural and interior design in Syria. We turn your ideas into exceptional buildings.', 'type' => 'string', 'label' => 'Meta Description (English)'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
