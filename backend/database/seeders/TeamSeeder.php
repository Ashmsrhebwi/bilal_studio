<?php

namespace Database\Seeders;

use App\Models\ProcessStep;
use App\Models\TeamMember;
use App\Models\TimelineEvent;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    public function run(): void
    {
        // Team members
        $members = [
            [
                'name_ar'     => 'م. بلال سارديني',
                'name_en'     => 'Arch. Bilal Sardini',
                'role_ar'     => 'المؤسس والمدير التنفيذي',
                'role_en'     => 'Founder & CEO',
                'bio_ar'      => 'معماري سوري بخبرة تتجاوز 15 عاماً في التصميم المعماري والداخلي. خريج كلية الهندسة المعمارية بجامعة حلب، وحاصل على ماجستير في التصميم الحضري من جامعة برشلونة.',
                'bio_en'      => 'A Syrian architect with over 15 years of experience in architectural and interior design. Graduated from the Faculty of Architecture at the University of Aleppo, with a Master\'s in Urban Design from the University of Barcelona.',
                'photo'       => 'https://randomuser.me/api/portraits/men/40.jpg',
                'sort_order'  => 1,
                'is_active'   => true,
            ],
            [
                'name_ar'     => 'م. سارة نوري',
                'name_en'     => 'Arch. Sara Nouri',
                'role_ar'     => 'رئيسة قسم التصميم الداخلي',
                'role_en'     => 'Head of Interior Design',
                'bio_ar'      => 'متخصصة في التصميم الداخلي الفاخر مع خبرة 10 سنوات في المشاريع السكنية والفندقية. تمزج بين الأسلوب المعاصر والتراث العربي الأصيل.',
                'bio_en'      => 'Specialist in luxury interior design with 10 years of experience in residential and hospitality projects. She blends contemporary style with authentic Arab heritage.',
                'photo'      => 'https://randomuser.me/api/portraits/women/35.jpg',
                'sort_order'  => 2,
                'is_active'   => true,
            ],
            [
                'name_ar'     => 'م. خالد منصور',
                'name_en'     => 'Eng. Khaled Mansour',
                'role_ar'     => 'مهندس إشراف أول',
                'role_en'     => 'Senior Supervision Engineer',
                'bio_ar'      => 'مهندس مدني متخصص في الإشراف على تنفيذ المشاريع الكبرى مع خبرة 12 عاماً في السوق السورية والخليجية.',
                'bio_en'      => 'Civil engineer specializing in supervising major project execution with 12 years of experience in the Syrian and Gulf markets.',
                'photo'      => 'https://randomuser.me/api/portraits/men/55.jpg',
                'sort_order'  => 3,
                'is_active'   => true,
            ],
        ];

        foreach ($members as $m) {
            TeamMember::create($m);
        }

        // Timeline events
        $timeline = [
            ['year' => 2009, 'title_ar' => 'تأسيس المكتب', 'title_en' => 'Studio Founded', 'description_ar' => 'انطلق سرديني استوديو بمشروعه الأول في حلب', 'description_en' => 'Sardini Studio launched its first project in Aleppo'],
            ['year' => 2012, 'title_ar' => 'توسع في دمشق', 'title_en' => 'Damascus Expansion', 'description_ar' => 'افتتاح فرع دمشق وتوسع في المشاريع الكبرى', 'description_en' => 'Opening of Damascus branch and expansion into major projects'],
            ['year' => 2015, 'title_ar' => 'جائزة التصميم العربي', 'title_en' => 'Arab Design Award', 'description_ar' => 'الفوز بجائزة التصميم المعماري العربي عن مشروع الفندق التراثي', 'description_en' => 'Won the Arab Architectural Design Award for the heritage hotel project'],
            ['year' => 2018, 'title_ar' => 'الانطلاق الخليجي', 'title_en' => 'Gulf Expansion', 'description_ar' => 'أول مشروع في الإمارات وبدء حضور إقليمي', 'description_en' => 'First project in UAE and the beginning of regional presence'],
            ['year' => 2020, 'title_ar' => '100 مشروع منجز', 'title_en' => '100 Completed Projects', 'description_ar' => 'إتمام المشروع المئة بنجاح في ظروف استثنائية', 'description_en' => 'Successfully completed the hundredth project under exceptional circumstances'],
            ['year' => 2024, 'title_ar' => 'إطلاق الاستوديو الرقمي', 'title_en' => 'Digital Studio Launch', 'description_ar' => 'إطلاق منصة رقمية متطورة لتقديم الخدمات وعرض الأعمال', 'description_en' => 'Launch of an advanced digital platform for delivering services and showcasing work'],
        ];

        foreach ($timeline as $event) {
            TimelineEvent::create($event);
        }

        // Process steps
        $steps = [
            ['step_number' => 1, 'title_ar' => 'الاستشارة الأولية', 'title_en' => 'Initial Consultation', 'description_ar' => 'نجلس معك لفهم احتياجاتك وتطلعاتك وميزانيتك وجدولك الزمني.', 'description_en' => 'We sit with you to understand your needs, aspirations, budget, and timeline.', 'icon' => 'message-circle', 'is_active' => true],
            ['step_number' => 2, 'title_ar' => 'دراسة الموقع والبرمجة', 'title_en' => 'Site Study & Brief', 'description_ar' => 'نزور الموقع ونحلل معطياته ونضع البرنامج المعماري التفصيلي.', 'description_en' => 'We visit the site, analyze its conditions, and develop the detailed architectural brief.', 'icon' => 'map-pin', 'is_active' => true],
            ['step_number' => 3, 'title_ar' => 'التصميم المفاهيمي', 'title_en' => 'Concept Design', 'description_ar' => 'نقدم 2-3 توجهات تصميمية مختلفة للاختيار والنقاش والتطوير.', 'description_en' => 'We present 2-3 different design directions for selection, discussion, and development.', 'icon' => 'lightbulb', 'is_active' => true],
            ['step_number' => 4, 'title_ar' => 'التصميم التطويري', 'title_en' => 'Design Development', 'description_ar' => 'تطوير التصميم المختار بتفاصيل دقيقة وإعداد المخططات الكاملة.', 'description_en' => 'Developing the chosen design with precise details and preparing complete drawings.', 'icon' => 'pen-tool', 'is_active' => true],
            ['step_number' => 5, 'title_ar' => 'الرسومات التنفيذية', 'title_en' => 'Construction Drawings', 'description_ar' => 'إعداد حزمة كاملة من الرسومات التنفيذية الدقيقة جاهزة للتنفيذ.', 'description_en' => 'Preparing a complete package of precise construction drawings ready for execution.', 'icon' => 'file-text', 'is_active' => true],
            ['step_number' => 6, 'title_ar' => 'التنفيذ والمتابعة', 'title_en' => 'Execution & Follow-up', 'description_ar' => 'الإشراف على التنفيذ والمتابعة الدورية لضمان الجودة والمطابقة.', 'description_en' => 'Supervising execution and periodic follow-up to ensure quality and compliance.', 'icon' => 'hard-hat', 'is_active' => true],
        ];

        foreach ($steps as $step) {
            ProcessStep::create($step);
        }
    }
}
