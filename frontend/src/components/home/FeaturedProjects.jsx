import { Link } from 'react-router-dom';
import { useTranslation } from 'react-i18next';
import { ArrowRight, ArrowLeft } from 'lucide-react';
import { useQuery } from '@tanstack/react-query';
import { projectsService } from '../../services/projectsService';
import SectionTitle from '../ui/SectionTitle';
import LazyImage from '../ui/LazyImage';
import RevealOnScroll from '../motion/RevealOnScroll';
import TiltCard from '../motion/TiltCard';
import { getCategoryLabel } from '../../utils/category';

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
            <RevealOnScroll key={project.id} delay={i * 0.08}>
              <Link to={`/portfolio/${project.slug}`} className="group block overflow-hidden">
                <TiltCard maxTilt={5} className="aspect-[4/3] overflow-hidden">
                  <LazyImage
                    src={project.cover}
                    alt={lang === 'ar' ? project.title_ar : project.title_en}
                    className="absolute inset-0 w-full h-full transition-transform duration-700 ease-luxe group-hover:scale-110"
                  />
                  <div
                    className="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-center justify-center"
                    style={{ background: 'linear-gradient(to top, rgba(14,14,14,0.85), rgba(201,161,74,0.15) 60%, transparent 100%)' }}
                  >
                    <span className="px-4 py-2 border text-sm font-medium" style={{ borderColor: '#C9A14A', color: '#C9A14A' }}>
                      {t('featured.view_project')}
                    </span>
                  </div>
                </TiltCard>
                <div className="p-4" style={{ borderBottom: '1px solid var(--color-border)', borderLeft: '1px solid var(--color-border)', borderRight: '1px solid var(--color-border)' }}>
                  <span className="text-xs uppercase tracking-wider mb-1 block" style={{ color: '#C9A14A' }}>
                    {getCategoryLabel(project.category, lang, t)}
                  </span>
                  <h3 className="font-semibold text-lg" style={{ color: 'var(--color-text)' }}>
                    {lang === 'ar' ? project.title_ar : project.title_en}
                  </h3>
                  <p className="text-sm mt-1" style={{ color: 'var(--color-text-secondary)' }}>
                    {lang === 'ar' ? project.location_ar : project.location_en} · {project.year}
                  </p>
                </div>
              </Link>
            </RevealOnScroll>
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
