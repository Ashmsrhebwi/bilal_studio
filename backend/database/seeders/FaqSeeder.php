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
                'question_ar' => 'ما هي تكلفة التصميم المعماري أو الداخلي؟',
                'question_en' => 'How much does architectural or interior design cost?',
                'answer_ar'   => 'تتحدد التكلفة بناءً على ثلاثة عوامل: نوع المشروع (سكني، تجاري، فندقي)، مساحته، ومستوى التفاصيل المطلوبة. عموماً، تتراوح أتعاب التصميم بين 2% و6% من إجمالي تكلفة المشروع. نقدم عرضاً مالياً مفصلاً وشفافاً بعد الاجتماع الأولي المجاني — لا توجد أي رسوم مخفية.',
                'answer_en'   => 'Cost depends on three factors: project type (residential, commercial, hospitality), total area, and scope of detail required. Design fees typically range from 2% to 6% of the project\'s total construction cost. We provide a clear, detailed proposal after the free initial consultation — no hidden fees.',
                'is_active'   => true,
                'sort_order'  => 1,
            ],
            [
                'question_ar' => 'كم تستغرق عملية التصميم؟',
                'question_en' => 'How long does the design process take?',
                'answer_ar'   => 'تختلف المدة حسب حجم المشروع وتعقيده: المشاريع السكنية الصغيرة (200–500 م²) تستغرق عادةً 4–8 أسابيع للتصميم الكامل، والشقق والمساحات الداخلية 3–5 أسابيع، أما المشاريع التجارية والكبيرة فقد تستغرق 3–6 أشهر. نحدد الجدول الزمني بدقة في عرض العمل ونلتزم به.',
                'answer_en'   => 'Timelines vary by project size and complexity: small residential projects (200–500 m²) typically take 4–8 weeks for full design; apartments and interior spaces take 3–5 weeks; larger commercial projects may take 3–6 months. We set a precise schedule in our proposal and commit to it.',
                'is_active'   => true,
                'sort_order'  => 2,
            ],
            [
                'question_ar' => 'هل تقدمون خدماتكم خارج حلب وسوريا؟',
                'question_en' => 'Do you work outside Aleppo and Syria?',
                'answer_ar'   => 'نعم بالتأكيد. نقبل مشاريع من كافة المحافظات السورية، ومن دول الخليج العربي (الإمارات، السعودية، الكويت، قطر، البحرين، عُمان)، والأردن، ولبنان، وسائر الدول العربية وأوروبا. معظم مراحل التصميم تُنجز عن بُعد باحترافية تامة، مع زيارات ميدانية للموقع عند الضرورة.',
                'answer_en'   => 'Absolutely. We accept projects from all Syrian governorates, Gulf countries (UAE, Saudi Arabia, Kuwait, Qatar, Bahrain, Oman), Jordan, Lebanon, and throughout the Arab world and Europe. Most design phases are completed remotely with full professionalism, with on-site visits scheduled as needed.',
                'is_active'   => true,
                'sort_order'  => 3,
            ],
            [
                'question_ar' => 'ما الفرق بين المهندس المعماري ومصمم الديكور؟',
                'question_en' => 'What is the difference between an architect and an interior designer?',
                'answer_ar'   => 'المهندس المعماري متخصص في الجانب الهيكلي للمبنى: الشكل، التوزيع، الواجهات، والرسومات التنفيذية اللازمة لتراخيص البناء. مصمم الديكور يتخصص في الفراغات الداخلية: الألوان، الأثاث، الإضاءة، والتفاصيل الجمالية. في سرديني استوديو، نقدم الخدمتين معاً بشكل متكامل — وهذا يضمن تناسقاً كاملاً بين الخارج والداخل.',
                'answer_en'   => 'An architect specializes in the structural side of a building: form, layout, facades, and the technical drawings required for construction permits. An interior designer focuses on interior spaces: colors, furniture, lighting, and aesthetic details. At Sardini Studio, we offer both services in full integration — ensuring complete harmony between exterior and interior.',
                'is_active'   => true,
                'sort_order'  => 4,
            ],
            [
                'question_ar' => 'هل يمكنني رؤية مشروعي قبل البدء بالبناء؟',
                'question_en' => 'Can I see my project before construction begins?',
                'answer_ar'   => 'هذا بالضبط ما تقدمه خدمة التصور ثلاثي الأبعاد. نُنتج صوراً واقعية وجولات افتراضية تُريك مشروعك بتفاصيله الكاملة — الأثاث، الإضاءة، الألوان، المواد — قبل أي تنفيذ. هذا يمنحك حرية التعديل دون أي تكاليف إضافية في مرحلة البناء.',
                'answer_en'   => 'That is precisely what our 3D visualization service provides. We produce photorealistic still images and virtual walkthroughs showing your project in full detail — furniture, lighting, colors, materials — before any construction begins. This gives you the freedom to request changes without costly on-site alterations.',
                'is_active'   => true,
                'sort_order'  => 5,
            ],
            [
                'question_ar' => 'هل تساعدون في استخراج تراخيص البناء؟',
                'question_en' => 'Do you assist with obtaining building permits?',
                'answer_ar'   => 'نعم. نُعد الرسومات المعمارية وفق الاشتراطات البلدية المحلية المعمول بها، ونقدم الدعم الكامل لملفات طلبات الترخيص. التنسيق مع الجهات الرسمية يتم بالتعاون مع صاحب المشروع لضمان أن كل الأوراق مكتملة وصحيحة منذ البداية.',
                'answer_en'   => 'Yes. We prepare architectural drawings to comply with applicable local building codes and municipality requirements, and provide full support for the permit application package. We coordinate with official authorities in cooperation with the client to ensure all documents are complete and correct from the outset.',
                'is_active'   => true,
                'sort_order'  => 6,
            ],
            [
                'question_ar' => 'هل تُشرفون على التنفيذ بعد التصميم؟',
                'question_en' => 'Do you supervise construction after the design phase?',
                'answer_ar'   => 'نعم، نقدم خدمة الإشراف الهندسي كخدمة منفصلة أو ضمن حزمة متكاملة مع التصميم. يشمل الإشراف زيارات دورية للموقع، مراقبة الجودة، التنسيق بين المقاولين، ومراجعة المستخلصات المالية. نوصي دائماً بالجمع بين التصميم والإشراف للحصول على أفضل نتيجة.',
                'answer_en'   => 'Yes, we offer construction supervision as a standalone service or bundled with the design phase. Supervision includes regular site visits, quality control, contractor coordination, and financial claim reviews. We always recommend combining design with supervision for the best possible outcome.',
                'is_active'   => true,
                'sort_order'  => 7,
            ],
            [
                'question_ar' => 'هل يمكنني تعديل التصميم بعد الموافقة عليه؟',
                'question_en' => 'Can I modify the design after approving it?',
                'answer_ar'   => 'التعديلات جزء طبيعي من عملية التصميم التشاركية. يتضمن عقدنا جلسات مراجعة محددة في كل مرحلة (عادةً 2–3 مراجعات). التعديلات الجوهرية التي تطرأ بعد اعتماد التصميم النهائي وإطلاق الرسومات التنفيذية قد تستلزم رسوماً إضافية نتفق عليها مسبقاً وبشفافية تامة.',
                'answer_en'   => 'Revisions are a natural part of our collaborative design process. Our contract includes defined review rounds at each phase (typically 2–3 per phase). Significant changes requested after the final design is approved and construction documents are issued may incur additional fees, which we agree on in advance with full transparency.',
                'is_active'   => true,
                'sort_order'  => 8,
            ],
            [
                'question_ar' => 'ما هي أنواع المشاريع التي تتخصصون فيها؟',
                'question_en' => 'What types of projects do you specialize in?',
                'answer_ar'   => 'نتخصص في: الفيلات والمنازل السكنية الخاصة، المجمعات السكنية، المكاتب والمراكز التجارية، الفنادق البوتيكية والمطاعم، المساحات الإبداعية والتجزئة، والتصميم الداخلي للشقق والمنازل. كل مشروع يحمل طابعه الخاص بصرف النظر عن حجمه.',
                'answer_en'   => 'We specialize in: private villas and residences, residential complexes, offices and commercial centers, boutique hotels and restaurants, creative and retail spaces, and residential interior design. Every project carries its own unique character regardless of scale.',
                'is_active'   => true,
                'sort_order'  => 9,
            ],
            [
                'question_ar' => 'كيف أبدأ؟ ما هي الخطوة الأولى؟',
                'question_en' => 'How do I get started? What\'s the first step?',
                'answer_ar'   => 'ببساطة، تواصل معنا عبر نموذج الاتصال أو الواتساب أو الهاتف. سنحدد موعداً لاجتماع أولي مجاني (حضورياً في مكتبنا بحلب أو عبر الإنترنت) نستمع فيه إلى مشروعك ونُقدم لك رؤيتنا المبدئية. لا يوجد أي التزام في هذه المرحلة — مجرد حوار مفتوح.',
                'answer_en'   => 'Simply reach out via our contact form, WhatsApp, or phone. We\'ll schedule a free initial meeting — in person at our Aleppo office or online — where we listen to your project and share our initial thoughts. No commitment at this stage, just an open conversation.',
                'is_active'   => true,
                'sort_order'  => 10,
            ],
            [
                'question_ar' => 'ماذا أُحضر للاجتماع الأول؟',
                'question_en' => 'What should I bring to the first meeting?',
                'answer_ar'   => 'كلما أحضرت أكثر كان أفضل — لكن لا يوجد شيء إلزامي. إن وُجدت: وثائق الأرض أو الملكية، صور إلهام (Pinterest وغيرها)، فكرة تقريبية عن الميزانية والجدول الزمني. لا تقلق إن لم يكن لديك أي شيء — نبدأ من الصفر بكل ترحيب وهذا يحدث كثيراً.',
                'answer_en'   => 'Bring as much as you have — nothing is mandatory. Helpful items include: property documents if available, inspiration images (Pinterest, etc.), and a rough sense of budget and timeline. Don\'t worry if you have nothing prepared — we start from scratch all the time, and that\'s perfectly fine.',
                'is_active'   => true,
                'sort_order'  => 11,
            ],
            [
                'question_ar' => 'هل تقدمون ضماناً على جودة التصميم والتنفيذ؟',
                'question_en' => 'Do you offer any guarantee on design quality and execution?',
                'answer_ar'   => 'نعم. التزامنا بالجودة يظهر في كل مرحلة: نُقدّم رسومات دقيقة كاملة تُقلل الأخطاء، ونتابع التنفيذ بانتظام، ونبقى متاحين للاستفسارات حتى بعد التسليم. سمعتنا هي أثمن ما نملك — لذا نتعامل مع كل مشروع وكأنه مشروعنا الشخصي.',
                'answer_en'   => 'Yes. Our commitment to quality shows at every stage: we deliver precise, complete drawings that minimize errors; we supervise execution regularly; and we remain available for questions even after handover. Our reputation is our most valuable asset — so we treat every project as if it were our own.',
                'is_active'   => true,
                'sort_order'  => 12,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
