import { useState } from 'react';
import { Link } from 'react-router-dom';
import { useTranslation } from 'react-i18next';
import { motion, AnimatePresence } from 'framer-motion';
import { Star, ChevronLeft, ChevronRight } from 'lucide-react';
import { useQuery } from '@tanstack/react-query';
import { testimonialsService } from '../../services';
import SectionTitle from '../ui/SectionTitle';

export default function TestimonialsPreview() {
  const { t, i18n } = useTranslation();
  const lang = i18n.language;
  const [current, setCurrent] = useState(0);

  const { data: testimonials = [] } = useQuery({
    queryKey: ['testimonials'],
    queryFn: testimonialsService.getAll,
  });

  const prev = () => setCurrent((c) => (c === 0 ? testimonials.length - 1 : c - 1));
  const next = () => setCurrent((c) => (c === testimonials.length - 1 ? 0 : c + 1));

  if (!testimonials.length) return null;
  const item = testimonials[current];

  return (
    <section className="py-20" style={{ background: 'var(--color-bg-secondary)' }}>
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <SectionTitle title={t('testimonials_preview.title')} subtitle={t('testimonials_preview.subtitle')} center />

        <div className="max-w-3xl mx-auto">
          <AnimatePresence mode="wait">
            <motion.div
              key={current}
              initial={{ opacity: 0, x: 20 }}
              animate={{ opacity: 1, x: 0 }}
              exit={{ opacity: 0, x: -20 }}
              transition={{ duration: 0.4 }}
              className="card p-8 md:p-12 text-center"
            >
              <div className="flex justify-center gap-1 mb-6">
                {Array.from({ length: item.rating }).map((_, i) => (
                  <Star key={i} size={18} fill="#C9A14A" color="#C9A14A" />
                ))}
              </div>
              <blockquote
                className="text-lg md:text-xl leading-relaxed mb-8 italic"
                style={{ color: 'var(--color-text)' }}
              >
                "{lang === 'ar' ? item.text_ar : item.text_en}"
              </blockquote>
              <div className="flex items-center justify-center gap-4">
                <img src={item.avatar} alt={lang === 'ar' ? item.name_ar : item.name_en} className="w-12 h-12 rounded-full object-cover" />
                <div className="text-start">
                  <p className="font-semibold" style={{ color: 'var(--color-text)' }}>
                    {lang === 'ar' ? item.name_ar : item.name_en}
                  </p>
                  <p className="text-sm" style={{ color: '#C9A14A' }}>
                    {lang === 'ar' ? item.role_ar : item.role_en} · {lang === 'ar' ? item.project_ar : item.project_en}
                  </p>
                </div>
              </div>
            </motion.div>
          </AnimatePresence>

          <div className="flex items-center justify-center gap-4 mt-6">
            <button onClick={prev} className="w-10 h-10 border flex items-center justify-center transition-colors" style={{ borderColor: 'var(--color-border)', color: 'var(--color-text-secondary)' }}>
              <ChevronLeft size={18} />
            </button>
            <div className="flex gap-2">
              {testimonials.map((_, i) => (
                <button
                  key={i}
                  onClick={() => setCurrent(i)}
                  className="w-2 h-2 rounded-full transition-all"
                  style={{ background: i === current ? '#C9A14A' : 'var(--color-border)' }}
                />
              ))}
            </div>
            <button onClick={next} className="w-10 h-10 border flex items-center justify-center transition-colors" style={{ borderColor: 'var(--color-border)', color: 'var(--color-text-secondary)' }}>
              <ChevronRight size={18} />
            </button>
          </div>
        </div>

        <div className="mt-10 text-center">
          <Link to="/testimonials" className="btn-outline inline-flex">{t('testimonials_preview.view_all')}</Link>
        </div>
      </div>
    </section>
  );
}
