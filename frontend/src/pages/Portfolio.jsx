import { useMemo, useState } from 'react';
import { useTranslation } from 'react-i18next';
import { motion } from 'framer-motion';
import { useQuery } from '@tanstack/react-query';
import { useSEO } from '../hooks/useSEO';
import { projectsService } from '../services/projectsService';
import SectionTitle from '../components/ui/SectionTitle';
import ProjectCard from '../components/portfolio/ProjectCard';
import { getCategorySlug, getCategoryLabel } from '../utils/category';

export default function Portfolio() {
  useSEO({ titleKey: 'seo.portfolio_title', descKey: 'seo.portfolio_desc' });
  const { t, i18n } = useTranslation();
  const lang = i18n.language;
  const [activeCategory, setActiveCategory] = useState('all');

  const { data: projects = [], isLoading } = useQuery({
    queryKey: ['projects'],
    queryFn: projectsService.getAll,
  });

  const categories = useMemo(() => {
    const seen = new Map();
    for (const p of projects) {
      const slug = getCategorySlug(p.category);
      if (slug && !seen.has(slug)) seen.set(slug, p.category);
    }
    return Array.from(seen.entries());
  }, [projects]);

  const filtered = activeCategory === 'all'
    ? projects
    : projects.filter((p) => getCategorySlug(p.category) === activeCategory);

  return (
    <main className="pt-24 pb-20">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <SectionTitle title={t('portfolio.title')} subtitle={t('portfolio.subtitle')} />

        {/* Filter Tabs */}
        <div className="flex flex-wrap gap-2 mb-10">
          <button
            onClick={() => setActiveCategory('all')}
            className="px-4 py-2 text-sm font-medium transition-all border"
            style={{
              borderColor: activeCategory === 'all' ? '#C9A14A' : 'var(--color-border)',
              background: activeCategory === 'all' ? '#C9A14A' : 'transparent',
              color: activeCategory === 'all' ? '#0E0E0E' : 'var(--color-text-secondary)',
            }}
          >
            {t('portfolio.all')}
          </button>
          {categories.map(([slug, category]) => (
            <button
              key={slug}
              onClick={() => setActiveCategory(slug)}
              className="px-4 py-2 text-sm font-medium transition-all border"
              style={{
                borderColor: activeCategory === slug ? '#C9A14A' : 'var(--color-border)',
                background: activeCategory === slug ? '#C9A14A' : 'transparent',
                color: activeCategory === slug ? '#0E0E0E' : 'var(--color-text-secondary)',
              }}
            >
              {getCategoryLabel(category, lang, t)}
            </button>
          ))}
        </div>

        {isLoading ? (
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {Array.from({ length: 6 }).map((_, i) => (
              <div key={i} className="aspect-[4/3] animate-pulse rounded" style={{ background: 'var(--color-card)' }} />
            ))}
          </div>
        ) : filtered.length === 0 ? (
          <p className="text-center py-20" style={{ color: 'var(--color-text-secondary)' }}>
            {t('portfolio.no_results')}
          </p>
        ) : (
          <motion.div
            layout
            className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"
          >
            {filtered.map((project, i) => (
              <ProjectCard key={project.id} project={project} index={i} />
            ))}
          </motion.div>
        )}
      </div>
    </main>
  );
}
