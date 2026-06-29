<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $residential = ProjectCategory::where('slug', 'residential')->first()?->id;
        $commercial   = ProjectCategory::where('slug', 'commercial')->first()?->id;
        $interior     = ProjectCategory::where('slug', 'interior')->first()?->id;
        $hospitality  = ProjectCategory::where('slug', 'hospitality')->first()?->id;

        $projects = [
            [
                'category_id'      => $residential,
                'title_ar'         => 'فيلا المشرفية',
                'title_en'         => 'Al-Mashrifyah Villa',
                'slug'             => 'al-mashrifyah-villa',
                'description_ar'   => 'فيلا سكنية فاخرة بمساحة 650 م² تجمع بين الطراز المعاصر والهوية المعمارية العربية. تتميز بنوافذ بانورامية تطل على حدائق خاصة، وتشطيبات راقية من الرخام والخشب الطبيعي.',
                'description_en'   => 'A luxury residential villa spanning 650 m² that blends contemporary design with Arabic architectural identity. Features panoramic windows overlooking private gardens and premium marble and natural wood finishes.',
                'location_ar'      => 'المزة، دمشق',
                'location_en'      => 'Al-Mazzeh, Damascus',
                'area'             => 650,
                'year'             => 2024,
                'services_ar'      => ['التصميم المعماري', 'التصميم الداخلي', 'الإشراف على التنفيذ'],
                'services_en'      => ['Architectural Design', 'Interior Design', 'Construction Supervision'],
                'cover_image'      => 'https://images.unsplash.com/photo-1613490493576-7fde63acd811?w=1200',
                'gallery_images'   => [
                    'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=1200',
                    'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1200',
                    'https://images.unsplash.com/photo-1600210492493-0946911123ea?w=1200',
                ],
                'featured'      => true,
                'status'           => 'published',
                'sort_order'       => 1,
                'meta_title_ar'    => 'فيلا المشرفية | سرديني استوديو',
                'meta_title_en'    => 'Al-Mashrifyah Villa | Sardini Studio',
            ],
            [
                'category_id'      => $commercial,
                'title_ar'         => 'مجمع الأعمال الذهبي',
                'title_en'         => 'Golden Business Complex',
                'slug'             => 'golden-business-complex',
                'description_ar'   => 'مجمع تجاري متكامل يضم 12 طابقاً من المكاتب الحديثة، مع واجهة زجاجية انسيابية وردهة استقبال فاخرة. صُمم ليكون علامة معمارية بارزة في قلب المدينة.',
                'description_en'   => 'An integrated commercial complex featuring 12 floors of modern offices with a flowing glass facade and a luxurious reception lobby. Designed to be a prominent architectural landmark in the city center.',
                'location_ar'      => 'وسط المدينة، حلب',
                'location_en'      => 'City Center, Aleppo',
                'area'             => 4800,
                'year'             => 2023,
                'services_ar'      => ['التصميم المعماري', 'رسومات تنفيذية', 'استشارات هندسية'],
                'services_en'      => ['Architectural Design', 'Construction Drawings', 'Engineering Consultancy'],
                'cover_image'      => 'https://images.unsplash.com/photo-1486325212027-8081e485255e?w=1200',
                'gallery_images'   => [
                    'https://images.unsplash.com/photo-1497366216548-37526070297c?w=1200',
                    'https://images.unsplash.com/photo-1497366754035-f200968a6e72?w=1200',
                ],
                'featured'      => true,
                'status'           => 'published',
                'sort_order'       => 2,
            ],
            [
                'category_id'      => $interior,
                'title_ar'         => 'شقة أفق',
                'title_en'         => 'Horizon Apartment',
                'slug'             => 'horizon-apartment',
                'description_ar'   => 'تصميم داخلي متكامل لشقة مساحتها 320 م² في برج سكني فاخر. اعتمد التصميم على مفهوم المساحات المفتوحة مع توظيف الإضاءة الطبيعية والمواد الفاخرة.',
                'description_en'   => 'Full interior design for a 320 m² apartment in a luxury residential tower. The design adopts an open-plan concept with strategic use of natural light and premium materials.',
                'location_ar'      => 'برج الياسمين، دمشق',
                'location_en'      => 'Jasmine Tower, Damascus',
                'area'             => 320,
                'year'             => 2024,
                'services_ar'      => ['التصميم الداخلي', 'اختيار المواد', 'إشراف تنفيذ'],
                'services_en'      => ['Interior Design', 'Material Selection', 'Execution Supervision'],
                'cover_image'      => 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?w=1200',
                'gallery_images'   => [
                    'https://images.unsplash.com/photo-1615529182904-14819c35db37?w=1200',
                    'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=1200',
                ],
                'before_image'     => 'https://images.unsplash.com/photo-1493809842364-78817add7ffb?w=1200',
                'after_image'      => 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?w=1200',
                'featured'      => true,
                'status'           => 'published',
                'sort_order'       => 3,
            ],
            [
                'category_id'      => $hospitality,
                'title_ar'         => 'فندق لؤلؤة الشرق',
                'title_en'         => 'Pearl of the East Hotel',
                'slug'             => 'pearl-of-the-east-hotel',
                'description_ar'   => 'تصميم فندق بوتيكي من فئة 5 نجوم يجمع بين الموروث المعماري الأموي والأناقة المعاصرة. يضم 80 غرفة، ومطعماً فاخراً، ومركز سبا متكامل.',
                'description_en'   => 'Design of a 5-star boutique hotel blending Umayyad architectural heritage with contemporary elegance. Features 80 rooms, a fine dining restaurant, and a full-service spa.',
                'location_ar'      => 'المدينة القديمة، دمشق',
                'location_en'      => 'Old City, Damascus',
                'area'             => 3200,
                'year'             => 2022,
                'services_ar'      => ['التصميم المعماري', 'التصميم الداخلي', 'تصميم المناظر الطبيعية'],
                'services_en'      => ['Architectural Design', 'Interior Design', 'Landscape Design'],
                'cover_image'      => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=1200',
                'gallery_images'   => [
                    'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=1200',
                    'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=1200',
                ],
                'featured'      => false,
                'status'           => 'published',
                'sort_order'       => 4,
            ],
            [
                'category_id'      => $residential,
                'title_ar'         => 'مجمع الرافدين السكني',
                'title_en'         => 'Al-Rafidain Residential Complex',
                'slug'             => 'al-rafidain-residential-complex',
                'description_ar'   => 'مجمع سكني متكامل يضم 24 وحدة سكنية متنوعة بين شقق وفيلات. يتميز بتصميم حضري ذكي يراعي الخصوصية وتعزيز روح المجتمع.',
                'description_en'   => 'An integrated residential complex featuring 24 diverse units including apartments and villas. Distinguished by a smart urban design that respects privacy while fostering community spirit.',
                'location_ar'      => 'المشرفة، حلب',
                'location_en'      => 'Al-Mashrafa, Aleppo',
                'area'             => 8500,
                'year'             => 2023,
                'services_ar'      => ['التصميم المعماري', 'تخطيط الموقع', 'رسومات تنفيذية'],
                'services_en'      => ['Architectural Design', 'Site Planning', 'Construction Drawings'],
                'cover_image'      => 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=1200',
                'gallery_images'   => [
                    'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=1200',
                ],
                'featured'      => false,
                'status'           => 'published',
                'sort_order'       => 5,
            ],
            [
                'category_id'      => $commercial,
                'title_ar'         => 'مركز النخبة التجاري',
                'title_en'         => 'Elite Commercial Center',
                'slug'             => 'elite-commercial-center',
                'description_ar'   => 'مركز تجاري عصري يضم 60 محلاً تجارياً على 3 طوابق مع مواقف تحت الأرض. صُمم بأسلوب معماري مميز يلفت الانتباه ويشجع على الحركة.',
                'description_en'   => 'A modern commercial center housing 60 retail units across 3 floors with underground parking. Designed with a distinctive architectural style that attracts attention and encourages foot traffic.',
                'location_ar'      => 'الميدان، دمشق',
                'location_en'      => 'Al-Midan, Damascus',
                'area'             => 5200,
                'year'             => 2022,
                'services_ar'      => ['التصميم المعماري', 'تصميم الواجهات', 'استشارات تجارية'],
                'services_en'      => ['Architectural Design', 'Facade Design', 'Commercial Consultancy'],
                'cover_image'      => 'https://images.unsplash.com/photo-1519567770579-c2fc5e9ca47a?w=1200',
                'gallery_images'   => [],
                'featured'      => false,
                'status'           => 'published',
                'sort_order'       => 6,
            ],
        ];

        foreach ($projects as $project) {
            Project::updateOrCreate(['slug' => $project['slug']], $project);
        }
    }
}
