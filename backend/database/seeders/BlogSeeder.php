<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name_ar' => 'نصائح معمارية', 'name_en' => 'Architecture Tips', 'slug' => 'architecture-tips', 'sort_order' => 1, 'is_active' => true],
            ['name_ar' => 'تصميم داخلي', 'name_en' => 'Interior Design', 'slug' => 'interior-design', 'sort_order' => 2, 'is_active' => true],
            ['name_ar' => 'اتجاهات وإلهام', 'name_en' => 'Trends & Inspiration', 'slug' => 'trends-inspiration', 'sort_order' => 3, 'is_active' => true],
        ];

        foreach ($categories as $cat) {
            BlogCategory::updateOrCreate(['slug' => $cat['slug']], $cat);
        }

        $archTips = BlogCategory::where('slug', 'architecture-tips')->first()?->id;
        $interior = BlogCategory::where('slug', 'interior-design')->first()?->id;
        $trends   = BlogCategory::where('slug', 'trends-inspiration')->first()?->id;

        $posts = [
            [
                'category_id'    => $archTips,
                'title_ar'       => '5 أخطاء شائعة في التخطيط المعماري وكيف تتجنبها',
                'title_en'       => '5 Common Architectural Planning Mistakes and How to Avoid Them',
                'slug'           => '5-common-architectural-planning-mistakes',
                'excerpt_ar'     => 'التخطيط المعماري عملية دقيقة تتطلب دراسة متأنية. نستعرض أبرز الأخطاء التي يقع فيها كثيرون وكيف يمكن تفاديها منذ البداية.',
                'excerpt_en'     => 'Architectural planning is a delicate process requiring careful study. We review the most common mistakes and how to avoid them from the start.',
                'content_ar'     => '<p>التخطيط المعماري الجيد هو الأساس لأي مشروع ناجح...</p><h2>1. إهمال دراسة الموقع</h2><p>كثيرٌ من المشاريع تبدأ بمخططات جاهزة دون مراعاة خصوصية الموقع من حيث الاتجاهات والمناخ والمحيط.</p><h2>2. التقليل من أهمية الميزانية التفصيلية</h2><p>وضع ميزانية تقريبية يؤدي إلى مفاجآت مكلفة في مرحلة التنفيذ.</p>',
                'content_en'     => '<p>Good architectural planning is the foundation of any successful project...</p><h2>1. Neglecting Site Analysis</h2><p>Many projects start with ready-made plans without considering site specifics such as orientation, climate, and surroundings.</p><h2>2. Underestimating Detailed Budgeting</h2><p>Rough budgeting leads to costly surprises during execution.</p>',
                'cover_image'    => 'https://images.unsplash.com/photo-1503387762-592deb58ef4e?w=1200',
                'author_ar'      => 'م. بلال سارديني',
                'author_en'      => 'Arch. Bilal Sardini',
                'read_time'      => 6,
                'status'         => 'published',
                'published_at'   => now()->subDays(5),
                'featured'       => true,
                'views'          => 142,
            ],
            [
                'category_id'    => $interior,
                'title_ar'       => 'كيف تختار الألوان المناسبة لغرفة المعيشة',
                'title_en'       => 'How to Choose the Right Colors for Your Living Room',
                'slug'           => 'choose-right-colors-living-room',
                'excerpt_ar'     => 'الألوان تؤثر بشكل مباشر على مزاجنا وإحساسنا بالمكان. دليل عملي لاختيار لوحة ألوان متناسقة لغرفة المعيشة.',
                'excerpt_en'     => 'Colors directly influence our mood and sense of place. A practical guide to choosing a harmonious color palette for your living room.',
                'content_ar'     => '<p>اختيار الألوان من أكثر القرارات تأثيراً في التصميم الداخلي...</p><h2>فهم نظرية الألوان</h2><p>الدائرة اللونية أساس كل قرار لوني ناجح. الألوان المتجاورة تعطي انسجاماً، والمتقابلة تعطي تباينًا حيوياً.</p>',
                'content_en'     => '<p>Color selection is one of the most impactful decisions in interior design...</p><h2>Understanding Color Theory</h2><p>The color wheel is the foundation of every successful color decision. Adjacent colors create harmony, while complementary colors create dynamic contrast.</p>',
                'cover_image'    => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=1200',
                'author_ar'      => 'م. بلال سارديني',
                'author_en'      => 'Arch. Bilal Sardini',
                'read_time'      => 5,
                'status'         => 'published',
                'published_at'   => now()->subDays(12),
                'featured'       => false,
                'views'          => 98,
            ],
            [
                'category_id'    => $trends,
                'title_ar'       => 'اتجاهات التصميم المعماري في 2025',
                'title_en'       => 'Architectural Design Trends in 2025',
                'slug'           => 'architectural-design-trends-2025',
                'excerpt_ar'     => 'يشهد عالم العمارة تحولات جذرية نحو الاستدامة والتكامل مع الطبيعة. نرصد أبرز اتجاهات 2025.',
                'excerpt_en'     => 'The world of architecture is witnessing radical shifts toward sustainability and integration with nature. We highlight the top trends of 2025.',
                'content_ar'     => '<p>عام 2025 يحمل معه ثورة هادئة في عالم التصميم...</p><h2>البيوفيليك ديزاين</h2><p>دمج الطبيعة في قلب المباني لم يعد خياراً بل ضرورة. نوافذ كبيرة وجدران خضراء وإضاءة طبيعية.</p><h2>المواد المستدامة</h2><p>الطوب المعاد تدويره، الخشب المستدام، والرخام المصنوع من إعادة التدوير.</p>',
                'content_en'     => '<p>2025 brings a quiet revolution to the world of design...</p><h2>Biophilic Design</h2><p>Integrating nature into the heart of buildings is no longer optional but necessary. Large windows, green walls, and natural lighting.</p><h2>Sustainable Materials</h2><p>Recycled brick, sustainable wood, and recycled marble.</p>',
                'cover_image'    => 'https://images.unsplash.com/photo-1518780664697-55e3ad937233?w=1200',
                'author_ar'      => 'م. بلال سارديني',
                'author_en'      => 'Arch. Bilal Sardini',
                'read_time'      => 7,
                'status'         => 'published',
                'published_at'   => now()->subDays(20),
                'featured'       => true,
                'views'          => 215,
            ],
        ];

        foreach ($posts as $post) {
            BlogPost::updateOrCreate(['slug' => $post['slug']], $post);
        }
    }
}
