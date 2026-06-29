import { useRef } from 'react';
import { Link } from 'react-router-dom';
import { useTranslation } from 'react-i18next';
import { motion } from 'framer-motion';
import { ArrowDown, Play } from 'lucide-react';

const HERO_IMAGE = 'https://images.unsplash.com/photo-1613490493576-7fde63acd811?w=1920&q=90';

export default function Hero() {
  const { t } = useTranslation();
  const scrollRef = useRef(null);

  const scrollDown = () => {
    window.scrollBy({ top: window.innerHeight, behavior: 'smooth' });
  };

  return (
    <section className="relative min-h-screen flex items-center justify-center overflow-hidden">
      {/* Background */}
      <div className="absolute inset-0">
        <img
          src={HERO_IMAGE}
          alt="Sardini Studio"
          className="w-full h-full object-cover"
        />
        <div className="absolute inset-0 bg-hero-gradient" style={{ background: 'linear-gradient(to bottom, rgba(14,14,14,0.4) 0%, rgba(14,14,14,0.75) 60%, rgba(14,14,14,0.95) 100%)' }} />
      </div>

      {/* Content */}
      <div className="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <motion.div
          initial={{ opacity: 0 }}
          animate={{ opacity: 1 }}
          transition={{ duration: 1 }}
        >
          {/* Office Name */}
          <motion.p
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ delay: 0.3, duration: 0.7 }}
            className="text-sm font-medium tracking-[0.3em] uppercase mb-4"
            style={{ color: '#C9A14A' }}
          >
            {t('hero.office')}
          </motion.p>

          {/* Main Tagline */}
          <motion.h1
            initial={{ opacity: 0, y: 30 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ delay: 0.5, duration: 0.8 }}
            className="text-4xl sm:text-5xl lg:text-7xl font-bold text-white leading-tight mb-6"
          >
            {t('hero.tagline')}
          </motion.h1>

          {/* Gold Divider */}
          <motion.div
            initial={{ width: 0 }}
            animate={{ width: 80 }}
            transition={{ delay: 0.9, duration: 0.6 }}
            className="h-px mx-auto mb-6"
            style={{ background: '#C9A14A' }}
          />

          {/* Subtitle */}
          <motion.p
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ delay: 1, duration: 0.7 }}
            className="text-lg md:text-xl text-gray-300 max-w-2xl mx-auto mb-10 leading-relaxed"
          >
            {t('hero.subtitle')}
          </motion.p>

          {/* CTAs */}
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ delay: 1.2, duration: 0.6 }}
            className="flex flex-col sm:flex-row gap-4 justify-center items-center"
          >
            <Link
              to="/portfolio"
              className="btn-primary px-8 py-4 text-base font-semibold"
            >
              {t('hero.cta_portfolio')}
            </Link>
            <Link
              to="/book"
              className="btn-outline px-8 py-4 text-base font-semibold"
              style={{ color: 'white', borderColor: 'rgba(255,255,255,0.5)' }}
            >
              {t('hero.cta_consult')}
            </Link>
          </motion.div>
        </motion.div>
      </div>

      {/* Scroll Down */}
      <motion.button
        initial={{ opacity: 0 }}
        animate={{ opacity: 1 }}
        transition={{ delay: 2, duration: 0.6 }}
        onClick={scrollDown}
        aria-label={t('hero.scroll_down')}
        className="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-white/60 hover:text-white transition-colors"
      >
        <span className="text-xs tracking-widest uppercase">{t('hero.scroll_down')}</span>
        <motion.div animate={{ y: [0, 6, 0] }} transition={{ duration: 1.5, repeat: Infinity }}>
          <ArrowDown size={18} />
        </motion.div>
      </motion.button>
    </section>
  );
}
