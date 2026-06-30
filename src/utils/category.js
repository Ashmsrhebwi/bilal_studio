/**
 * Project/category objects differ by data source: mock data uses a plain
 * slug string, the real API returns {id, name_ar, name_en, slug, icon}.
 * These helpers normalize access across both shapes.
 */
export function getCategorySlug(category) {
  if (!category) return '';
  return typeof category === 'string' ? category : category.slug;
}

export function getCategoryLabel(category, lang, t) {
  if (!category) return '';
  if (typeof category === 'string') return t(`portfolio.${category}`);
  return lang === 'ar' ? category.name_ar : category.name_en;
}
