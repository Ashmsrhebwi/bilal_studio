import { Link } from 'react-router-dom';
import { useTranslation } from 'react-i18next';
import { Phone, Calendar } from 'lucide-react';
import RevealOnScroll from '../motion/RevealOnScroll';
import GoldLineDivider from '../motion/GoldLineDivider';

export default function CTASection() {
  const { t } = useTranslation();

  return (
    <section
      className="py-24 relative overflow-hidden"
      style={{ background: 'linear-gradient(135deg, #0a0a0a 0%, #1a1408 100%)' }}
    >
      <div
        className="absolute inset-0 opacity-10"
        style={{ backgroundImage: 'repeating-linear-gradient(45deg, #C9A14A 0, #C9A14A 1px, transparent 0, transparent 50%)', backgroundSize: '20px 20px' }}
      />
      <div className="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 text-center">
        <RevealOnScroll duration={0.9}>
          <GoldLineDivider width={64} center className="mb-6" />
          <h2 className="text-3xl md:text-5xl font-bold text-white mb-6 leading-tight">
            {t('cta_section.title')}
          </h2>
          <p className="text-lg text-gray-400 mb-10">
            {t('cta_section.subtitle')}
          </p>
          <div className="flex flex-col sm:flex-row gap-4 justify-center">
            <Link to="/contact" className="btn-primary px-8 py-4 text-base flex items-center gap-2 justify-center">
              <Phone size={18} />
              {t('cta_section.btn_contact')}
            </Link>
            <Link to="/book" className="btn-outline px-8 py-4 text-base flex items-center gap-2 justify-center">
              <Calendar size={18} />
              {t('cta_section.btn_book')}
            </Link>
          </div>
        </RevealOnScroll>
      </div>
    </section>
  );
}
