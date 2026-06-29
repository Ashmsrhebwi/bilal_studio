import { Link } from 'react-router-dom';
import { useTranslation } from 'react-i18next';
import { motion } from 'framer-motion';
import { ArrowRight, ArrowLeft } from 'lucide-react';
import { useQuery } from '@tanstack/react-query';
import { projectsService } from '../../services/projectsService';
import SectionTitle from '../ui/SectionTitle';
import LazyImage from '../ui/LazyImage';

export default function FeaturedProjects() {
  const { t, i18n } = useTranslation();
  const lang = i18n.language;
  const isRTL = lang === 'ar';
  const Arrow = isRTL ? ArrowLeft : ArrowRight;

  const { data: projects = [] } = useQuery({
    queryKey: ['featured-projects'],
    queryFn: projectsService.getFeatured,
  });

  return (
    <section className="py-20" style={{ background: 'var(--color-bg)' }}>
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex items-end justify-between mb-12">
          <SectionTitle title={t('featured.title')} subtitle={t('featured.subtitle')} />
          <Link
            to="/portfolio"
            className="hidden md:flex items-center gap-2 text-sm font-medium transition-colors shrink-0 mb-4"
            style={{ color: '#C9A14A' }}
          >
            {t('featured.view_all')} <Arrow size={16} />
          </Link>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          {projects.map((project, i) => (
            <motion.article
              key={project.id}
              initial={{ opacity: 0, y: 30 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ delay: i * 0.1, duration: 0.6 }}
            >
              <Link to={`/portfolio/${project.slug}`} className="group block overflow-hidden">
                <div className="relative aspect-[4/3] overflow-hidden">
                  <LazyImage
                    src={project.cover}
                    alt={lang === 'ar' ? project.title_ar : project.title_en}
                    className="w-full h-full transition-transform duration-700 group-hover:scale-110"
                    style={{ height: '100%' }}
                  />
                  <div className="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-all duration-300 flex items-center justify-center">
                    <motion.span
                      initial={{ opacity: 0, scale: 0.8 }}
                      whileHover={{ opacity: 1, scale: 1 }}
                      className="opacity-0 group-hover:opacity-100 px-4 py-2 border text-sm font-medium transition-all"
                      style={{ borderColor: '#C9A14A', color: '#C9A14A' }}
                    >
                      {t('featured.view_project')}
                    </motion.span>
                  </div>
                </div>
                <div className="p-4" style={{ borderBottom: '1px solid var(--color-border)', borderLeft: '1px solid var(--color-border)', borderRight: '1px solid var(--color-border)' }}>
                  <span className="text-xs uppercase tracking-wider mb-1 block" style={{ color: '#C9A14A' }}>
                    {t(`portfolio.${project.category}`)}
                  </span>
                  <h3 className="font-semibold text-lg" style={{ color: 'var(--color-text)' }}>
                    {lang === 'ar' ? project.title_ar : project.title_en}
                  </h3>
                  <p className="text-sm mt-1" style={{ color: 'var(--color-text-secondary)' }}>
                    {lang === 'ar' ? project.location_ar : project.location_en} · {project.year}
                  </p>
                </div>
              </Link>
            </motion.article>
          ))}
        </div>

        <div className="mt-10 text-center md:hidden">
          <Link to="/portfolio" className="btn-outline inline-flex">
            {t('featured.view_all')} <Arrow size={16} />
          </Link>
        </div>
      </div>
    </section>
  );
}
