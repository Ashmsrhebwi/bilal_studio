import { Link } from 'react-router-dom';
import { useTranslation } from 'react-i18next';
import { motion } from 'framer-motion';
import { MapPin, Calendar, Maximize2 } from 'lucide-react';
import LazyImage from '../ui/LazyImage';
import TiltCard from '../motion/TiltCard';
import RevealOnScroll from '../motion/RevealOnScroll';

export default function ProjectCard({ project, index = 0 }) {
  const { t, i18n } = useTranslation();
  const lang = i18n.language;

  return (
    <RevealOnScroll delay={index * 0.06} className="group overflow-hidden">
      <Link to={`/portfolio/${project.slug}`} className="block">
        <TiltCard maxTilt={5} className="aspect-[4/3] overflow-hidden">
          <LazyImage
            src={project.cover}
            alt={lang === 'ar' ? project.title_ar : project.title_en}
            className="absolute inset-0 w-full h-full transition-transform duration-700 ease-luxe group-hover:scale-110"
          />
          <div
            className="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500"
            style={{ background: 'linear-gradient(to top, rgba(14,14,14,0.85), rgba(201,161,74,0.18) 55%, transparent 100%)' }}
          />
          <motion.div
            className="absolute inset-x-0 bottom-0 p-5 opacity-0 translate-y-3 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-500"
            style={{ transitionTimingFunction: 'var(--ease-luxe)' }}
          >
            <span className="flex items-center gap-2 text-sm font-medium text-white">
              <Maximize2 size={14} style={{ color: '#C9A14A' }} />
              {t('portfolio.view_details')}
            </span>
          </motion.div>
          <div className="absolute top-3 start-3">
            <span className="text-xs px-2 py-1 font-medium uppercase tracking-wider" style={{ background: '#C9A14A', color: '#0E0E0E' }}>
              {t(`portfolio.${project.category}`)}
            </span>
          </div>
        </TiltCard>
        <div className="p-4" style={{ border: '1px solid var(--color-border)', borderTop: 'none', background: 'var(--color-card)' }}>
          <h3 className="font-semibold text-base mb-2" style={{ color: 'var(--color-text)' }}>
            {lang === 'ar' ? project.title_ar : project.title_en}
          </h3>
          <div className="flex items-center gap-4 text-xs" style={{ color: 'var(--color-text-secondary)' }}>
            <span className="flex items-center gap-1">
              <MapPin size={12} />
              {lang === 'ar' ? project.location_ar : project.location_en}
            </span>
            <span className="flex items-center gap-1">
              <Calendar size={12} />
              {project.year}
            </span>
            <span>{project.area} {t('project_detail.sqm')}</span>
          </div>
        </div>
      </Link>
    </RevealOnScroll>
  );
}
