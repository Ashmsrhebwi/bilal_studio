import { useEffect } from 'react';
import { useTranslation } from 'react-i18next';

function setMeta(attrName, attrValue, content) {
  let el = document.querySelector(`meta[${attrName}="${attrValue}"]`);
  if (!el) {
    el = document.createElement('meta');
    el.setAttribute(attrName, attrValue);
    document.head.appendChild(el);
  }
  el.setAttribute('content', content || '');
}

function setCanonical(url) {
  let link = document.querySelector('link[rel="canonical"]');
  if (!link) {
    link = document.createElement('link');
    link.setAttribute('rel', 'canonical');
    document.head.appendChild(link);
  }
  link.setAttribute('href', url);
}

/**
 * Manages page-level <title>, <meta name="description">, Open Graph, and Twitter Card tags.
 *
 * @param {object} options
 * @param {string} [options.titleKey]       - i18n key for title (e.g. "seo.home_title")
 * @param {string} [options.descKey]        - i18n key for description
 * @param {string} [options.titleFallback]  - Plain string title used when no key
 * @param {string} [options.descFallback]   - Plain string description used when no key
 * @param {string} [options.ogImage]        - Absolute URL of OG image (1200×630 recommended)
 * @param {string} [options.ogType]         - "website" | "article" (default: "website")
 * @param {string} [options.canonical]      - Canonical URL override; defaults to current href
 */
export function useSEO({
  titleKey,
  descKey,
  titleFallback,
  descFallback,
  ogImage = 'https://sardinistudio.com/og-image.jpg',
  ogType = 'website',
  canonical,
} = {}) {
  const { t, i18n } = useTranslation();
  const lang = i18n.language || 'ar';
  const isAr = lang === 'ar';

  useEffect(() => {
    const title = titleKey ? t(titleKey) : (titleFallback || document.title);
    const desc  = descKey  ? t(descKey)  : (descFallback || '');

    document.title = title;

    // Standard
    setMeta('name', 'description', desc);
    setMeta('name', 'language', isAr ? 'Arabic' : 'English');

    // Open Graph
    setMeta('property', 'og:title',       title);
    setMeta('property', 'og:description', desc);
    setMeta('property', 'og:type',        ogType);
    setMeta('property', 'og:image',       ogImage);
    setMeta('property', 'og:locale',      isAr ? 'ar_SY' : 'en_US');
    setMeta('property', 'og:locale:alternate', isAr ? 'en_US' : 'ar_SY');
    setMeta('property', 'og:site_name',   'Sardini Studio | سرديني استوديو');
    setMeta('property', 'og:url',         canonical || window.location.href.split('?')[0]);

    // Twitter Card
    setMeta('name', 'twitter:card',        'summary_large_image');
    setMeta('name', 'twitter:title',       title);
    setMeta('name', 'twitter:description', desc);
    setMeta('name', 'twitter:image',       ogImage);
    setMeta('name', 'twitter:site',        '@SardiniStudio');

    // Canonical
    setCanonical(canonical || window.location.href.split('?')[0]);

    // html[lang] and dir are managed by LanguageContext, but reinforce here
    document.documentElement.lang = lang;
    document.documentElement.dir  = isAr ? 'rtl' : 'ltr';
  }, [t, lang, titleKey, descKey, titleFallback, descFallback, ogImage, ogType, canonical, isAr]);
}
