<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question_ar' => 'ما هي المدة الزمنية اللازمة لإنجاز التصميم المعماري؟',
                'question_en' => 'How long does it take to complete an architectural design?',
                'answer_ar'   => 'تتراوح مدة التصميم المعماري بين 4 إلى 12 أسبوعاً حسب حجم المشروع وتعقيده. المشاريع السكنية الصغيرة تستغرق 4-6 أسابيع، بينما المشاريع التجارية الكبيرة قد تحتاج 10-12 أسبوعاً.',
                'answer_en'   => 'Architectural design timelines range from 4 to 12 weeks depending on the project size and complexity. Small residential projects take 4-6 weeks, while large commercial projects may require 10-12 weeks.',
                'is_active'   => true,
                'sort_order'  => 1,
            ],
            [
                'question_ar' => 'كيف يتم تحديد تكلفة الخدمة المعمارية؟',
                'question_en' => 'How are architectural service fees determined?',
                'answer_ar'   => 'تُحدد أتعاب التصميم بناءً على عدة عوامل: مساحة المشروع، نطاق الخدمات المطلوبة، ونوع المشروع (سكني، تجاري، فندقي). نقدم عرض سعر مفصلاً بعد الاجتماع الأولي ودراسة المشروع.',
                'answer_en'   => 'Design fees are determined based on several factors: project area, scope of required services, and project type (residential, commercial, hospitality). We provide a detailed quote after the initial meeting and project review.',
                'is_active'   => true,
                'sort_order'  => 2,
            ],
            [
                'question_ar' => 'هل تتولون الإشراف على التنفيذ أيضاً؟',
                'question_en' => 'Do you also handle construction supervision?',
                'answer_ar'   => 'نعم، نقدم خدمة الإشراف الهندسي كخدمة منفصلة أو ضمن حزمة متكاملة مع التصميم. يشمل الإشراف زيارات دورية للموقع والتأكد من تطابق التنفيذ مع المخططات.',
                'answer_en'   => 'Yes, we offer construction supervision as a standalone service or as part of a comprehensive package with design. Supervision includes periodic site visits and ensuring execution matches the drawings.',
                'is_active'   => true,
                'sort_order'  => 3,
            ],
            [
                'question_ar' => 'ما هي البرامج المستخدمة في التصميم والتصور؟',
                'question_en' => 'What software do you use for design and visualization?',
                'answer_ar'   => 'نستخدم أحدث برامج التصميم: AutoCAD وRevit للرسومات التنفيذية، و3ds Max وLumion وV-Ray للتصور الواقعي، وSketchUp للنمذجة السريعة، وAdobe Photoshop لمعالجة الصور.',
                'answer_en'   => 'We use the latest design software: AutoCAD and Revit for construction drawings, 3ds Max, Lumion, and V-Ray for photorealistic visualization, SketchUp for rapid modeling, and Adobe Photoshop for image processing.',
                'is_active'   => true,
                'sort_order'  => 4,
            ],
            [
                'question_ar' => 'هل تعملون على مشاريع خارج سوريا؟',
                'question_en' => 'Do you work on projects outside Syria?',
                'answer_ar'   => 'نعم، نقبل المشاريع من دول الخليج العربي والأردن ولبنان وسائر الدول العربية. يمكن إنجاز معظم مراحل التصميم عن بُعد مع زيارات ميدانية حسب الحاجة.',
                'answer_en'   => 'Yes, we accept projects from the Gulf countries, Jordan, Lebanon, and other Arab countries. Most design phases can be completed remotely with on-site visits as needed.',
                'is_active'   => true,
                'sort_order'  => 5,
            ],
            [
                'question_ar' => 'ما هو الحد الأدنى لمساحة المشروع الذي تقبلونه؟',
                'question_en' => 'What is the minimum project size you accept?',
                'answer_ar'   => 'لا يوجد حد أدنى ثابت للمساحة. نرحب بمشاريع تصميم الشقق الصغيرة وصولاً إلى المجمعات السكنية والتجارية الكبيرة. المعيار الأساسي هو أن يحمل المشروع قيمة إبداعية ويتناسب مع طاقتنا الإنتاجية.',
                'answer_en'   => 'There is no fixed minimum size. We welcome projects ranging from small apartment designs to large residential and commercial complexes. The key criterion is that the project carries creative value and fits our production capacity.',
                'is_active'   => true,
                'sort_order'  => 6,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
