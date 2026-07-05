import { useState, useEffect } from 'react';
import { Link, NavLink, useLocation } from 'react-router-dom';
import { useTranslation } from 'react-i18next';
import { motion, AnimatePresence } from 'framer-motion';
import { Menu, X, Sun, Moon, Globe } from 'lucide-react';
import { useLang } from '../../context/LanguageContext';
import { useTheme } from '../../context/ThemeContext';

const navItems = [
  { key: 'home', path: '/' },
  { key: 'portfolio', path: '/portfolio' },
  { key: 'services', path: '/services' },
  { key: 'about', path: '/about' },
  { key: 'process', path: '/process' },
  { key: 'blog', path: '/blog' },
  { key: 'contact', path: '/contact' },
];

export default function Navbar() {
  const { t } = useTranslation();
  const { lang, switchLanguage, isRTL } = useLang();
  const { theme, toggleTheme } = useTheme();
  const [scrolled, setScrolled] = useState(false);
  const [mobileOpen, setMobileOpen] = useState(false);
  const location = useLocation();

  useEffect(() => {
    const onScroll = () => setScrolled(window.scrollY > 50);
    window.addEventListener('scroll', onScroll, { passive: true });
    return () => window.removeEventListener('scroll', onScroll);
  }, []);

  useEffect(() => setMobileOpen(false), [location]);

  return (
    <>
      <motion.nav
        initial={{ y: -80 }}
        animate={{ y: 0 }}
        transition={{ duration: 0.6, ease: [0.22, 1, 0.36, 1] }}
        className="fixed top-0 inset-x-0 z-40 transition-all duration-300"
        style={{
          background: scrolled ? 'var(--color-nav)' : 'transparent',
          backdropFilter: scrolled ? 'blur(12px)' : 'none',
          borderBottom: scrolled ? '1px solid var(--color-border)' : 'none',
          boxShadow: scrolled ? '0 2px 20px rgba(0,0,0,0.15)' : 'none',
        }}
      >
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex items-center justify-between h-16 lg:h-20">
            {/* Logo */}
            <Link to="/" className="flex items-center gap-2 group">
              <div
                className="w-8 h-8 flex items-center justify-center border transition-all duration-300 group-hover:scale-110"
                style={{ borderColor: '#C9A14A', color: '#C9A14A' }}
              >
                <span style={{ fontFamily: 'Cormorant Garamond, serif', fontWeight: 600 }}>S</span>
              </div>
              <div>
                <div style={{ color: '#C9A14A', fontFamily: 'Cormorant Garamond, serif', fontSize: '1.1rem', letterSpacing: '0.15em', lineHeight: 1.1 }}>
                  SARDINI
                </div>
                <div style={{ color: 'var(--color-text-secondary)', fontSize: '0.6rem', letterSpacing: '0.2em', lineHeight: 1 }}>
                  STUDIO
                </div>
              </div>
            </Link>

            {/* Desktop Nav */}
            <div className="hidden lg:flex items-center gap-6">
              {navItems.map(({ key, path }) => (
                <NavLink
                  key={key}
                  to={path}
                  end={path === '/'}
                  className={({ isActive }) => `nav-link text-sm ${isActive ? 'active' : ''}`}
                >
                  {t(`nav.${key}`)}
                </NavLink>
              ))}
            </div>

            {/* Actions */}
            <div className="flex items-center gap-2">
              <button
                onClick={toggleTheme}
                aria-label={theme === 'dark' ? t('common.light_mode') : t('common.dark_mode')}
                className="p-2 rounded-full transition-colors hover:bg-white/10"
                style={{ color: 'var(--color-text-secondary)' }}
              >
                {theme === 'dark' ? <Sun size={18} /> : <Moon size={18} />}
              </button>
              <button
                onClick={() => switchLanguage(lang === 'ar' ? 'en' : 'ar')}
                aria-label={t('common.lang_switch')}
                className="flex items-center gap-1 px-3 py-1.5 text-xs font-medium border transition-colors"
                style={{ borderColor: 'var(--color-gold)', color: 'var(--color-gold)' }}
              >
                <Globe size={14} />
                {t('common.lang_switch')}
              </button>
              <Link
                to="/book"
                className="hidden lg:inline-flex btn-primary text-sm px-4 py-2"
              >
                {t('nav.book')}
              </Link>
              <button
                onClick={() => setMobileOpen(!mobileOpen)}
                className="lg:hidden p-2"
                style={{ color: 'var(--color-text)' }}
                aria-label="Toggle menu"
              >
                {mobileOpen ? <X size={22} /> : <Menu size={22} />}
              </button>
            </div>
          </div>
        </div>
      </motion.nav>

      {/* Mobile Menu */}
      <AnimatePresence>
        {mobileOpen && (
          <motion.div
            initial={{ opacity: 0, height: 0 }}
            animate={{ opacity: 1, height: 'auto' }}
            exit={{ opacity: 0, height: 0 }}
            transition={{ duration: 0.3 }}
            className="fixed top-16 inset-x-0 z-30 overflow-hidden"
            style={{ background: 'var(--color-nav)', backdropFilter: 'blur(12px)', borderBottom: '1px solid var(--color-border)' }}
          >
            <div className="px-4 py-4 flex flex-col gap-1">
              {navItems.map(({ key, path }) => (
                <NavLink
                  key={key}
                  to={path}
                  end={path === '/'}
                  className={({ isActive }) =>
                    `py-3 px-4 text-base font-medium border-b transition-colors ${isActive ? 'text-yellow-500' : ''}`
                  }
                  style={{ color: 'var(--color-text)', borderColor: 'var(--color-border)' }}
                >
                  {t(`nav.${key}`)}
                </NavLink>
              ))}
              <Link to="/book" className="btn-primary mt-3 justify-center">
                {t('nav.book')}
              </Link>
            </div>
          </motion.div>
        )}
      </AnimatePresence>
    </>
  );
}
