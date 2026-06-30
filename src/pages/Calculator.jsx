import { useState } from 'react';
import { useTranslation } from 'react-i18next';
import { motion, AnimatePresence } from 'framer-motion';
import { useForm } from 'react-hook-form';
import { zodResolver } from '@hookform/resolvers/zod';
import { z } from 'zod';
import { Calculator as CalcIcon, ArrowRight } from 'lucide-react';
import { Link } from 'react-router-dom';
import { useSEO } from '../hooks/useSEO';
import SectionTitle from '../components/ui/SectionTitle';

const schema = z.object({
  area: z.coerce.number().min(50, 'min_area'),
  type: z.string().min(1, 'required'),
  quality: z.string().min(1, 'required'),
});

const RATES = {
  residential:  { standard: 4500000, premium: 7000000, luxury: 12000000 },
  commercial:   { standard: 5500000, premium: 8500000, luxury: 14000000 },
  interior:     { standard: 1500000, premium: 3000000, luxury: 6000000 },
  hospitality:  { standard: 8000000, premium: 12000000, luxury: 20000000 },
};

export default function Calculator() {
  useSEO({ titleKey: 'seo.calculator_title', descKey: 'seo.calculator_desc' });
  const { t, i18n } = useTranslation();
  const [result, setResult] = useState(null);

  const { register, handleSubmit, formState: { errors } } = useForm({ resolver: zodResolver(schema) });

  const onSubmit = ({ area, type, quality }) => {
    const rate = RATES[type]?.[quality] || 5000000;
    setResult({ total: area * rate, rate, area });
  };

  const fmt = (n) => n.toLocaleString(i18n.language === 'ar' ? 'ar-SY' : 'en-US');

  return (
    <main className="pt-24 pb-20">
      <div className="max-w-3xl mx-auto px-4 sm:px-6">
        <SectionTitle title={t('calculator.title')} subtitle={t('calculator.subtitle')} center />

        <div className="card p-8">
          <form onSubmit={handleSubmit(onSubmit)} className="space-y-6">
            <div>
              <label className="block text-sm font-medium mb-2" style={{ color: 'var(--color-text)' }}>{t('calculator.area')}</label>
              <input
                {...register('area')}
                type="number"
                min="50"
                placeholder={t('calculator.area_placeholder')}
                className="w-full px-4 py-3 bg-transparent border outline-none transition-colors"
                style={{ borderColor: 'var(--color-border)', color: 'var(--color-text)' }}
                onFocus={e => e.target.style.borderColor = '#C9A14A'}
                onBlur={e => e.target.style.borderColor = 'var(--color-border)'}
              />
              {errors.area && <p className="text-xs text-red-500 mt-1">{t(`calculator.${errors.area.message}`)}</p>}
            </div>

            <div>
              <label className="block text-sm font-medium mb-2" style={{ color: 'var(--color-text)' }}>{t('calculator.type')}</label>
              <select
                {...register('type')}
                className="w-full px-4 py-3 bg-transparent border outline-none"
                style={{ borderColor: 'var(--color-border)', color: 'var(--color-text)' }}
              >
                <option value="">{t('contact.select_type')}</option>
                {Object.keys(RATES).map((t_key) => (
                  <option key={t_key} value={t_key}>{t(`contact.${t_key === 'hospitality' ? 'hospitality' : t_key}`)}</option>
                ))}
              </select>
              {errors.type && <p className="text-xs text-red-500 mt-1">{t('contact.required')}</p>}
            </div>

            <div>
              <label className="block text-sm font-medium mb-3" style={{ color: 'var(--color-text)' }}>{t('calculator.quality')}</label>
              <div className="grid grid-cols-3 gap-3">
                {['standard', 'premium', 'luxury'].map((q) => (
                  <label key={q} className="cursor-pointer">
                    <input {...register('quality')} type="radio" value={q} className="sr-only" />
                    <div className="text-center py-3 px-2 border text-sm font-medium transition-all has-[:checked]:border-yellow-500 has-[:checked]:bg-yellow-500 has-[:checked]:text-black"
                      style={{ borderColor: 'var(--color-border)', color: 'var(--color-text-secondary)' }}>
                      {t(`calculator.${q}`)}
                    </div>
                  </label>
                ))}
              </div>
              {errors.quality && <p className="text-xs text-red-500 mt-1">{t('contact.required')}</p>}
            </div>

            <button type="submit" className="btn-primary w-full justify-center py-4 text-base flex items-center gap-2">
              <CalcIcon size={18} />
              {t('calculator.calculate')}
            </button>
          </form>

          <AnimatePresence>
            {result && (
              <motion.div
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                exit={{ opacity: 0 }}
                className="mt-8 p-6 border"
                style={{ borderColor: 'rgba(201,161,74,0.4)', background: 'rgba(201,161,74,0.05)' }}
              >
                <h3 className="font-bold text-lg mb-5 text-center" style={{ color: 'var(--color-text)' }}>
                  {t('calculator.result_title')}
                </h3>
                <div className="space-y-3 mb-6">
                  <div className="flex justify-between text-sm">
                    <span style={{ color: 'var(--color-text-secondary)' }}>{t('calculator.per_sqm')}</span>
                    <span className="font-semibold" style={{ color: 'var(--color-text)' }}>
                      {fmt(result.rate)} {t('calculator.currency')}
                    </span>
                  </div>
                  <div className="flex justify-between text-sm">
                    <span style={{ color: 'var(--color-text-secondary)' }}>{t('calculator.area')}</span>
                    <span className="font-semibold" style={{ color: 'var(--color-text)' }}>{result.area} {t('project_detail.sqm')}</span>
                  </div>
                  <div
                    className="flex justify-between pt-3 mt-3 font-bold text-lg"
                    style={{ borderTop: '1px solid var(--color-border)' }}
                  >
                    <span style={{ color: 'var(--color-text)' }}>{t('calculator.total')}</span>
                    <span style={{ color: '#C9A14A' }}>
                      {fmt(result.total)} {t('calculator.currency')}
                    </span>
                  </div>
                </div>
                <p className="text-xs text-center mb-4" style={{ color: 'var(--color-text-secondary)' }}>
                  * {t('calculator.disclaimer')}
                </p>
                <Link to="/contact" className="btn-primary w-full justify-center flex items-center gap-2">
                  {t('calculator.contact_us')} <ArrowRight size={16} />
                </Link>
              </motion.div>
            )}
          </AnimatePresence>
        </div>
      </div>
    </main>
  );
}
