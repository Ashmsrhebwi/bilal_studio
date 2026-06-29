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

            // Article 1
            [
                'category_id'          => $trends,
                'title_ar'             => 'اتجاهات التصميم الداخلي في 2026: ما الذي سيغزو منازلنا هذا العام؟',
                'title_en'             => 'Interior Design Trends 2026: What Is Shaping Our Homes This Year?',
                'slug'                 => 'interior-design-trends-2026',
                'excerpt_ar'           => 'كل عام يأتي بلغته التصميمية الخاصة. 2026 يحمل تحولاً حقيقياً نحو الدفء والطبيعة والمواد الأصيلة. إليك أبرز ما ستراه في المنازل والمساحات الراقية.',
                'excerpt_en'           => 'Every year arrives with its own design language. 2026 brings a genuine shift toward warmth, nature, and authentic materials. Here are the top trends you\'ll see in homes and refined spaces.',
                'content_ar'           => '<p>كل عام يأتي بلغته التصميمية الخاصة — ألوانه، مواده، فلسفته. وعام 2026 لا يشذّ عن هذه القاعدة، بل يحمل معه تحولاً حقيقياً في مفهومنا للمساحة الداخلية. لم يعد الديكور مجرد زخرفة؛ أصبح بياناً عن طريقة عيشنا، قيمنا، وعلاقتنا بالعالم من حولنا.</p>

<h2>1. البيوفيليك ديزاين — الطبيعة في قلب المنزل</h2>
<p>لم يعد إحضار الطبيعة إلى الداخل مجرد تزيين بالنباتات. يتجلى هذا الاتجاه في 2026 بشكل أعمق: جدران خضراء حية، نوافذ بانورامية تستحضر المناظر الطبيعية، مواد عضوية كالخشب غير المصقول والحجر الطبيعي، وأنظمة إضاءة تحاكي الضوء الطبيعي. الهدف ليس الجمال وحده — بل خلق بيئة تقلل التوتر وتُعزز الصحة النفسية.</p>

<h2>2. الألوان الأرضية الدافئة</h2>
<p>وداعاً للأبيض البارد الصارم. عام 2026 يُعيد الاعتبار للألوان الترابية: البيج الدافئ، الرملي المُذهَّب، الأخضر الزيتوني، الطين المحترق. هذه الألوان تخلق أجواء دافئة وإنسانية، وتتناسق بشكل مثالي مع المواد الطبيعية وتضفي على الفضاء عمقاً بصرياً حقيقياً.</p>

<h2>3. الأثاث الضخم المريح — Soft Luxury</h2>
<p>نرى نهاية الأثاث الزجاجي الهشّ، وصعوداً واضحاً للأثاث الضخم ذي الحشوات السخية: الكراسي المُستديرة الأطراف، الأرائك العميقة بأقمشة المخمل والكتان، وطاولات القهوة المصنوعة من الرخام الطبيعي. الرفاهية هنا تُقاس بالراحة الحسية قبل أن تُقاس بالسعر.</p>

<h2>4. الإضاءة كعنصر تصميمي لا خدمي</h2>
<p>تحوّلت الإضاءة من كونها مجرد "إنارة" إلى عنصر معماري مستقل. في 2026، نرى تركيبات إضاءة مخصصة تُعامَل كأعمال فنية، إضاءة غير مباشرة (Cove Lighting) تُعزز المزاج، وتكنولوجيا LED ذكية تُغيّر درجة الحرارة اللونية وفق وقت اليوم لتدعم الإيقاع البيولوجي الطبيعي.</p>

<h2>5. المساحات متعددة الوظائف</h2>
<p>منذ انتشار ثقافة العمل عن بُعد، أصبح المنزل مكتباً ومدرسة وصالة رياضة في آنٍ واحد. التصميم الذكي في 2026 يُحوّل هذا التحدي إلى فرصة: خزائن تتحول إلى مكاتب، قواطع متحركة تُعيد تشكيل الفراغ، وتفاصيل وظيفية مخفية في ثنايا تصميم راقٍ لا يُوحي بأي عبء.</p>

<h2>خاتمة</h2>
<p>أجمل ما في اتجاهات 2026 أنها لا تتعارض مع الشخصية — بل تُعزّزها. سواء كنت تُحب الأسلوب المعاصر الصارم أو الدفء الكلاسيكي، ستجد في هذه الاتجاهات ما يُلهمك. في سرديني استوديو، نساعدك على ترجمة هذا الإلهام إلى مساحة تعيش فيها حقاً.</p>',
                'content_en'           => '<p>Every year arrives with its own design language — its colors, materials, and philosophy. 2026 is no exception; it carries a genuine shift in how we conceive interior space. Design is no longer mere decoration — it has become a statement about how we live, what we value, and how we relate to the world around us.</p>

<h2>1. Biophilic Design — Nature at the Heart of the Home</h2>
<p>Bringing nature indoors has moved far beyond placing a few houseplants on a shelf. In 2026, biophilic design manifests more deeply: living green walls, panoramic windows that frame the natural landscape, organic materials such as unfinished wood and natural stone, and lighting systems that simulate natural daylight patterns. The goal is not beauty alone — it is creating an environment that reduces stress and supports mental well-being.</p>

<h2>2. Warm Earth Tones</h2>
<p>The era of harsh clinical white is giving way to warm earthy palettes: warm beige, golden sand, olive green, and burnt clay. These colors create humane, inviting atmospheres, pair beautifully with natural materials, and give spaces genuine visual depth that cool neutrals simply cannot achieve.</p>

<h2>3. Plush, Comfortable Furniture — Soft Luxury</h2>
<p>The era of fragile glass and chrome furniture is closing, replaced by generously proportioned upholstered pieces: round-edged armchairs, deep sofas in velvet and linen, and coffee tables in raw natural marble. In this aesthetic, luxury is measured by sensory comfort before price.</p>

<h2>4. Lighting as Architecture, Not Just Illumination</h2>
<p>Lighting has transformed from a functional service into an independent architectural element. In 2026, we see custom lighting fixtures treated as sculptural art pieces, indirect cove lighting that shifts the mood of a room, and smart LED technology that adjusts color temperature throughout the day to support the body\'s natural circadian rhythm.</p>

<h2>5. Multi-functional Spaces</h2>
<p>Since the rise of remote work culture, the home has become office, school, and gym simultaneously. Smart 2026 design turns this challenge into opportunity: cabinets that transform into desks, movable partitions that reshape the floor plan, and functional details concealed within an elegant design that carries no sense of burden.</p>

<h2>Conclusion</h2>
<p>The best thing about 2026 trends is that they enhance personality rather than compete with it. Whether you love clean contemporary lines or warm classic richness, you will find inspiration within these directions. At Sardini Studio, we help you translate that inspiration into a space where you truly live.</p>',
                'cover_image'          => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=1200',
                'author_ar'            => 'م. بلال سارديني',
                'author_en'            => 'Arch. Bilal Sardini',
                'read_time'            => 7,
                'status'               => 'published',
                'published_at'         => now()->subDays(3),
                'featured'             => true,
                'views'                => 312,
                'meta_title_ar'        => 'اتجاهات التصميم الداخلي 2026 | سرديني استوديو حلب',
                'meta_title_en'        => 'Interior Design Trends 2026 | Sardini Studio',
                'meta_description_ar'  => 'اكتشف أبرز اتجاهات الديكور الداخلي لعام 2026 — البيوفيليك، الألوان الدافئة، الأثاث الفاخر، والإضاءة الذكية. دليل شامل من سرديني استوديو.',
                'meta_description_en'  => 'Discover the top interior design trends of 2026 — biophilic design, warm earth tones, soft luxury furniture, and smart lighting. A complete guide from Sardini Studio.',
            ],

            // Article 2
            [
                'category_id'          => $interior,
                'title_ar'             => 'كيف تختار ألوان منزلك؟ — دليل عملي من مصمم معماري',
                'title_en'             => 'How to Choose Colors for Your Home — A Practical Guide from an Architect',
                'slug'                 => 'how-to-choose-home-colors',
                'excerpt_ar'           => 'اللون أقوى أدوات التصميم الداخلي — وأكثرها إرباكاً عند الاختيار. هذا الدليل يأخذك خطوة بخطوة عبر منهجية المصممين المحترفين لاختيار الألوان الصحيحة.',
                'excerpt_en'           => 'Color is the most powerful — and most confusing — tool in interior design. This guide takes you step by step through the professional designer\'s approach to choosing the right colors for every room.',
                'content_ar'           => '<p>اللون أقوى أدوات التصميم الداخلي — وأكثرها إرباكاً للناس عند اختياره. كم مرة وقفت أمام عيّنات الطلاء تحسّ بالتيه التام؟ الحقيقة أن اختيار الألوان ليس مسألة ذوق عشوائي — بل علم وفن في آنٍ واحد.</p>

<h2>أولاً: ابدأ من المشاعر، لا من العيّنات</h2>
<p>قبل أن تفتح أي كتالوج، اسأل نفسك: كيف أريد أن أشعر في هذه الغرفة؟ هادئاً؟ متحمساً؟ دافئاً؟ رسمياً؟ كل مشاعر لها ألوانها: الهدوء يجده الناس في الأزرق الرمادي والأخضر الحكيمي والبيج الدافئ. الحيوية والطاقة في الأصفر الدافئ والبرتقالي المحترق. الفخامة والعمق في الكحلي الغامق والأخضر الغابي.</p>

<h2>ثانياً: قاعدة 60/30/10 الذهبية</h2>
<p>هذه القاعدة يستخدمها كل مصمم محترف: 60% من مساحة الغرفة البصرية للون الأساسي (الجدران والسجادة الكبيرة)، 30% للون الثانوي (الأثاث الكبير والستائر)، و10% للون المُعلّم الجريء (الوسائد والإكسسوارات والأعمال الفنية). هذا التوازن يخلق انسجاماً بصرياً دون ملل.</p>

<h2>ثالثاً: خصوصية كل غرفة</h2>
<p><strong>غرفة النوم:</strong> الأولوية للهدوء والحميمية. الألوان الداكنة المتحكم بها كالكحلي العميق والأخضر الغابي تخلق دفئاً غير متوقع. تجنّب الأحمر الساطع والألوان عالية الطاقة.</p>
<p><strong>غرفة المعيشة:</strong> يجب أن توازن بين الاستقبال والراحة. الألوان المحايدة الدافئة تمنح مرونة للتغيير الموسمي في الإكسسوارات. جدار واحد بلون مميز (Accent Wall) يمنح شخصية دون إثقال.</p>
<p><strong>المطبخ:</strong> الأبيض والألوان الفاتحة تعطي شعوراً بالنظافة والمساحة، لكن خزائن بلون داكن كالأزرق البحري أو الأخضر الغابي أصبحت اتجاهاً راقياً جداً وتمنح المطبخ شخصية مميزة.</p>
<p><strong>الحمام:</strong> رغم صغر مساحته، يستحق الجرأة. الأخضر الزاهي أو البلاط ذو الأنماط الجريئة يحوّله إلى تجربة حسية كاملة.</p>

<h2>رابعاً: اختبر قبل أن تلطخ</h2>
<p>اشترِ عيّنات صغيرة (Tester Pots) وطلِّ مساحة 50×50 سم على الجدار الفعلي. انظر إليها في ثلاثة أوقات مختلفة: صباحاً مع الضوء الطبيعي، بعد الظهر مع الضوء المتغير، وليلاً مع الإضاءة الصناعية. اللون يتغيّر تغيراً جذرياً بتغير مصدر الضوء — وهذا ما يفاجئ الناس دائماً.</p>

<h2>خاتمة</h2>
<p>اختيار اللون المناسب ليس ترفاً — هو استثمار في جودة حياتك اليومية. إذا شعرت بالتردد، استشر مصمماً قبل الشراء. في سرديني استوديو، جلسة استشارة واحدة قد تُنقذك من سنوات من العيش مع اللون الخاطئ.</p>',
                'content_en'           => '<p>Color is the most powerful — and most confusing — tool in interior design. How many times have you stood in front of paint swatches feeling completely lost? The truth is that color selection is not a matter of random taste — it is a combination of science and art.</p>

<h2>Step One: Start from Feeling, Not Swatches</h2>
<p>Before opening any catalog, ask yourself: how do I want to feel in this room? Calm? Energized? Warm? Formal? Each emotional state has its colors: calm is found in steel blue, sage green, and warm beige. Energy and vitality live in warm yellow and burnt orange. Luxury and depth reside in deep navy and forest green.</p>

<h2>Step Two: The 60/30/10 Rule</h2>
<p>Every professional designer uses this rule: 60% of the room\'s visual space for the dominant color (walls and large area rug), 30% for the secondary color (large furniture and curtains), and 10% for the accent color (cushions, accessories, artwork). This balance creates visual harmony without monotony.</p>

<h2>Step Three: Each Room Has Its Own Logic</h2>
<p><strong>Bedroom:</strong> Prioritize calm and intimacy. Deep, controlled dark tones like navy or forest green create unexpected warmth. Avoid high-energy reds and vivid oranges.</p>
<p><strong>Living Room:</strong> Balance between hospitality and relaxation. Warm neutrals allow seasonal flexibility through accessories. A single accent wall adds character without overwhelming the space.</p>
<p><strong>Kitchen:</strong> White and light colors convey cleanliness and space, but dark cabinet colors — navy blue or forest green — have become a sophisticated trend that gives kitchens distinctive personality.</p>
<p><strong>Bathroom:</strong> Despite its small size, it deserves boldness. Vibrant greens or patterned tile transforms it into a full sensory experience.</p>

<h2>Step Four: Test Before You Commit</h2>
<p>Buy small tester pots and paint a 50×50 cm patch on the actual wall. Observe it at three different times: morning in natural light, afternoon in changing light, and evening under artificial light. Color changes dramatically with light source — this always surprises people who skip this step.</p>

<h2>Conclusion</h2>
<p>Choosing the right color is not a luxury — it is an investment in your daily quality of life. If you feel uncertain, consult a designer before purchasing. At Sardini Studio, one consultation session can save you years of living with the wrong color.</p>',
                'cover_image'          => 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?w=1200',
                'author_ar'            => 'م. بلال سارديني',
                'author_en'            => 'Arch. Bilal Sardini',
                'read_time'            => 6,
                'status'               => 'published',
                'published_at'         => now()->subDays(10),
                'featured'             => false,
                'views'                => 198,
                'meta_title_ar'        => 'كيف تختار ألوان منزلك؟ دليل مصمم معماري | سرديني',
                'meta_title_en'        => 'How to Choose Home Colors? Architect\'s Guide | Sardini Studio',
                'meta_description_ar'  => 'دليل عملي لاختيار الألوان المناسبة لكل غرفة — قاعدة 60/30/10، خصوصية كل مساحة، وكيف تختبر اللون قبل الشراء.',
                'meta_description_en'  => 'A practical guide to choosing the right colors for every room — the 60/30/10 rule, room-specific logic, and how to test colors before committing.',
            ],

            // Article 3
            [
                'category_id'          => $archTips,
                'title_ar'             => 'لماذا يجب أن ترى منزلك قبل أن تبنيه؟ — أهمية التصاميم ثلاثية الأبعاد',
                'title_en'             => 'Why You Must See Your Home Before You Build It — The Power of 3D Visualization',
                'slug'                 => 'importance-of-3d-visualization-before-construction',
                'excerpt_ar'           => 'التصاميم ثلاثية الأبعاد ليست رفاهية — هي درع يحميك من قرارات مكلفة لا يمكن التراجع عنها. اكتشف كيف توفّر عليك المال والوقت وتضمن نتيجة مثالية.',
                'excerpt_en'           => '3D visualization is not a luxury — it is a shield against costly, irreversible decisions. Discover how it saves you money and time while guaranteeing a perfect result.',
                'content_ar'           => '<p>"لو كنت أعرف أن الأثاث لن يناسب المساحة، لما اخترت هذا التصميم." هذه الجملة — أو ما يشبهها — نسمعها كثيراً من عملاء يأتون إلينا بعد أن بدأوا التنفيذ. التصاميم ثلاثية الأبعاد ليست أداة تسويقية جميلة — هي درع يحميك من قرارات مكلفة لا يمكن التراجع عنها.</p>

<h2>ما هو التصور ثلاثي الأبعاد تحديداً؟</h2>
<p>هو نموذج رقمي واقعي يُظهر مشروعك — خارجياً أو داخلياً — بتفاصيله الكاملة: الأبعاد الحقيقية، الألوان الفعلية، المواد والأسطح، الإضاءة الطبيعية والاصطناعية. بعضها يتطور إلى جولات افتراضية تُتيح لك "المشي" داخل منزلك الرقمي قبل صبّ أي أساس.</p>

<h2>5 أسباب تجعله ضرورة لا رفاهية</h2>
<p><strong>1. ترى ما لا تستطيع تخيّله على الورق:</strong> المخططات ثنائية الأبعاد تتطلب مخيلة مكانية متدربة. أغلب الناس لا يملكونها — وهذا ليس نقصاً، بل حقيقة. النموذج ثلاثي الأبعاد يلغي هذا الغموض بالكامل.</p>
<p><strong>2. قرارات التعديل قبل أن تصبح مكلفة:</strong> تعديل جدار في النموذج الرقمي يستغرق ساعات. تعديل جدار في الواقع يكلف آلاف الدولارات ويستغرق أسابيع. الإحصاءات تقول إن التعديلات أثناء التنفيذ تكلّف 5 إلى 10 أضعاف ما لو أُجريت في مرحلة التصميم.</p>
<p><strong>3. تختبر الألوان والمواد الفعلية:</strong> هل الرخام الذي اخترته يتناسب مع لون الخشب؟ هل الأزرق الذي أحببته في عيّنة صغيرة سيبدو مسيطراً على جدار كامل؟ النموذج يجيبك قبل الشراء.</p>
<p><strong>4. تُوحّد رؤية العائلة:</strong> أحد أصعب تحديات التصميم هو اتفاق أفراد العائلة. النموذج ثلاثي الأبعاد يضع الجميع أمام رؤية مشتركة وملموسة.</p>
<p><strong>5. توفير مالي حقيقي:</strong> دراسات دولية في قطاع البناء تشير إلى أن كل دولار يُصرف على التصميم المسبق يوفر 5 إلى 10 دولارات في التنفيذ.</p>

<h2>أنواع التصور ثلاثي الأبعاد</h2>
<p><strong>الصور الثابتة (Still Renders):</strong> الأكثر شيوعاً — تُظهر زوايا محددة بتفاصيل فائقة الدقة.</p>
<p><strong>الجولات الافتراضية (Virtual Walkthroughs):</strong> تجربة التجول الكامل في المشروع من أي زاوية.</p>
<p><strong>فيديو المشروع:</strong> مناسب للعروض التسويقية والمشاريع الكبيرة والمستثمرين.</p>

<h2>خاتمة</h2>
<p>في سرديني استوديو، التصاميم ثلاثية الأبعاد ليست خياراً إضافياً — هي جزء أساسي من عملية التصميم. لأننا نؤمن بمبدأ واحد: لا يمكنك أن توافق على شيء لا تراه. مشروعك يستحق أن تراه قبل أن تبنيه.</p>',
                'content_en'           => '<p>"If I had known the furniture wouldn\'t fit the space, I would never have chosen this layout." We hear this — or something very similar — from clients who come to us after construction has already begun. 3D visualization is not a pretty marketing tool — it is a shield against costly, irreversible decisions.</p>

<h2>What Exactly Is 3D Visualization?</h2>
<p>It is a photorealistic digital model showing your project — exterior or interior — in complete detail: true dimensions, actual colors, surface materials and textures, and both natural and artificial lighting. Some visualizations evolve into virtual walkthroughs that allow you to "walk through" your digital home before a single foundation is poured.</p>

<h2>5 Reasons It Is a Necessity, Not a Luxury</h2>
<p><strong>1. You see what you cannot imagine on paper:</strong> Two-dimensional drawings require trained spatial intelligence. Most people simply do not have it — and that is not a failing, just a fact. A 3D model eliminates all ambiguity completely.</p>
<p><strong>2. Revisions cost nothing before construction:</strong> Changing a wall in a digital model takes hours. Changing a wall during construction costs thousands and takes weeks. Industry research consistently shows that revisions made during execution cost 5 to 10 times more than changes made during the design phase.</p>
<p><strong>3. You test real colors and materials:</strong> Does the marble you chose complement the wood tone? Will the blue you loved on a small swatch look overwhelming across an entire wall? The model answers these questions before any money is spent.</p>
<p><strong>4. You align the whole family:</strong> One of the hardest challenges in design is achieving family consensus. A 3D model puts everyone in front of a shared, tangible vision — ending abstract disagreements.</p>
<p><strong>5. Genuine financial savings:</strong> International construction industry research indicates that every dollar spent on advance design saves 5 to 10 dollars in execution costs.</p>

<h2>Types of 3D Visualization</h2>
<p><strong>Still Renders:</strong> The most common format — showing specific angles in extraordinary detail.</p>
<p><strong>Virtual Walkthroughs:</strong> The full experience of moving through the project from any angle.</p>
<p><strong>Project Video:</strong> Ideal for marketing presentations, large projects, and investor briefings.</p>

<h2>Conclusion</h2>
<p>At Sardini Studio, 3D visualization is not an optional add-on — it is a core part of our design process. Because we believe in one principle: you cannot approve what you cannot see. Your project deserves to be seen before it is built.</p>',
                'cover_image'          => 'https://images.unsplash.com/photo-1503387762-592deb58ef4e?w=1200',
                'author_ar'            => 'م. بلال سارديني',
                'author_en'            => 'Arch. Bilal Sardini',
                'read_time'            => 7,
                'status'               => 'published',
                'published_at'         => now()->subDays(18),
                'featured'             => true,
                'views'                => 275,
                'meta_title_ar'        => 'أهمية التصميم ثلاثي الأبعاد قبل البناء | سرديني استوديو',
                'meta_title_en'        => 'Why 3D Visualization Matters Before Construction | Sardini Studio',
                'meta_description_ar'  => 'اكتشف لماذا التصاميم ثلاثية الأبعاد ضرورة لا رفاهية — وكيف توفر عليك الوقت والمال وتضمن نتيجة مثالية قبل بدء أي أعمال إنشائية.',
                'meta_description_en'  => 'Discover why 3D architectural visualization is a necessity, not a luxury — and how it saves time, money, and guarantees a perfect result before any construction begins.',
            ],

            // Article 4
            [
                'category_id'          => $interior,
                'title_ar'             => '7 نصائح ذهبية لإضاءة منزلك بذكاء — يستخدمها المصممون المحترفون',
                'title_en'             => '7 Golden Rules for Smart Home Lighting — Used by Professional Designers',
                'slug'                 => 'smart-home-lighting-tips',
                'excerpt_ar'           => 'الإضاءة هي السحر الخفي في التصميم الداخلي. يمكنها أن تجعل غرفة صغيرة تبدو فسيحة وغرفة باردة تبدو دافئة. 7 نصائح عملية يستخدمها المصممون المحترفون.',
                'excerpt_en'           => 'Lighting is the hidden magic of interior design. It can make a small room feel spacious and a cold room feel warm. 7 practical tips that professional designers always apply.',
                'content_ar'           => '<p>الإضاءة هي السحر الخفي في التصميم الداخلي. يمكن أن تجعل غرفة صغيرة تبدو فسيحة، وغرفة باردة تبدو دافئة، ومساحة عادية تبدو أسطورية. ومع ذلك، تأتي الإضاءة في آخر قائمة اهتمامات كثير من أصحاب المنازل — حتى يسكنون ويشعرون بأن شيئاً ما لا يعمل، دون أن يعرفوا لماذا.</p>

<h2>النصيحة 1: فكّر في الإضاءة كطبقات</h2>
<p>المصممون المحترفون يُصمّمون الإضاءة على ثلاث طبقات: الإضاءة العامة (Ambient) التي تُنير الفضاء بشكل عام، إضاءة المهام (Task) الموجّهة لنشاط محدد كالقراءة أو الطهي، وإضاءة التركيز (Accent) التي تُبرز عناصر معينة كلوحة فنية أو عمود معماري. لا تكتفِ بمصدر ضوء واحد — دمج الطبقات هو ما يخلق الجو الحقيقي.</p>

<h2>النصيحة 2: درجة الحرارة اللونية أهم مما تتخيل</h2>
<p>اللمبات الصفراء الدافئة (2700–3000K) تُناسب غرف النوم وأماكن الاسترخاء وغرف المعيشة. اللمبات البيضاء المحايدة (3500–4000K) مثالية للمطابخ والمكاتب والحمامات الكبيرة. اللمبات الباردة الزرقاء (5000–6500K) تُناسب مناطق العمل الدقيق فقط. لا تخلط درجات حرارة متباينة في الغرفة الواحدة — ستخلق توتراً بصرياً غير مريح.</p>

<h2>النصيحة 3: لا تضع كل الإضاءة في السقف</h2>
<p>المصباح المُعلّق في منتصف السقف وحده يعطي إضاءة مسطحة وباهتة. وزّع مصادر الضوء عمودياً: لمبات الحائط (Sconces)، المصابيح الأرضية (Floor Lamps)، الإضاءة تحت الخزائن في المطبخ، والشرائط المضيئة المخفية في أرفف الكتب.</p>

<h2>النصيحة 4: إضاءة Cove اللايتنج المخفية</h2>
<p>الإضاءة غير المباشرة المخفية في أركان السقف أو خلف قواطع خشبية تخلق هالة ناعمة تُغيّر مزاج الغرفة تماماً. هذا ما تراه في الفنادق الفاخرة والمطاعم الراقية — ويمكنك تطبيقه في منزلك بتكلفة معقولة.</p>

<h2>النصيحة 5: الـ Dimmer ليس رفاهية</h2>
<p>مفاتيح التعتيم تُحوّل غرفة واحدة إلى أجواء مختلفة حسب الوقت والمناسبة: ضوء كامل للعمل، خافت للعشاء الرومانسي، معتدل لمشاهدة التلفاز. الاستثمار في الـ Dimmers صغير وعائده على جودة الحياة كبير.</p>

<h2>النصيحة 6: لا تنسَ الإضاءة الخارجية</h2>
<p>الواجهة المُضاءة بذكاء تُعطي المبنى حضوراً مختلفاً تماماً ليلاً. الحديقة المُضاءة تحت الأشجار وبالقرب من عناصر الماء تخلق جمالاً سينمائياً لا يُنسى — وتضيف قيمة عقارية حقيقية.</p>

<h2>النصيحة 7: صمّم للحياة الكاملة</h2>
<p>فكّر في كيفية استخدام المساحة على مدار اليوم: صباحاً لتحضير وجبات الإفطار، ظهراً للعمل، مساءً لاستقبال الضيوف، وليلاً للاسترخاء. الإضاءة المثالية هي التي تخدمك في كل هذه الحالات بمرونة وبزر تحكم واحد.</p>

<h2>خاتمة</h2>
<p>الإضاءة الجيدة تُحوّل مساحة عادية إلى تجربة لا تُنسى — وهي في الغالب الأرخص تأثيراً بين عناصر الديكور. في سرديني استوديو، تدخل الإضاءة ضمن تصميمنا منذ الورقة الأولى. لأن الضوء الجيد لا يُضاف لاحقاً — بل يُخطَّط له منذ البداية.</p>',
                'content_en'           => '<p>Lighting is the hidden magic of interior design. It can make a small room feel spacious, a cold room feel warm, and an ordinary space feel legendary. And yet, lighting is consistently the last thing on most homeowners\' minds — until they move in and sense that something is not working, without knowing why.</p>

<h2>Rule 1: Think in Layers</h2>
<p>Professional designers design lighting across three layers: ambient lighting that illuminates the space generally, task lighting directed at specific activities like reading or cooking, and accent lighting that highlights specific elements like artwork or architectural features. Never rely on a single source — layering is what creates genuine atmosphere.</p>

<h2>Rule 2: Color Temperature Matters More Than You Think</h2>
<p>Warm yellow bulbs (2700–3000K) suit bedrooms, relaxation areas, and living rooms. Neutral white bulbs (3500–4000K) are ideal for kitchens, offices, and larger bathrooms. Cool blue-white bulbs (5000–6500K) suit precise work areas only. Do not mix dramatically different color temperatures in one room — it creates uncomfortable visual tension.</p>

<h2>Rule 3: Don\'t Put All Your Light in the Ceiling</h2>
<p>A single pendant light in the center of the ceiling produces flat, lifeless illumination. Distribute light sources vertically: wall sconces, floor lamps, under-cabinet lighting in the kitchen, and concealed strip lights behind bookshelves.</p>

<h2>Rule 4: Use Cove Lighting</h2>
<p>Indirect light concealed in ceiling recesses or behind wooden partitions creates a soft halo that completely transforms the mood of a room. This is exactly what you see in luxury hotels and fine restaurants — and it can be applied in your home at a reasonable cost.</p>

<h2>Rule 5: A Dimmer Is Not a Luxury</h2>
<p>Dimmer switches transform one room into multiple atmospheres: full brightness for work, soft for a dinner party, medium for watching television. The investment in dimmers is modest and the quality-of-life return is significant.</p>

<h2>Rule 6: Don\'t Neglect Exterior Lighting</h2>
<p>A thoughtfully lit facade gives a building a completely different presence at night. A garden lit beneath trees and near water features creates an unforgettable cinematic quality — and adds genuine real estate value.</p>

<h2>Rule 7: Design for the Full Day</h2>
<p>Think about how the space is used throughout the entire day: morning breakfast preparation, afternoon work, evening entertaining, and late-night relaxation. The ideal lighting system serves all these scenarios with flexibility and ideally from a single control point.</p>

<h2>Conclusion</h2>
<p>Good lighting transforms an ordinary space into an unforgettable experience — and it is typically the most cost-effective element of interior design relative to its impact. At Sardini Studio, lighting enters our design process from the very first page. Because good light is never added afterwards — it is planned from the beginning.</p>',
                'cover_image'          => 'https://images.unsplash.com/photo-1565538810643-b5bdb714032a?w=1200',
                'author_ar'            => 'م. بلال سارديني',
                'author_en'            => 'Arch. Bilal Sardini',
                'read_time'            => 6,
                'status'               => 'published',
                'published_at'         => now()->subDays(25),
                'featured'             => false,
                'views'                => 189,
                'meta_title_ar'        => '7 نصائح لإضاءة منزلك بذكاء | ديكور داخلي سرديني',
                'meta_title_en'        => '7 Smart Home Lighting Tips | Sardini Studio Interior Design',
                'meta_description_ar'  => 'أسرار الإضاءة الداخلية التي يعرفها المصممون المحترفون — 7 نصائح عملية لتحويل منزلك باستخدام الضوء الصحيح.',
                'meta_description_en'  => 'Professional secrets of interior lighting — 7 practical tips to transform your home with the right light, from Sardini Studio\'s design experts.',
            ],

            // Article 5
            [
                'category_id'          => $archTips,
                'title_ar'             => 'المهندس المعماري ومصمم الديكور — ما الفرق؟ ومتى تحتاج كلاً منهما؟',
                'title_en'             => 'Architect vs. Interior Designer — What\'s the Difference and When Do You Need Each?',
                'slug'                 => 'architect-vs-interior-designer',
                'excerpt_ar'           => 'سؤال يتردد كثيراً: هل أحتاج مهندساً معمارياً أم مصمم ديكور؟ الإجابة تعتمد على ما تريده تحديداً. نشرح الفرق الحقيقي بين الاثنين وكيف تختار.',
                'excerpt_en'           => 'A common question: do I need an architect or an interior designer? The answer depends entirely on what you want to achieve. We explain the real difference and how to choose.',
                'content_ar'           => '<p>سؤال يتردد كثيراً: "أنا محتاج أجدد بيتي — هل أحتاج مهندساً أم مصمم ديكور؟" الإجابة، في الحقيقة، تعتمد على نوع العمل الذي تريده. المصطلحان كثيراً ما يُستخدمان بشكل متبادل خطأً، لكن بينهما فرقاً جوهرياً يستحق أن تفهمه قبل اتخاذ أي قرار.</p>

<h2>المهندس المعماري — البنّاء والمُخطِّط</h2>
<p>المهندس المعماري متخصص في الجانب الهيكلي والإنشائي للمبنى. صلاحياته تشمل: تصميم المبنى من الصفر (الشكل، التوزيع، الأدوار، الواجهات)، رسم المخططات الهندسية التنفيذية اللازمة لاستخراج تراخيص البناء، حساب الأحمال الإنشائية، الإشراف على أعمال البناء، وتصميم الواجهات الخارجية والعلاقة مع الموقع. المهندس المعماري يحمل شهادة جامعية هندسية معتمدة ويكون مرخّصاً رسمياً.</p>

<h2>مصمم الديكور الداخلي — صانع الجمال</h2>
<p>مصمم الديكور يتخصص في الفراغات الداخلية بعد اكتمال الهيكل الإنشائي. عمله يشمل: اختيار الألوان والمواد والأسطح، تخطيط الأثاث وتوزيعه، اختيار الإضاءة والستائر والإكسسوارات، تصميم الخزائن المدمجة والأجزاء الخشبية، وخلق الهوية البصرية والجوّ العام للمساحة. معظم مصممي الديكور لا يستطيعون قانونياً إجراء تعديلات إنشائية كهدم الجدران أو إضافة فتحات جديدة.</p>

<h2>متى تحتاج مهندساً معمارياً؟</h2>
<ul>
<li>حين تبني مبنى جديداً من الصفر</li>
<li>حين تُضيف طابقاً أو توسعة للمبنى القائم</li>
<li>حين تُجري تعديلات إنشائية (هدم جدران حاملة، تغيير مواقع الفتحات)</li>
<li>حين تحتاج رخصة بناء رسمية من البلدية</li>
<li>حين تريد تصميماً متكاملاً للواجهات والمناظر الطبيعية</li>
</ul>

<h2>متى تحتاج مصمم ديكور؟</h2>
<ul>
<li>حين تريد تجديد فراغ داخلي موجود دون تعديلات إنشائية</li>
<li>حين تبحث عن هوية بصرية لمساحة تجارية (مطعم، متجر، مكتب)</li>
<li>حين تريد تغيير الأثاث والألوان والمواد فقط</li>
</ul>

<h2>حين يجتمعان — الأفضل دائماً</h2>
<p>في مشاريع التصميم المتكامل، يكون الأمثل أن يعمل المهندس المعماري ومصمم الديكور معاً من البداية — ليضمنا تناسقاً كاملاً بين الهيكل والروح، وبين الخارج والداخل. في سرديني استوديو، نقدم الخدمتين تحت سقف واحد، مما يجعل نتيجة مشاريعنا متكاملة بدلاً من كونها مجموع قطع متفرقة.</p>

<h2>خاتمة</h2>
<p>لا تسأل: "هل أحتاج مهندساً أم مصمم ديكور؟" — بل اسأل: "ما الذي أريد تحقيقه بالضبط؟" الإجابة ستحدد من تحتاج. وإذا شككت، الاستشارة الأولى في سرديني استوديو مجانية دائماً.</p>',
                'content_en'           => '<p>A question that comes up constantly: "I want to renovate my home — do I need an architect or an interior designer?" The answer genuinely depends on the type of work you want done. The two terms are frequently used interchangeably — incorrectly — but there is a fundamental difference worth understanding before making any decision.</p>

<h2>The Architect — Builder and Planner</h2>
<p>An architect specializes in the structural and constructional side of a building. Their scope includes: designing a building from scratch (form, layout, floors, facades), producing the technical engineering drawings required to obtain building permits, calculating structural loads, supervising construction work, and designing exterior facades and site relationships. Architects hold accredited engineering degrees and are formally licensed to practice.</p>

<h2>The Interior Designer — Creator of Beauty</h2>
<p>An interior designer specializes in interior spaces after the structural shell is complete. Their work includes: selecting colors, materials, and finishes; planning and placing furniture; choosing lighting, curtains, and accessories; designing built-in cabinetry and woodwork; and creating the overall visual identity and atmosphere of the space. Most interior designers are not legally authorized to make structural modifications such as demolishing load-bearing walls or creating new openings.</p>

<h2>When Do You Need an Architect?</h2>
<ul>
<li>When building a new structure from scratch</li>
<li>When adding a floor or extension to an existing building</li>
<li>When making structural alterations (removing load-bearing walls, relocating openings)</li>
<li>When a formal building permit from the municipality is required</li>
<li>When you want a complete design for facades and landscape</li>
</ul>

<h2>When Do You Need an Interior Designer?</h2>
<ul>
<li>When renovating an existing interior without structural changes</li>
<li>When creating a visual identity for a commercial space (restaurant, shop, office)</li>
<li>When changing furniture, colors, and materials only</li>
</ul>

<h2>When They Work Together — Always the Best Result</h2>
<p>For fully integrated design projects, the ideal approach is for architect and interior designer to collaborate from the very beginning — ensuring complete harmony between structure and soul, between exterior and interior. At Sardini Studio, we provide both services under one roof, which means the result of our projects is a unified whole rather than a collection of separate parts.</p>

<h2>Conclusion</h2>
<p>Don\'t ask: "Do I need an architect or an interior designer?" Ask instead: "What exactly do I want to achieve?" The answer will determine who you need. And when in doubt — the first consultation at Sardini Studio is always free.</p>',
                'cover_image'          => 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=1200',
                'author_ar'            => 'م. بلال سارديني',
                'author_en'            => 'Arch. Bilal Sardini',
                'read_time'            => 6,
                'status'               => 'published',
                'published_at'         => now()->subDays(35),
                'featured'             => false,
                'views'                => 241,
                'meta_title_ar'        => 'الفرق بين المهندس المعماري ومصمم الديكور | سرديني',
                'meta_title_en'        => 'Architect vs Interior Designer: Key Differences | Sardini Studio',
                'meta_description_ar'  => 'هل تحتاج مهندساً معمارياً أم مصمم ديكور؟ اكتشف الفرق الحقيقي وكيف تختار المتخصص المناسب لمشروعك — دليل من سرديني استوديو.',
                'meta_description_en'  => 'Do you need an architect or an interior designer? Understand the real difference and which specialist your project needs — a clear guide from Sardini Studio.',
            ],
        ];

        foreach ($posts as $post) {
            BlogPost::updateOrCreate(['slug' => $post['slug']], $post);
        }
    }
}
