import { useTranslation } from 'react-i18next';
import { motion } from 'framer-motion';
import { Star } from 'lucide-react';
import { useQuery } from '@tanstack/react-query';
import { useSEO } from '../hooks/useSEO';
import { testimonialsService } from '../services';
import SectionTitle from '../components/ui/SectionTitle';

export default function Testimonials() {
  useSEO({ titleKey: 'seo.testimonials_title', descKey: 'seo.testimonials_desc' });
  const { t, i18n } = useTranslation();
  const lang = i18n.language;

  const { data: testimonials = [], isLoading, isError, refetch } = useQuery({
    queryKey: ['testimonials'],
    queryFn: testimonialsService.getAll,
  });

  return (
    <main className="pt-24 pb-20">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <SectionTitle title={t('testimonials.title')} subtitle={t('testimonials.subtitle')} center />

        {isLoading ? (
          <div className="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
            {Array.from({ length: 4 }).map((_, i) => (
              <div key={i} className="card p-8 h-48 animate-pulse" style={{ background: 'var(--color-card)' }} />
            ))}
          </div>
        ) : isError ? (
          <div className="text-center py-20">
            <p className="mb-4" style={{ color: 'var(--color-text-secondary)' }}>{t('common.error')}</p>
            <button onClick={() => refetch()} className="btn-outline inline-flex">{t('common.retry')}</button>
          </div>
        ) : testimonials.length === 0 ? (
          <p className="text-center py-20" style={{ color: 'var(--color-text-secondary)' }}>
            {t('common.no_results')}
          </p>
        ) : (
        <div className="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
          {testimonials.map((item, i) => (
            <motion.div
              key={item.id}
              initial={{ opacity: 0, y: 20 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ delay: i * 0.08, duration: 0.6, ease: [0.22, 1, 0.36, 1] }}
              className="card p-8"
            >
              <div className="flex gap-1 mb-4">
                {Array.from({ length: item.rating }).map((_, j) => (
                  <Star key={j} size={16} fill="#C9A14A" color="#C9A14A" />
                ))}
              </div>
              <blockquote className="text-base leading-relaxed mb-6 italic" style={{ color: 'var(--color-text)' }}>
                "{lang === 'ar' ? item.text_ar : item.text_en}"
              </blockquote>
              <div className="flex items-center gap-3 pt-4" style={{ borderTop: '1px solid var(--color-border)' }}>
                <img src={item.avatar} alt={lang === 'ar' ? item.name_ar : item.name_en} className="w-10 h-10 rounded-full object-cover" />
                <div>
                  <p className="font-semibold text-sm" style={{ color: 'var(--color-text)' }}>
                    {lang === 'ar' ? item.name_ar : item.name_en}
                  </p>
                  <p className="text-xs" style={{ color: '#C9A14A' }}>
                    {lang === 'ar' ? item.role_ar : item.role_en} · {lang === 'ar' ? item.project_ar : item.project_en}
                  </p>
                </div>
              </div>
            </motion.div>
          ))}
        </div>
        )}
      </div>
    </main>
  );
}
