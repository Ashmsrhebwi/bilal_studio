<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name_ar'        => 'التصميم المعماري',
                'name_en'        => 'Architectural Design',
                'slug'           => 'architectural-design',
                'description_ar' => 'نصمم مبانيك من الفكرة إلى الرسومات التنفيذية بأسلوب معاصر يحترم الهوية المحلية.',
                'description_en' => 'We design your buildings from concept to construction drawings in a contemporary style that respects local identity.',
                'details_ar'     => 'يشمل هذا الخدمة التصميم المعماري الكامل بدءاً من المخطط الأولي والمفهوم التصميمي، مروراً بالرسومات المعمارية الكاملة، وصولاً إلى الرسومات التنفيذية الدقيقة. نعمل بأحدث برامج التصميم ثلاثي الأبعاد لتقديم رؤية واضحة للمشروع قبل تنفيذه.',
                'details_en'     => 'This service includes full architectural design starting from the initial concept and design idea, through complete architectural drawings, to detailed construction drawings. We work with the latest 3D design software to provide a clear vision of the project before execution.',
                'icon'           => 'pencil-ruler',
                'sort_order'     => 1,
                'is_active'      => true,
            ],
            [
                'name_ar'        => 'التصميم الداخلي',
                'name_en'        => 'Interior Design',
                'slug'           => 'interior-design',
                'description_ar' => 'نحول الفراغات الداخلية إلى بيئات جمالية وظيفية تعكس شخصيتك وأسلوب حياتك.',
                'description_en' => 'We transform interior spaces into aesthetic and functional environments that reflect your personality and lifestyle.',
                'details_ar'     => 'خدمة التصميم الداخلي الشاملة تتضمن: مخططات الأرضيات والتوزيع، تصميم السقوف والإضاءة، اختيار الألوان والمواد والأثاث، تصميم المطابخ والحمامات، والإشراف على التنفيذ لضمان المطابقة التامة للتصميم.',
                'details_en'     => 'Our comprehensive interior design service includes: floor plans and layout, ceiling and lighting design, color and material selection, furniture selection, kitchen and bathroom design, and execution supervision to ensure full compliance with the design.',
                'icon'           => 'sofa',
                'sort_order'     => 2,
                'is_active'      => true,
            ],
            [
                'name_ar'        => 'الإشراف على التنفيذ',
                'name_en'        => 'Construction Supervision',
                'slug'           => 'construction-supervision',
                'description_ar' => 'نضمن تنفيذ مشروعك بدقة عالية وفق المخططات المعتمدة مع ضبط الجودة والجدول الزمني.',
                'description_en' => 'We ensure your project is executed with high precision according to approved plans while controlling quality and schedule.',
                'details_ar'     => 'يشمل الإشراف الهندسي متابعة دورية لموقع العمل، التحقق من مطابقة التنفيذ للمخططات، الإشراف على المقاولين والمقاولين الفرعيين، إعداد تقارير دورية، ومراجعة المستخلصات المالية.',
                'details_en'     => 'Construction supervision includes periodic site visits, verifying compliance with drawings, overseeing contractors and subcontractors, preparing periodic reports, and reviewing financial claims.',
                'icon'           => 'hard-hat',
                'sort_order'     => 3,
                'is_active'      => true,
            ],
            [
                'name_ar'        => 'تصميم المناظر الطبيعية',
                'name_en'        => 'Landscape Design',
                'slug'           => 'landscape-design',
                'description_ar' => 'نصمم الفراغات الخارجية والحدائق لتكون امتداداً طبيعياً وجمالياً للمبنى.',
                'description_en' => 'We design outdoor spaces and gardens to be a natural and aesthetic extension of the building.',
                'details_ar'     => 'تشمل الخدمة: تصميم الحدائق والمسابح، اختيار النباتات الملائمة للمناخ، تصميم أنظمة الري الذكية، تصميم عناصر المياه والشلالات، وتصميم الإضاءة الخارجية.',
                'details_en'     => 'The service includes: garden and pool design, selection of climate-appropriate plants, smart irrigation system design, water feature and waterfall design, and outdoor lighting design.',
                'icon'           => 'trees',
                'sort_order'     => 4,
                'is_active'      => true,
            ],
            [
                'name_ar'        => 'الاستشارات الهندسية',
                'name_en'        => 'Engineering Consultancy',
                'slug'           => 'engineering-consultancy',
                'description_ar' => 'نقدم الرأي الهندسي المتخصص في مراحل مختلفة من المشروع لاتخاذ قرارات صحيحة.',
                'description_en' => 'We provide specialized engineering expertise at various project stages to support sound decision-making.',
                'details_ar'     => 'تشمل الاستشارات: دراسة الجدوى المعمارية، مراجعة وتدقيق المخططات، استشارات سابقة للشراء العقاري، تقييم المباني القائمة، ووضع الاشتراطات الفنية للمناقصات.',
                'details_en'     => 'Consultancy includes: architectural feasibility studies, drawing review and auditing, pre-purchase property consultancy, existing building assessment, and technical specifications for tenders.',
                'icon'           => 'clipboard-list',
                'sort_order'     => 5,
                'is_active'      => true,
            ],
            [
                'name_ar'        => 'نمذجة ثلاثية الأبعاد وتصور',
                'name_en'        => '3D Modeling & Visualization',
                'slug'           => '3d-modeling-visualization',
                'description_ar' => 'نقدم نماذج ثلاثية الأبعاد فوتوواقعية تتيح لك رؤية مشروعك بوضوح قبل البدء بالتنفيذ.',
                'description_en' => 'We provide photorealistic 3D models that let you see your project clearly before construction begins.',
                'details_ar'     => 'تشمل الخدمة: نماذج ثلاثية الأبعاد خارجية وداخلية، جولات افتراضية تفاعلية، تصور ضوء طبيعي وصناعي، ورسوم متحركة للتسويق العقاري.',
                'details_en'     => 'The service includes: exterior and interior 3D models, interactive virtual tours, natural and artificial lighting visualization, and marketing animations.',
                'icon'           => 'box',
                'sort_order'     => 6,
                'is_active'      => true,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(['slug' => $service['slug']], $service);
        }
    }
}
