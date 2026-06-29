import { Link } from 'react-router-dom';
import { useTranslation } from 'react-i18next';
import { motion } from 'framer-motion';
import { MapPin, Calendar, Maximize2 } from 'lucide-react';
import LazyImage from '../ui/LazyImage';

export default function ProjectCard({ project, index = 0 }) {
  const { t, i18n } = useTranslation();
  const lang = i18n.language;

  return (
    <motion.article
      initial={{ opacity: 0, y: 30 }}
      whileInView={{ opacity: 1, y: 0 }}
      viewport={{ once: true }}
      transition={{ delay: index * 0.05, duration: 0.5 }}
      className="group overflow-hidden"
    >
      <Link to={`/portfolio/${project.slug}`} className="block">
        <div className="relative aspect-[4/3] overflow-hidden">
          <LazyImage
            src={project.cover}
            alt={lang === 'ar' ? project.title_ar : project.title_en}
            className="absolute inset-0 w-full h-full transition-transform duration-700 group-hover:scale-110"
          />
          <div className="absolute inset-0 bg-black/0 group-hover:bg-black/50 transition-all duration-300" />
          <div className="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            <span className="flex items-center gap-2 px-4 py-2 border text-sm font-medium" style={{ borderColor: '#C9A14A', color: '#C9A14A' }}>
              <Maximize2 size={14} />
              {t('portfolio.view_details')}
            </span>
          </div>
          <div className="absolute top-3 start-3">
            <span className="text-xs px-2 py-1 font-medium uppercase tracking-wider" style={{ background: '#C9A14A', color: '#0E0E0E' }}>
              {t(`portfolio.${project.category}`)}
            </span>
          </div>
        </div>
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
    </motion.article>
  );
}
