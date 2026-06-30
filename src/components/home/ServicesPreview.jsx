import { Link } from 'react-router-dom';
import { useTranslation } from 'react-i18next';
import { useQuery } from '@tanstack/react-query';
import * as Icons from 'lucide-react';
import { Box } from 'lucide-react';
import SectionTitle from '../ui/SectionTitle';
import RevealOnScroll from '../motion/RevealOnScroll';
import { servicesService } from '../../services';

function kebabToPascal(str) {
  return str.replace(/(^\w|-\w)/g, (s) => s.replace('-', '').toUpperCase());
}

export default function ServicesPreview() {
  const { t, i18n } = useTranslation();
  const lang = i18n.language;

  const { data: services = [] } = useQuery({
    queryKey: ['services'],
    queryFn: servicesService.getAll,
  });

  if (services.length === 0) return null;

  return (
    <section className="py-20" style={{ background: 'var(--color-bg-secondary)' }}>
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <SectionTitle title={t('services_preview.title')} subtitle={t('services_preview.subtitle')} center />

        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          {services.slice(0, 6).map((service, i) => {
            const Icon = Icons[kebabToPascal(service.icon || '')] || Box;
            return (
              <RevealOnScroll
                key={service.id}
                delay={i * 0.08}
                duration={0.6}
                className="card p-6 group cursor-pointer"
              >
                <div
                  className="w-12 h-12 flex items-center justify-center mb-4 transition-colors"
                  style={{ background: 'rgba(201,161,74,0.1)', color: '#C9A14A' }}
                >
                  <Icon size={22} />
                </div>
                <h3 className="font-semibold text-lg mb-2" style={{ color: 'var(--color-text)' }}>
                  {lang === 'ar' ? service.name_ar : service.name_en}
                </h3>
                <p className="text-sm leading-relaxed" style={{ color: 'var(--color-text-secondary)' }}>
                  {lang === 'ar' ? service.description_ar : service.description_en}
                </p>
              </RevealOnScroll>
            );
          })}
        </div>

        <div className="mt-12 text-center">
          <Link to="/services" className="btn-primary inline-flex">
            {t('services_preview.view_all')}
          </Link>
        </div>
      </div>
    </section>
  );
}
