import { useState } from 'react';
import { useParams, Link, Navigate } from 'react-router-dom';
import { useTranslation } from 'react-i18next';
import { motion } from 'framer-motion';
import { useQuery } from '@tanstack/react-query';
import { MapPin, Calendar, Maximize2, ArrowLeft, ArrowRight, CheckCircle } from 'lucide-react';
import { useSEO } from '../hooks/useSEO';
import SchemaOrg, { buildProjectSchema } from '../components/SEO/SchemaOrg';
import { projectsService } from '../services/projectsService';
import Lightbox from '../components/portfolio/Lightbox';
import ProjectCard from '../components/portfolio/ProjectCard';
import LazyImage from '../components/ui/LazyImage';

export default function ProjectDetail() {
  const { slug } = useParams();
  const { t, i18n } = useTranslation();
  const lang = i18n.language;
  const isRTL = lang === 'ar';
  const BackArrow = isRTL ? ArrowRight : ArrowLeft;

  const [lightboxOpen, setLightboxOpen] = useState(false);
  const [lightboxIndex, setLightboxIndex] = useState(0);
  const [beforeAfter, setBeforeAfter] = useState('after');

  const { data: project, isLoading } = useQuery({
    queryKey: ['project', slug],
    queryFn: () => projectsService.getBySlug(slug),
  });

  const { data: allProjects = [] } = useQuery({
    queryKey: ['projects'],
    queryFn: projectsService.getAll,
  });

  useSEO({
    titleFallback: project ? (lang === 'ar' ? project.title_ar : project.title_en) : '',
    descFallback: project ? (lang === 'ar' ? project.description_ar : project.description_en) : '',
    ogImage: project?.cover,
    canonical: `https://sardinistudio.com/portfolio/${slug}`,
  });

  if (isLoading) return (
    <div className="pt-24 pb-20 flex items-center justify-center min-h-screen">
      <div className="w-10 h-10 border-2 rounded-full animate-spin" style={{ borderColor: 'transparent', borderTopColor: '#C9A14A' }} />
    </div>
  );

  if (!project) return <Navigate to="/portfolio" replace />;

  const related = allProjects.filter((p) => p.category === project.category && p.id !== project.id).slice(0, 3);
  const openLightbox = (i) => { setLightboxIndex(i); setLightboxOpen(true); };
  const projectSchema = buildProjectSchema({
    name: lang === 'ar' ? project.title_ar : project.title_en,
    description: lang === 'ar' ? project.description_ar : project.description_en,
    slug,
    image: project.cover,
    completionYear: project.year,
    location: lang === 'ar' ? project.location_ar : project.location_en,
  });

  return (
    <main className="pt-24 pb-20">
      <SchemaOrg type="creative-work" data={projectSchema} />
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Breadcrumb */}
        <Link
          to="/portfolio"
          className="inline-flex items-center gap-2 text-sm mb-8 transition-colors"
          style={{ color: 'var(--color-text-secondary)' }}
        >
          <BackArrow size={16} />
          {t('project_detail.back')}
        </Link>

        {/* Hero */}
        <div className="relative aspect-[16/7] overflow-hidden mb-10">
          <LazyImage src={project.cover} alt={lang === 'ar' ? project.title_ar : project.title_en} className="w-full h-full" />
          <div className="absolute inset-0" style={{ background: 'linear-gradient(to top, rgba(0,0,0,0.7), transparent)' }}>
            <div className="absolute bottom-8 start-8">
              <span className="text-xs px-2 py-1 font-medium uppercase tracking-wider mb-3 inline-block" style={{ background: '#C9A14A', color: '#0E0E0E' }}>
                {t(`portfolio.${project.category}`)}
              </span>
              <h1 className="text-3xl md:text-5xl font-bold text-white">
                {lang === 'ar' ? project.title_ar : project.title_en}
              </h1>
            </div>
          </div>
        </div>

        <div className="grid grid-cols-1 lg:grid-cols-3 gap-10">
          {/* Main Content */}
          <div className="lg:col-span-2">
            {/* Description */}
            <motion.div initial={{ opacity: 0, y: 20 }} animate={{ opacity: 1, y: 0 }} transition={{ duration: 0.7, ease: [0.22, 1, 0.36, 1] }}>
              <h2 className="text-xl font-semibold mb-4" style={{ color: 'var(--color-text)' }}>{t('project_detail.description')}</h2>
              <p className="leading-relaxed text-base" style={{ color: 'var(--color-text-secondary)' }}>
                {lang === 'ar' ? project.description_ar : project.description_en}
              </p>
            </motion.div>

            {/* Gallery */}
            <div className="mt-10">
              <h2 className="text-xl font-semibold mb-6" style={{ color: 'var(--color-text)' }}>{t('project_detail.gallery')}</h2>
              <div className="grid grid-cols-2 md:grid-cols-3 gap-3">
                {project.images.map((img, i) => (
                  <button
                    key={i}
                    onClick={() => openLightbox(i)}
                    className="relative aspect-square overflow-hidden group"
                    aria-label={`${t('project_detail.gallery')} ${i + 1}`}
                  >
                    <LazyImage src={img} alt={`Gallery ${i + 1}`} className="w-full h-full transition-transform duration-500 group-hover:scale-110" />
                    <div className="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-all flex items-center justify-center">
                      <Maximize2 className="opacity-0 group-hover:opacity-100 text-white transition-opacity" size={22} />
                    </div>
                  </button>
                ))}
              </div>
            </div>

            {/* Before/After */}
            {project.before_image && project.after_image && (
              <div className="mt-10">
                <h2 className="text-xl font-semibold mb-6" style={{ color: 'var(--color-text)' }}>{t('project_detail.before_after')}</h2>
                <div className="flex gap-3 mb-4">
                  {['before', 'after'].map((s) => (
                    <button
                      key={s}
                      onClick={() => setBeforeAfter(s)}
                      className="px-4 py-2 text-sm border transition-all"
                      style={{
                        borderColor: beforeAfter === s ? '#C9A14A' : 'var(--color-border)',
                        background: beforeAfter === s ? '#C9A14A' : 'transparent',
                        color: beforeAfter === s ? '#0E0E0E' : 'var(--color-text-secondary)',
                      }}
                    >
                      {t(`project_detail.${s}`)}
                    </button>
                  ))}
                </div>
                <motion.div key={beforeAfter} initial={{ opacity: 0 }} animate={{ opacity: 1 }} className="aspect-video overflow-hidden">
                  <LazyImage
                    src={beforeAfter === 'before' ? project.before_image : project.after_image}
                    alt={beforeAfter}
                    className="w-full h-full"
                  />
                </motion.div>
              </div>
            )}
          </div>

          {/* Sidebar */}
          <div>
            <div className="card p-6 sticky top-24">
              <h3 className="font-semibold mb-6 pb-4" style={{ color: 'var(--color-text)', borderBottom: '1px solid var(--color-border)' }}>
                {lang === 'ar' ? project.title_ar : project.title_en}
              </h3>
              <div className="space-y-4">
                {[
                  { label: t('project_detail.location'), value: lang === 'ar' ? project.location_ar : project.location_en, Icon: MapPin },
                  { label: t('project_detail.year'), value: project.year, Icon: Calendar },
                  { label: t('project_detail.area'), value: `${project.area} ${t('project_detail.sqm')}`, Icon: Maximize2 },
                ].map(({ label, value, Icon }) => (
                  <div key={label} className="flex items-center gap-3">
                    <Icon size={16} style={{ color: '#C9A14A' }} />
                    <div>
                      <p className="text-xs mb-0.5" style={{ color: 'var(--color-text-secondary)' }}>{label}</p>
                      <p className="text-sm font-medium" style={{ color: 'var(--color-text)' }}>{value}</p>
                    </div>
                  </div>
                ))}
              </div>

              <div className="mt-6 pt-6" style={{ borderTop: '1px solid var(--color-border)' }}>
                <p className="text-xs mb-3" style={{ color: 'var(--color-text-secondary)' }}>{t('project_detail.services')}</p>
                <ul className="space-y-2">
                  {(lang === 'ar' ? project.services_ar : project.services_en).map((s, i) => (
                    <li key={i} className="flex items-center gap-2 text-sm" style={{ color: 'var(--color-text)' }}>
                      <CheckCircle size={14} style={{ color: '#C9A14A' }} /> {s}
                    </li>
                  ))}
                </ul>
              </div>

              <Link to="/contact" className="btn-primary w-full mt-6 justify-center">
                {t('nav.book')}
              </Link>
            </div>
          </div>
        </div>

        {/* Related */}
        {related.length > 0 && (
          <div className="mt-20">
            <h2 className="text-2xl font-bold mb-8" style={{ color: 'var(--color-text)' }}>{t('project_detail.related')}</h2>
            <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
              {related.map((p, i) => <ProjectCard key={p.id} project={p} index={i} />)}
            </div>
          </div>
        )}
      </div>

      {lightboxOpen && (
        <Lightbox
          images={project.images}
          currentIndex={lightboxIndex}
          onClose={() => setLightboxOpen(false)}
          onPrev={() => setLightboxIndex((i) => (i === 0 ? project.images.length - 1 : i - 1))}
          onNext={() => setLightboxIndex((i) => (i === project.images.length - 1 ? 0 : i + 1))}
        />
      )}
    </main>
  );
}
