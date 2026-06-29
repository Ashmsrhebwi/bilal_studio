<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'name_ar'    => 'أحمد الخطيب',
                'name_en'    => 'Ahmad Al-Khatib',
                'role_ar'    => 'رجل أعمال',
                'role_en'    => 'Businessman',
                'project_ar' => 'فيلا المشرفية',
                'project_en' => 'Al-Mashrifyah Villa',
                'text_ar'    => 'التعاون مع سرديني استوديو كان تجربة استثنائية. الدقة في التنفيذ والالتزام بالمواعيد والاستماع لاحتياجاتنا جعل المنزل أكثر مما كنت أحلم به.',
                'text_en'    => 'Working with Sardini Studio was an exceptional experience. The precision in execution, commitment to deadlines, and attentiveness to our needs made the home more than I had dreamed of.',
                'rating'     => 5,
                'avatar'     => 'https://randomuser.me/api/portraits/men/32.jpg',
                'is_active'  => true,
                'sort_order' => 1,
            ],
            [
                'name_ar'    => 'نور الدين محمود',
                'name_en'    => 'Nour Al-Din Mahmoud',
                'role_ar'    => 'مستثمر عقاري',
                'role_en'    => 'Real Estate Investor',
                'project_ar' => 'مجمع الأعمال الذهبي',
                'project_en' => 'Golden Business Complex',
                'text_ar'    => 'المشروع التجاري كان يحتاج معمارياً يفهم طبيعة الأعمال وليس فقط الجماليات. فريق سرديني قدم الاثنين معاً بتصميم وظيفي وجميل في آنٍ واحد.',
                'text_en'    => 'The commercial project needed an architect who understands business, not just aesthetics. The Sardini team delivered both — a functional yet beautiful design.',
                'rating'     => 5,
                'avatar'     => 'https://randomuser.me/api/portraits/men/45.jpg',
                'is_active'  => true,
                'sort_order' => 2,
            ],
            [
                'name_ar'    => 'ليلى الصباغ',
                'name_en'    => 'Layla Al-Sabbagh',
                'role_ar'    => 'طبيبة',
                'role_en'    => 'Physician',
                'project_ar' => 'شقة أفق',
                'project_en' => 'Horizon Apartment',
                'text_ar'    => 'شقتنا تحولت إلى تحفة فنية بعد تدخل المصمم. كل زاوية تحكي قصة. الإضاءة والألوان والأثاث متناسقة بشكل لم أكن أتوقعه.',
                'text_en'    => 'Our apartment transformed into a work of art after the designer\'s touch. Every corner tells a story. The lighting, colors, and furniture are harmonized in a way I never expected.',
                'rating'     => 5,
                'avatar'     => 'https://randomuser.me/api/portraits/women/28.jpg',
                'is_active'  => true,
                'sort_order' => 3,
            ],
            [
                'name_ar'    => 'سامر قاسم',
                'name_en'    => 'Samer Qasim',
                'role_ar'    => 'مدير تنفيذي',
                'role_en'    => 'CEO',
                'project_ar' => 'مركز النخبة التجاري',
                'project_en' => 'Elite Commercial Center',
                'text_ar'    => 'سرديني استوديو لا يبني فقط، بل يبتكر. المركز التجاري أصبح وجهة في المنطقة بفضل التصميم الجذاب الذي استقطب أفضل العلامات التجارية.',
                'text_en'    => 'Sardini Studio doesn\'t just build — it innovates. The commercial center has become a destination in the area thanks to its attractive design that drew the best brands.',
                'rating'     => 5,
                'avatar'     => 'https://randomuser.me/api/portraits/men/61.jpg',
                'is_active'  => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($testimonials as $t) {
            Testimonial::create($t);
        }
    }
}
