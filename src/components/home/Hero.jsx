import { useRef, useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import { useTranslation } from 'react-i18next';
import { motion, useScroll, useTransform, useMotionValue, useSpring, useReducedMotion } from 'framer-motion';
import { ArrowDown } from 'lucide-react';

const HERO_IMAGE = 'https://images.unsplash.com/photo-1613490493576-7fde63acd811?w=1920&q=90';
const EASE_LUXE = [0.22, 1, 0.36, 1];

export default function Hero() {
  const { t } = useTranslation();
  const sectionRef = useRef(null);
  const prefersReducedMotion = useReducedMotion();
  const [canTrackMouse, setCanTrackMouse] = useState(false);

  const { scrollYProgress } = useScroll({ target: sectionRef, offset: ['start start', 'end start'] });
  const bgY = useTransform(scrollYProgress, [0, 1], ['0%', prefersReducedMotion ? '0%' : '18%']);
  const contentOpacity = useTransform(scrollYProgress, [0, 0.7], [1, 0]);
  const contentY = useTransform(scrollYProgress, [0, 1], ['0%', '12%']);

  const mvX = useMotionValue(0);
  const mvY = useMotionValue(0);
  const lineX = useSpring(mvX, { stiffness: 60, damping: 20 });
  const lineY = useSpring(mvY, { stiffness: 60, damping: 20 });

  useEffect(() => {
    setCanTrackMouse(window.matchMedia('(hover: hover) and (pointer: fine)').matches && !prefersReducedMotion);
  }, [prefersReducedMotion]);

  useEffect(() => {
    if (!canTrackMouse) return;
    const handleMove = (e) => {
      const nx = (e.clientX / window.innerWidth - 0.5) * 2;
      const ny = (e.clientY / window.innerHeight - 0.5) * 2;
      mvX.set(nx * 24);
      mvY.set(ny * 24);
    };
    window.addEventListener('mousemove', handleMove, { passive: true });
    return () => window.removeEventListener('mousemove', handleMove);
  }, [canTrackMouse, mvX, mvY]);

  const scrollDown = () => {
    window.scrollBy({ top: window.innerHeight, behavior: 'smooth' });
  };

  return (
    <section ref={sectionRef} className="relative min-h-screen flex items-center justify-center overflow-hidden">
      {/* Background with slow parallax + Ken Burns */}
      <motion.div className="absolute inset-0" style={{ y: bgY }}>
        <img
          src={HERO_IMAGE}
          alt="Sardini Studio"
          className={`w-full h-full object-cover ${prefersReducedMotion ? '' : 'animate-ken-burns'}`}
        />
        <div
          className="absolute inset-0"
          style={{ background: 'linear-gradient(to bottom, rgba(14,14,14,0.4) 0%, rgba(14,14,14,0.75) 60%, rgba(14,14,14,0.95) 100%)' }}
        />
      </motion.div>

      {/* Lightweight mouse-tracked architectural line art */}
      {!prefersReducedMotion && (
        <motion.svg
          aria-hidden
          className="absolute inset-0 w-full h-full pointer-events-none opacity-30 hidden md:block"
          style={{ x: lineX, y: lineY }}
          viewBox="0 0 1200 800"
          preserveAspectRatio="xMidYMid slice"
        >
          <motion.line x1="100" y1="700" x2="100" y2="120" stroke="#C9A14A" strokeWidth="1"
            initial={{ pathLength: 0 }} animate={{ pathLength: 1 }} transition={{ duration: 2, ease: EASE_LUXE, delay: 0.4 }} />
          <motion.line x1="100" y1="120" x2="420" y2="120" stroke="#C9A14A" strokeWidth="1"
            initial={{ pathLength: 0 }} animate={{ pathLength: 1 }} transition={{ duration: 1.4, ease: EASE_LUXE, delay: 1.2 }} />
          <motion.line x1="1100" y1="680" x2="1100" y2="260" stroke="#C9A14A" strokeWidth="1"
            initial={{ pathLength: 0 }} animate={{ pathLength: 1 }} transition={{ duration: 1.8, ease: EASE_LUXE, delay: 0.8 }} />
          <motion.line x1="780" y1="260" x2="1100" y2="260" stroke="#C9A14A" strokeWidth="1"
            initial={{ pathLength: 0 }} animate={{ pathLength: 1 }} transition={{ duration: 1.2, ease: EASE_LUXE, delay: 1.6 }} />
          <motion.circle cx="100" cy="120" r="3" fill="#C9A14A" initial={{ opacity: 0 }} animate={{ opacity: 1 }} transition={{ delay: 1.4 }} />
          <motion.circle cx="1100" cy="260" r="3" fill="#C9A14A" initial={{ opacity: 0 }} animate={{ opacity: 1 }} transition={{ delay: 1.8 }} />
        </motion.svg>
      )}

      {/* Content */}
      <motion.div className="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" style={{ opacity: contentOpacity, y: contentY }}>
        <motion.div initial={{ opacity: 0 }} animate={{ opacity: 1 }} transition={{ duration: 1 }}>
          {/* Office Name */}
          <motion.p
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ delay: 0.3, duration: 0.8, ease: EASE_LUXE }}
            className="text-sm font-medium uppercase mb-4 tracking-wider2"
            style={{ color: '#C9A14A' }}
          >
            {t('hero.office')}
          </motion.p>

          {/* Main Tagline */}
          <motion.h1
            initial={{ opacity: 0, y: 36 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ delay: 0.5, duration: 0.9, ease: EASE_LUXE }}
            className="text-4xl sm:text-5xl lg:text-7xl font-medium text-white leading-tight mb-6"
          >
            {t('hero.tagline')}
          </motion.h1>

          {/* Gold Divider */}
          <motion.div
            initial={{ width: 0 }}
            animate={{ width: 80 }}
            transition={{ delay: 0.9, duration: 0.7, ease: EASE_LUXE }}
            className="h-px mx-auto mb-6"
            style={{ background: '#C9A14A' }}
          />

          {/* Subtitle */}
          <motion.p
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ delay: 1.05, duration: 0.8, ease: EASE_LUXE }}
            className="text-lg md:text-xl text-gray-300 max-w-2xl mx-auto mb-10 leading-relaxed"
          >
            {t('hero.subtitle')}
          </motion.p>

          {/* CTAs */}
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ delay: 1.25, duration: 0.7, ease: EASE_LUXE }}
            className="flex flex-col sm:flex-row gap-4 justify-center items-center"
          >
            <Link to="/portfolio" className="btn-primary px-8 py-4 text-base font-semibold">
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
      </motion.div>

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
        <motion.div animate={prefersReducedMotion ? {} : { y: [0, 6, 0] }} transition={{ duration: 1.5, repeat: Infinity }}>
          <ArrowDown size={18} />
        </motion.div>
      </motion.button>
    </section>
  );
}
