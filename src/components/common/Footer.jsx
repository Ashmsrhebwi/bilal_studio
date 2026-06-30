import { useState } from 'react';
import { Link } from 'react-router-dom';
import { useTranslation } from 'react-i18next';
import { useQuery } from '@tanstack/react-query';
import { Mail, Phone, MapPin, Send } from 'lucide-react';

const InstagramIcon = () => (
  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
  </svg>
);
const FacebookIcon = () => (
  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
  </svg>
);
const LinkedInIcon = () => (
  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
    <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/>
  </svg>
);
import { newsletterService, settingsService } from '../../services';

const footerLinks = {
  pages: ['home', 'portfolio', 'services', 'about', 'process', 'blog', 'contact'],
  services: ['architectural', 'interior', 'exterior', 'supervision', 'rendering', 'consulting'],
};

const pagePaths = {
  home: '/', portfolio: '/portfolio', services: '/services',
  about: '/about', process: '/process', blog: '/blog', contact: '/contact',
};

export default function Footer() {
  const { t, i18n } = useTranslation();
  const lang = i18n.language;
  const [email, setEmail] = useState('');
  const [subscribed, setSubscribed] = useState(false);
  const [newsletterError, setNewsletterError] = useState(false);

  const { data: settings } = useQuery({
    queryKey: ['settings'],
    queryFn: settingsService.get,
  });
  const contact = settings?.contact || settings || {};
  const social = settings?.social || settings || {};
  const phone = contact.phone || '+963 21 234 5678';
  const phoneHref = contact.phone ? `tel:${contact.phone}` : 'tel:+963212345678';
  const contactEmail = contact.email || 'info@sardinistudio.com';
  const address = lang === 'ar' ? contact.address_ar : contact.address_en;

  const handleNewsletter = async (e) => {
    e.preventDefault();
    if (!email) return;
    setNewsletterError(false);
    try {
      await newsletterService.subscribe(email);
      setSubscribed(true);
      setEmail('');
    } catch {
      setNewsletterError(true);
    }
  };

  return (
    <footer style={{ background: '#0a0a0a', borderTop: '1px solid #1e1a14' }}>
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
          {/* Brand */}
          <div>
            <Link to="/" className="inline-flex items-center gap-2 mb-4">
              <div className="w-8 h-8 border flex items-center justify-center" style={{ borderColor: '#C9A14A', color: '#C9A14A' }}>
                <span style={{ fontFamily: 'Cormorant Garamond', fontWeight: 600 }}>S</span>
              </div>
              <span style={{ color: '#C9A14A', fontFamily: 'Cormorant Garamond', fontSize: '1.1rem', letterSpacing: '0.15em' }}>
                SARDINI STUDIO
              </span>
            </Link>
            <p className="text-sm leading-relaxed mb-6" style={{ color: '#a0958a' }}>
              {t('footer.description')}
            </p>
            <div className="flex items-center gap-3">
              {[
                { icon: InstagramIcon, href: social.instagram, label: 'Instagram' },
                { icon: FacebookIcon, href: social.facebook, label: 'Facebook' },
                { icon: LinkedInIcon, href: social.linkedin, label: 'LinkedIn' },
              ].filter(({ href }) => href).map(({ icon: Icon, href, label }) => (
                <a
                  key={label}
                  href={href}
                  target="_blank"
                  rel="noopener noreferrer"
                  aria-label={label}
                  className="w-9 h-9 border flex items-center justify-center transition-colors"
                  style={{ borderColor: '#2a2620', color: '#a0958a' }}
                  onMouseEnter={e => { e.currentTarget.style.borderColor = '#C9A14A'; e.currentTarget.style.color = '#C9A14A'; }}
                  onMouseLeave={e => { e.currentTarget.style.borderColor = '#2a2620'; e.currentTarget.style.color = '#a0958a'; }}
                >
                  <Icon size={16} />
                </a>
              ))}
            </div>
          </div>

          {/* Quick Links */}
          <div>
            <h3 className="font-semibold mb-5 text-sm tracking-wider uppercase" style={{ color: '#C9A14A' }}>
              {t('footer.quick_links')}
            </h3>
            <ul className="space-y-2">
              {footerLinks.pages.map((key) => (
                <li key={key}>
                  <Link
                    to={pagePaths[key]}
                    className="text-sm transition-colors"
                    style={{ color: '#a0958a' }}
                    onMouseEnter={e => e.currentTarget.style.color = '#C9A14A'}
                    onMouseLeave={e => e.currentTarget.style.color = '#a0958a'}
                  >
                    {t(`nav.${key}`)}
                  </Link>
                </li>
              ))}
            </ul>
          </div>

          {/* Contact */}
          <div>
            <h3 className="font-semibold mb-5 text-sm tracking-wider uppercase" style={{ color: '#C9A14A' }}>
              {t('footer.contact')}
            </h3>
            <ul className="space-y-3">
              <li className="flex items-start gap-2">
                <MapPin size={16} style={{ color: '#C9A14A', marginTop: 2, flexShrink: 0 }} />
                <span className="text-sm" style={{ color: '#a0958a' }}>{address || t('contact.address_value')}</span>
              </li>
              <li className="flex items-center gap-2">
                <Phone size={16} style={{ color: '#C9A14A', flexShrink: 0 }} />
                <a href={phoneHref} className="text-sm" style={{ color: '#a0958a' }}>{phone}</a>
              </li>
              <li className="flex items-center gap-2">
                <Mail size={16} style={{ color: '#C9A14A', flexShrink: 0 }} />
                <a href={`mailto:${contactEmail}`} className="text-sm" style={{ color: '#a0958a' }}>{contactEmail}</a>
              </li>
            </ul>
          </div>

          {/* Newsletter */}
          <div>
            <h3 className="font-semibold mb-5 text-sm tracking-wider uppercase" style={{ color: '#C9A14A' }}>
              {t('footer.newsletter')}
            </h3>
            <p className="text-sm mb-4" style={{ color: '#a0958a' }}>{t('footer.newsletter_text')}</p>
            {subscribed ? (
              <p className="text-sm" style={{ color: '#C9A14A' }}>✓ {t('footer.subscribe_success')}</p>
            ) : (
              <>
                <form onSubmit={handleNewsletter} className="flex gap-2">
                  <input
                    type="email"
                    value={email}
                    onChange={e => setEmail(e.target.value)}
                    placeholder={t('footer.email_placeholder')}
                    className="flex-1 px-3 py-2 text-sm bg-transparent border outline-none text-white placeholder-gray-600"
                    style={{ borderColor: '#2a2620' }}
                    onFocus={e => e.target.style.borderColor = '#C9A14A'}
                    onBlur={e => e.target.style.borderColor = '#2a2620'}
                  />
                  <button type="submit" className="px-3 py-2" style={{ background: '#C9A14A', color: '#0E0E0E' }}>
                    <Send size={16} />
                  </button>
                </form>
                {newsletterError && (
                  <p className="text-xs mt-2" style={{ color: '#ef4444' }}>{t('footer.newsletter_error')}</p>
                )}
              </>
            )}
          </div>
        </div>

        {/* Bottom */}
        <div className="mt-12 pt-6 flex flex-col sm:flex-row items-center justify-between gap-4" style={{ borderTop: '1px solid #1e1a14' }}>
          <p className="text-xs" style={{ color: '#555' }}>
            © {new Date().getFullYear()} Sardini Studio. {t('footer.rights')}.
          </p>
          <div className="flex items-center gap-4">
            <Link to="/privacy" className="text-xs transition-colors" style={{ color: '#555' }}
              onMouseEnter={e => e.currentTarget.style.color = '#C9A14A'}
              onMouseLeave={e => e.currentTarget.style.color = '#555'}
            >
              {t('footer.privacy')}
            </Link>
            <Link to="/terms" className="text-xs transition-colors" style={{ color: '#555' }}
              onMouseEnter={e => e.currentTarget.style.color = '#C9A14A'}
              onMouseLeave={e => e.currentTarget.style.color = '#555'}
            >
              {t('footer.terms')}
            </Link>
          </div>
        </div>
      </div>
    </footer>
  );
}
