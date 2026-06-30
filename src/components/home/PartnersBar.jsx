import { useTranslation } from 'react-i18next';
import { motion } from 'framer-motion';
import { mockPartners } from '../../api/mock/data';

export default function PartnersBar() {
  const { t } = useTranslation();

  return (
    <section className="py-14" style={{ background: 'var(--color-bg)', borderTop: '1px solid var(--color-border)', borderBottom: '1px solid var(--color-border)' }}>
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <p className="text-center text-xs tracking-[0.3em] uppercase mb-10" style={{ color: '#C9A14A' }}>
          {t('partners.title')}
        </p>
        <div className="flex flex-wrap items-center justify-center gap-8 md:gap-14">
          {mockPartners.map((p, i) => (
            <motion.div
              key={p.id}
              initial={{ opacity: 0 }}
              whileInView={{ opacity: 1 }}
              viewport={{ once: true }}
              transition={{ delay: i * 0.05, duration: 0.6, ease: [0.22, 1, 0.36, 1] }}
              className="text-lg font-semibold tracking-wider transition-colors"
              style={{ color: 'var(--color-text-secondary)', fontFamily: 'Cormorant Garamond, serif' }}
            >
              {p.name}
            </motion.div>
          ))}
        </div>
      </div>
    </section>
  );
}
