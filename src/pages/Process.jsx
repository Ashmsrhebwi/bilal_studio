import { useTranslation } from 'react-i18next';
import { motion } from 'framer-motion';
import { MessageCircle, Lightbulb, Box, FileText, HardHat, CheckCircle2 } from 'lucide-react';
import { useSEO } from '../hooks/useSEO';
import SectionTitle from '../components/ui/SectionTitle';

const stepIcons = [MessageCircle, Lightbulb, Box, FileText, HardHat, CheckCircle2];

export default function Process() {
  useSEO({ titleKey: 'seo.process_title', descKey: 'seo.process_desc' });
  const { t } = useTranslation();

  const steps = Array.from({ length: 6 }, (_, i) => ({
    key: `step${i + 1}`,
    icon: stepIcons[i],
    number: String(i + 1).padStart(2, '0'),
  }));

  return (
    <main className="pt-24 pb-20">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <SectionTitle title={t('process.title')} subtitle={t('process.subtitle')} center />

        {/* Steps — vertical on mobile, side-by-side on desktop */}
        <div className="relative mt-16">
          {/* Connector line */}
          <div
            className="hidden lg:block absolute top-1/2 start-0 end-0 h-px -translate-y-1/2"
            style={{ background: 'var(--color-border)' }}
          />
          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-8">
            {steps.map(({ key, icon: Icon, number }, i) => (
              <motion.div
                key={key}
                initial={{ opacity: 0, y: 30 }}
                whileInView={{ opacity: 1, y: 0 }}
                viewport={{ once: true }}
                transition={{ delay: i * 0.1, duration: 0.5 }}
                className="flex flex-col items-center text-center relative"
              >
                <div
                  className="relative z-10 w-16 h-16 rounded-full flex items-center justify-center mb-4 transition-transform hover:scale-110"
                  style={{ background: '#C9A14A', color: '#0E0E0E' }}
                >
                  <Icon size={26} />
                </div>
                <span className="text-xs font-bold mb-2" style={{ color: '#C9A14A', letterSpacing: '0.1em' }}>{number}</span>
                <h3 className="font-bold text-base mb-2" style={{ color: 'var(--color-text)' }}>
                  {t(`process.${key}.title`)}
                </h3>
                <p className="text-sm leading-relaxed" style={{ color: 'var(--color-text-secondary)' }}>
                  {t(`process.${key}.desc`)}
                </p>
              </motion.div>
            ))}
          </div>
        </div>

        {/* CTA */}
        <div className="mt-20 text-center">
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
          >
            <p className="text-lg mb-6" style={{ color: 'var(--color-text-secondary)' }}>
              {t('cta_section.subtitle')}
            </p>
            <a href="/book" className="btn-primary inline-flex">{t('nav.book')}</a>
          </motion.div>
        </div>
      </div>
    </main>
  );
}
