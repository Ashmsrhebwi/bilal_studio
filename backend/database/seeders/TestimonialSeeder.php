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
                'name_ar'    => 'أحمد العمر',
                'name_en'    => 'Ahmad Al-Omar',
                'role_ar'    => 'رجل أعمال',
                'role_en'    => 'Businessman',
                'project_ar' => 'فيلا المشرفية — 850 م²',
                'project_en' => 'Al-Mashrifyah Villa — 850 m²',
                'text_ar'    => 'لو عرفت سرديني استوديو في وقت أبكر، لكنت وفّرت سنوات من التجارب المُخيِّبة. الفريق لا يسمع فقط ما تقوله — بل يسمع ما تقصده. فيلتي خرجت بشكل لم أكن أتخيله حتى في أحلامي، وفي حدود الميزانية المتفق عليها تماماً.',
                'text_en'    => 'Had I known about Sardini Studio earlier, I would have saved years of disappointing experiences. The team doesn\'t just hear what you say — they hear what you mean. The villa exceeded anything I had imagined, and came in exactly on the agreed budget.',
                'rating'     => 5,
                'avatar'     => 'https://randomuser.me/api/portraits/men/32.jpg',
                'is_active'  => true,
                'sort_order' => 1,
            ],
            [
                'name_ar'    => 'نور الدين حمزة',
                'name_en'    => 'Nour Al-Din Hamza',
                'role_ar'    => 'مستثمر عقاري، الإمارات',
                'role_en'    => 'Real Estate Investor, UAE',
                'project_ar' => 'مجمع الأعمال الذهبي — 4800 م²',
                'project_en' => 'Golden Business Complex — 4,800 m²',
                'text_ar'    => 'تعاملنا مع مكاتب كثيرة في الخليج، لكن ما وجدناه في سرديني كان مختلفاً: التزام حقيقي بالمواعيد، شفافية كاملة في التعامل، وتصاميم تجمع الحداثة بالهوية العربية بأسلوب نادر. المجمع التجاري الذي صمّموه لنا أصبح وجهة معمارية في المنطقة.',
                'text_en'    => 'We have worked with many firms across the Gulf, but what we found at Sardini was different: genuine commitment to deadlines, complete transparency, and designs that fuse modernity with Arabic identity in a rare way. The commercial complex they designed has become an architectural landmark in our area.',
                'rating'     => 5,
                'avatar'     => 'https://randomuser.me/api/portraits/men/45.jpg',
                'is_active'  => true,
                'sort_order' => 2,
            ],
            [
                'name_ar'    => 'ليلى المصري',
                'name_en'    => 'Layla Al-Masri',
                'role_ar'    => 'طبيبة متخصصة',
                'role_en'    => 'Specialist Physician',
                'project_ar' => 'شقة أفق — تصميم داخلي 280 م²',
                'project_en' => 'Horizon Apartment — Interior Design 280 m²',
                'text_ar'    => 'كنت خائفة من أن يأتي التصميم الداخلي بارداً أو غير شخصي. لكن المهندس بلال وفريقه أخذوا وقتهم معي لفهم شخصيتي وطريقة معيشتي. شقتي الآن هي أجمل مكان في حياتي — وكل من يزورها يسأل: من صمّمها؟',
                'text_en'    => 'I was afraid the interior design would feel cold or impersonal. But Bilal and his team took their time understanding my personality and lifestyle. My apartment is now the most beautiful place in my life — and every visitor asks: who designed this?',
                'rating'     => 5,
                'avatar'     => 'https://randomuser.me/api/portraits/women/28.jpg',
                'is_active'  => true,
                'sort_order' => 3,
            ],
            [
                'name_ar'    => 'سامر قاسم',
                'name_en'    => 'Samer Qasim',
                'role_ar'    => 'صاحب فندق، اللاذقية',
                'role_en'    => 'Hotel Owner, Lattakia',
                'project_ar' => 'فندق لؤلؤة الشرق — 40 غرفة',
                'project_en' => 'Pearl of the East Hotel — 40 Rooms',
                'text_ar'    => 'الفندق الذي صممه سرديني استوديو لم يكن مجرد مبنى — كان تجربة كاملة يشعر بها الضيف من اللحظة الأولى. ارتفعت نسبة الإشغال بشكل ملحوظ بعد الافتتاح، ونسبة كبيرة من تقييمات الضيوف على المنصات تذكر التصميم تحديداً.',
                'text_en'    => 'The hotel Sardini Studio designed wasn\'t just a building — it was a complete experience that guests feel from the very first moment. Occupancy rates rose significantly after opening, and a large proportion of guest reviews on booking platforms specifically mention the design.',
                'rating'     => 5,
                'avatar'     => 'https://randomuser.me/api/portraits/men/61.jpg',
                'is_active'  => true,
                'sort_order' => 4,
            ],
            [
                'name_ar'    => 'رنا البيطار',
                'name_en'    => 'Rana Al-Baytar',
                'role_ar'    => 'مديرة شركة إبداعية، بيروت',
                'role_en'    => 'Creative Agency Director, Beirut',
                'project_ar' => 'مكاتب وكالة إبداعية — 600 م²',
                'project_en' => 'Creative Agency Offices — 600 m²',
                'text_ar'    => 'طلبنا تصميماً لمكاتبنا الجديدة مع رغبة واضحة: بيئة عمل تُلهم الإبداع وتعكس هويتنا كشركة. ما قدّمه المكتب تجاوز كل التوقعات. الفريق يعمل بروح شراكة حقيقية — لا تشعر أنك توظّف خدمة، بل أنك تبني مع حلفاء.',
                'text_en'    => 'We asked for office space that would inspire creativity and reflect our brand identity. What Sardini Studio delivered far exceeded our expectations. The team works with a genuine spirit of partnership — you don\'t feel like you\'re hiring a service, you feel like you\'re building with allies.',
                'rating'     => 5,
                'avatar'     => 'https://randomuser.me/api/portraits/women/44.jpg',
                'is_active'  => true,
                'sort_order' => 5,
            ],
            [
                'name_ar'    => 'محمد الجراح',
                'name_en'    => 'Mohammad Al-Jarrah',
                'role_ar'    => 'مقاول إنشائي، حلب',
                'role_en'    => 'Construction Contractor, Aleppo',
                'project_ar' => 'مجمع الرافدين السكني — 8500 م²',
                'project_en' => 'Al-Rafidain Residential Complex — 8,500 m²',
                'text_ar'    => 'كمقاول، تعاملت مع مخططات كثيرة من مكاتب مختلفة. مخططات سرديني استوديو لغة في حد ذاتها — دقيقة، شاملة، وتتوقع كل سؤال قد يطرأ على الموقع. توفّر عليّ وقتاً وأموالاً حقيقية في كل مشروع عملناه معاً.',
                'text_en'    => 'As a contractor, I have worked with drawings from many different offices. Sardini Studio\'s drawings are in a league of their own — precise, comprehensive, and they anticipate every question that could arise on site. They save me real time and real money on every project we work on together.',
                'rating'     => 5,
                'avatar'     => 'https://randomuser.me/api/portraits/men/72.jpg',
                'is_active'  => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($testimonials as $t) {
            Testimonial::create($t);
        }
    }
}
