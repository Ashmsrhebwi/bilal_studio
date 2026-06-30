import { Link } from 'react-router-dom';
import { useTranslation } from 'react-i18next';
import { motion } from 'framer-motion';
import { useQuery } from '@tanstack/react-query';
import * as Icons from 'lucide-react';
import { Box, ArrowRight, ArrowLeft } from 'lucide-react';
import { useSEO } from '../hooks/useSEO';
import { servicesService } from '../services';
import SectionTitle from '../components/ui/SectionTitle';

function kebabToPascal(str) {
  return str.replace(/(^\w|-\w)/g, (s) => s.replace('-', '').toUpperCase());
}

export default function Services() {
  useSEO({ titleKey: 'seo.services_title', descKey: 'seo.services_desc' });
  const { t, i18n } = useTranslation();
  const lang = i18n.language;
  const isRTL = lang === 'ar';
  const Arrow = isRTL ? ArrowLeft : ArrowRight;

  const { data: services = [], isLoading } = useQuery({
    queryKey: ['services'],
    queryFn: servicesService.getAll,
  });

  return (
    <main className="pt-24 pb-20">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <SectionTitle title={t('services.title')} subtitle={t('services.subtitle')} />

        {isLoading ? (
          <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
            {Array.from({ length: 4 }).map((_, i) => (
              <div key={i} className="card p-8 h-48 animate-pulse" style={{ background: 'var(--color-card)' }} />
            ))}
          </div>
        ) : services.length === 0 ? (
          <p className="text-center py-20" style={{ color: 'var(--color-text-secondary)' }}>
            {t('portfolio.no_results')}
          </p>
        ) : (
          <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
            {services.map((service, i) => {
              const Icon = Icons[kebabToPascal(service.icon || '')] || Box;
              return (
                <motion.div
                  key={service.id}
                  initial={{ opacity: 0, y: 20 }}
                  whileInView={{ opacity: 1, y: 0 }}
                  viewport={{ once: true }}
                  transition={{ delay: i * 0.08, duration: 0.6, ease: [0.22, 1, 0.36, 1] }}
                  className="card p-8 group"
                >
                  <div className="flex items-start gap-5">
                    <div
                      className="w-14 h-14 flex items-center justify-center shrink-0 transition-colors"
                      style={{ background: 'rgba(201,161,74,0.1)', color: '#C9A14A' }}
                    >
                      <Icon size={26} />
                    </div>
                    <div className="flex-1">
                      <h3 className="text-xl font-bold mb-3" style={{ color: 'var(--color-text)' }}>
                        {lang === 'ar' ? service.name_ar : service.name_en}
                      </h3>
                      <p className="leading-relaxed mb-4" style={{ color: 'var(--color-text-secondary)' }}>
                        {lang === 'ar' ? service.description_ar : service.description_en}
                      </p>
                      {(lang === 'ar' ? service.details_ar : service.details_en) && (
                        <p className="text-sm leading-relaxed mb-5" style={{ color: 'var(--color-text-secondary)' }}>
                          {lang === 'ar' ? service.details_ar : service.details_en}
                        </p>
                      )}
                      <div className="flex items-center gap-4">
                        <Link to="/contact" className="btn-primary text-sm px-4 py-2">
                          {t('services.get_quote')}
                        </Link>
                      </div>
                    </div>
                  </div>
                </motion.div>
              );
            })}
          </div>
        )}

        {/* CTA */}
        <div className="mt-16 text-center py-16 px-8 rounded" style={{ background: 'linear-gradient(135deg, rgba(201,161,74,0.1), rgba(201,161,74,0.05))', border: '1px solid rgba(201,161,74,0.2)' }}>
          <h2 className="text-2xl font-bold mb-4" style={{ color: 'var(--color-text)' }}>
            {t('cta_section.title')}
          </h2>
          <p className="mb-6" style={{ color: 'var(--color-text-secondary)' }}>{t('cta_section.subtitle')}</p>
          <Link to="/contact" className="btn-primary inline-flex">{t('cta_section.btn_contact')}</Link>
        </div>
      </div>
    </main>
  );
}
