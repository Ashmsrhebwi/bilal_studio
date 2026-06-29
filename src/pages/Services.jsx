import { Link } from 'react-router-dom';
import { useTranslation } from 'react-i18next';
import { motion } from 'framer-motion';
import { Building2, Sofa, Layers, HardHat, Box, MessageSquare, ArrowRight, ArrowLeft } from 'lucide-react';
import SectionTitle from '../components/ui/SectionTitle';

const serviceKeys = ['architectural', 'interior', 'exterior', 'supervision', 'rendering', 'consulting'];
const serviceIcons = [Building2, Sofa, Layers, HardHat, Box, MessageSquare];

export default function Services() {
  const { t, i18n } = useTranslation();
  const isRTL = i18n.language === 'ar';
  const Arrow = isRTL ? ArrowLeft : ArrowRight;

  return (
    <main className="pt-24 pb-20">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <SectionTitle title={t('services.title')} subtitle={t('services.subtitle')} />

        <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
          {serviceKeys.map((key, i) => {
            const Icon = serviceIcons[i];
            return (
              <motion.div
                key={key}
                initial={{ opacity: 0, y: 20 }}
                whileInView={{ opacity: 1, y: 0 }}
                viewport={{ once: true }}
                transition={{ delay: i * 0.08 }}
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
                      {t(`services.${key}.name`)}
                    </h3>
                    <p className="leading-relaxed mb-4" style={{ color: 'var(--color-text-secondary)' }}>
                      {t(`services.${key}.desc`)}
                    </p>
                    <p className="text-sm leading-relaxed mb-5" style={{ color: 'var(--color-text-secondary)' }}>
                      {t(`services.${key}.details`)}
                    </p>
                    <div className="flex items-center gap-4">
                      <Link to="/contact" className="btn-primary text-sm px-4 py-2">
                        {t('services.get_quote')}
                      </Link>
                      <button
                        className="flex items-center gap-1 text-sm font-medium transition-colors"
                        style={{ color: '#C9A14A' }}
                      >
                        {t('services.learn_more')} <Arrow size={14} />
                      </button>
                    </div>
                  </div>
                </div>
              </motion.div>
            );
          })}
        </div>

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
