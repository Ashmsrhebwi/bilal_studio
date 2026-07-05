import { Link } from 'react-router-dom';
import { useTranslation } from 'react-i18next';
import { motion } from 'framer-motion';
import { Home } from 'lucide-react';
import { useSEO } from '../hooks/useSEO';

export default function NotFound() {
  const { t } = useTranslation();

  useSEO({
    titleFallback: `${t('not_found.title')} — ${t('not_found.subtitle')}`,
    descFallback: t('not_found.text'),
  });

  return (
    <main className="min-h-screen flex items-center justify-center px-4">
      <motion.div
        initial={{ opacity: 0, y: 30 }}
        animate={{ opacity: 1, y: 0 }}
        transition={{ duration: 0.6 }}
        className="text-center max-w-lg"
      >
        <div
          className="text-8xl md:text-9xl font-bold mb-4"
          style={{ color: '#C9A14A', fontFamily: 'Cormorant Garamond, serif' }}
        >
          {t('not_found.title')}
        </div>
        <span className="gold-line mb-6" style={{ margin: '0 auto 1.5rem' }} />
        <h2 className="text-2xl font-bold mb-4" style={{ color: 'var(--color-text)' }}>
          {t('not_found.subtitle')}
        </h2>
        <p className="mb-8" style={{ color: 'var(--color-text-secondary)' }}>
          {t('not_found.text')}
        </p>
        <Link to="/" className="btn-primary inline-flex items-center gap-2">
          <Home size={18} />
          {t('not_found.back_home')}
        </Link>
      </motion.div>
    </main>
  );
}
