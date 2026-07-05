import { useEffect } from 'react';

// ─── LocalBusiness + ProfessionalService base schema ─────────────────────────
const BUSINESS_SCHEMA = {
  '@context': 'https://schema.org',
  '@type': ['LocalBusiness', 'ProfessionalService'],
  '@id': 'https://sardinistudio.com/#business',
  name: 'Sardini Studio | سرديني استوديو',
  alternateName: 'مكتب بلال ساردين للهندسة المعمارية',
  description:
    'مكتب هندسي معماري في حلب، سوريا متخصص في التصميم المعماري والتصميم الداخلي والإشراف الهندسي منذ 2009. نخدم سوريا والخليج العربي وأوروبا.',
  url: 'https://sardinistudio.com',
  logo: {
    '@type': 'ImageObject',
    url: 'https://sardinistudio.com/logo.svg',
    width: 200,
    height: 60,
  },
  image: 'https://sardinistudio.com/og-image.jpg',
  telephone: '+963-21-XXXXXXX',
  email: 'info@sardinistudio.com',
  foundingDate: '2009',
  priceRange: '$$$$',
  founder: {
    '@type': 'Person',
    name: 'Bilal Sardini',
    jobTitle: 'Principal Architect',
    knowsLanguage: ['ar', 'en'],
    sameAs: 'https://sardinistudio.com/about',
  },
  address: {
    '@type': 'PostalAddress',
    streetAddress: 'شارع المتنبي، مبنى 14',
    addressLocality: 'Aleppo',
    addressRegion: 'Aleppo Governorate',
    addressCountry: 'SY',
  },
  geo: {
    '@type': 'GeoCoordinates',
    latitude: '36.2021',
    longitude: '37.1343',
  },
  openingHoursSpecification: [
    {
      '@type': 'OpeningHoursSpecification',
      dayOfWeek: ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday'],
      opens: '09:00',
      closes: '18:00',
    },
  ],
  areaServed: [
    { '@type': 'Country', 'name': 'Syria' },
    { '@type': 'Country', 'name': 'United Arab Emirates' },
    { '@type': 'Country', 'name': 'Saudi Arabia' },
    { '@type': 'Country', 'name': 'Kuwait' },
    { '@type': 'Country', 'name': 'Qatar' },
    { '@type': 'Country', 'name': 'Bahrain' },
    { '@type': 'Country', 'name': 'Oman' },
    { '@type': 'Country', 'name': 'Lebanon' },
    { '@type': 'Country', 'name': 'Jordan' },
  ],
  hasOfferCatalog: {
    '@type': 'OfferCatalog',
    name: 'Architectural & Interior Design Services',
    itemListElement: [
      {
        '@type': 'Offer',
        itemOffered: {
          '@type': 'Service',
          name: 'Architectural Design | التصميم المعماري',
          description:
            'Complete architectural design from concept sketches to full construction documents',
        },
      },
      {
        '@type': 'Offer',
        itemOffered: {
          '@type': 'Service',
          name: 'Interior Design | التصميم الداخلي',
          description:
            'Comprehensive interior design covering space planning, materials, lighting, and furniture',
        },
      },
      {
        '@type': 'Offer',
        itemOffered: {
          '@type': 'Service',
          name: '3D Visualization | التصور ثلاثي الأبعاد',
          description:
            'Photorealistic still renders and virtual walkthroughs before construction begins',
        },
      },
      {
        '@type': 'Offer',
        itemOffered: {
          '@type': 'Service',
          name: 'Construction Supervision | الإشراف الهندسي',
          description:
            'On-site supervision with quality control, contractor coordination, and progress reporting',
        },
      },
      {
        '@type': 'Offer',
        itemOffered: {
          '@type': 'Service',
          name: 'Exterior & Landscape Design | تصميم الواجهات والمناظر الطبيعية',
          description:
            'Facade design, garden and pool planning, exterior lighting, and material selection',
        },
      },
      {
        '@type': 'Offer',
        itemOffered: {
          '@type': 'Service',
          name: 'Architectural Consultancy | الاستشارات المعمارية',
          description:
            'Expert advice for feasibility, drawing review, renovations, and permit preparation',
        },
      },
    ],
  },
  sameAs: [
    'https://www.instagram.com/sardinistudio',
    'https://www.facebook.com/sardinistudio',
    'https://www.linkedin.com/company/sardini-studio',
  ],
};

/**
 * Injects a JSON-LD <script> tag into <head> for the given schema type.
 *
 * Usage:
 *   // Home / About / Services pages
 *   <SchemaOrg type="business" />
 *
 *   // Blog article page
 *   <SchemaOrg type="article" data={articleSchemaData} />
 *
 *   // Portfolio project page
 *   <SchemaOrg type="creative-work" data={projectSchemaData} />
 */
export default function SchemaOrg({ type = 'business', data = {} }) {
  useEffect(() => {
    let schema;

    if (type === 'business') {
      schema = { ...BUSINESS_SCHEMA, ...data };
    } else {
      schema = data;
    }

    const scriptId = `ld-json-${type}`;
    let script = document.getElementById(scriptId);
    if (!script) {
      script = document.createElement('script');
      script.id = scriptId;
      script.type = 'application/ld+json';
      document.head.appendChild(script);
    }
    script.textContent = JSON.stringify(schema, null, 0);

    return () => {
      const el = document.getElementById(scriptId);
      if (el) el.remove();
    };
  }, [type, data]);

  return null;
}

// ─── Helper: build Article schema for blog posts ──────────────────────────────
export function buildArticleSchema({ title, description, slug, publishedAt, updatedAt, image, author = 'Bilal Sardini' }) {
  return {
    '@context': 'https://schema.org',
    '@type': 'Article',
    headline: title,
    description,
    author: {
      '@type': 'Person',
      name: author,
      url: 'https://sardinistudio.com/about',
    },
    publisher: {
      '@type': 'Organization',
      name: 'Sardini Studio',
      logo: {
        '@type': 'ImageObject',
        url: 'https://sardinistudio.com/logo.svg',
      },
    },
    datePublished: publishedAt,
    dateModified: updatedAt || publishedAt,
    url: `https://sardinistudio.com/blog/${slug}`,
    image: image || 'https://sardinistudio.com/og-image.jpg',
    mainEntityOfPage: {
      '@type': 'WebPage',
      '@id': `https://sardinistudio.com/blog/${slug}`,
    },
    inLanguage: title.match(/[؀-ۿ]/) ? 'ar' : 'en',
  };
}

// ─── Helper: build CreativeWork schema for portfolio projects ─────────────────
export function buildProjectSchema({ name, description, slug, image, completionYear, location }) {
  return {
    '@context': 'https://schema.org',
    '@type': 'CreativeWork',
    name,
    description,
    creator: {
      '@type': 'Organization',
      name: 'Sardini Studio',
      url: 'https://sardinistudio.com',
    },
    url: `https://sardinistudio.com/portfolio/${slug}`,
    image: image || 'https://sardinistudio.com/og-image.jpg',
    dateCreated: completionYear ? `${completionYear}-01-01` : undefined,
    locationCreated: location
      ? { '@type': 'Place', name: location }
      : undefined,
  };
}
