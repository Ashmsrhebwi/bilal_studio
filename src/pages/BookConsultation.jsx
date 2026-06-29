import { useState } from 'react';
import { useTranslation } from 'react-i18next';
import { motion } from 'framer-motion';
import { useForm } from 'react-hook-form';
import { zodResolver } from '@hookform/resolvers/zod';
import { z } from 'zod';
import { Calendar, CheckCircle } from 'lucide-react';
import { useSEO } from '../hooks/useSEO';
import { bookingService } from '../services';
import SectionTitle from '../components/ui/SectionTitle';

const schema = z.object({
  name: z.string().min(2),
  email: z.string().email(),
  phone: z.string().min(8),
  date: z.string().min(1),
  time: z.string().min(1),
  project_type: z.string().min(1),
  notes: z.string().optional(),
});

export default function BookConsultation() {
  useSEO({ titleKey: 'seo.book_title', descKey: 'seo.book_desc' });
  const { t } = useTranslation();
  const [done, setDone] = useState(false);

  const { register, handleSubmit, formState: { errors, isSubmitting } } = useForm({ resolver: zodResolver(schema) });

  const onSubmit = async (data) => {
    await bookingService.create(data);
    setDone(true);
  };

  const inputCls = "w-full px-4 py-3 bg-transparent border outline-none transition-colors text-sm";
  const inputSt = (err) => ({ borderColor: err ? '#ef4444' : 'var(--color-border)', color: 'var(--color-text)' });
  const focusGold = (e) => { e.target.style.borderColor = '#C9A14A'; };
  const blurReset = (err) => (e) => { e.target.style.borderColor = err ? '#ef4444' : 'var(--color-border)'; };

  return (
    <main className="pt-24 pb-20">
      <div className="max-w-2xl mx-auto px-4 sm:px-6">
        <SectionTitle title={t('book.title')} subtitle={t('book.subtitle')} center />

        <div className="card p-8">
          {done ? (
            <motion.div
              initial={{ opacity: 0, scale: 0.9 }}
              animate={{ opacity: 1, scale: 1 }}
              className="flex flex-col items-center py-12 gap-4 text-center"
            >
              <CheckCircle size={60} style={{ color: '#C9A14A' }} />
              <p className="text-lg font-semibold" style={{ color: 'var(--color-text)' }}>{t('book.success')}</p>
            </motion.div>
          ) : (
            <form onSubmit={handleSubmit(onSubmit)} className="space-y-5" noValidate>
              <div className="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                  <label className="block text-sm mb-1" style={{ color: 'var(--color-text-secondary)' }}>{t('book.name')}</label>
                  <input {...register('name')} className={inputCls} style={inputSt(errors.name)} onFocus={focusGold} onBlur={blurReset(errors.name)} />
                </div>
                <div>
                  <label className="block text-sm mb-1" style={{ color: 'var(--color-text-secondary)' }}>{t('book.email')}</label>
                  <input {...register('email')} type="email" className={inputCls} style={inputSt(errors.email)} onFocus={focusGold} onBlur={blurReset(errors.email)} />
                </div>
              </div>
              <div className="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                  <label className="block text-sm mb-1" style={{ color: 'var(--color-text-secondary)' }}>{t('book.phone')}</label>
                  <input {...register('phone')} type="tel" className={inputCls} style={inputSt(errors.phone)} onFocus={focusGold} onBlur={blurReset(errors.phone)} />
                </div>
                <div>
                  <label className="block text-sm mb-1" style={{ color: 'var(--color-text-secondary)' }}>{t('book.project_type')}</label>
                  <select {...register('project_type')} className={inputCls} style={inputSt(errors.project_type)}>
                    <option value="">{t('contact.select_type')}</option>
                    {['residential','commercial','interior','exterior','hospitality','other'].map(tp => (
                      <option key={tp} value={tp}>{t(`contact.${tp}`)}</option>
                    ))}
                  </select>
                </div>
              </div>
              <div className="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                  <label className="block text-sm mb-1" style={{ color: 'var(--color-text-secondary)' }}>{t('book.date')}</label>
                  <input {...register('date')} type="date" className={inputCls} style={inputSt(errors.date)} onFocus={focusGold} onBlur={blurReset(errors.date)} />
                </div>
                <div>
                  <label className="block text-sm mb-1" style={{ color: 'var(--color-text-secondary)' }}>{t('book.time')}</label>
                  <select {...register('time')} className={inputCls} style={inputSt(errors.time)}>
                    <option value="">—</option>
                    {['morning','afternoon','evening'].map(tm => (
                      <option key={tm} value={tm}>{t(`book.${tm}`)}</option>
                    ))}
                  </select>
                </div>
              </div>
              <div>
                <label className="block text-sm mb-1" style={{ color: 'var(--color-text-secondary)' }}>{t('book.notes')}</label>
                <textarea {...register('notes')} rows={4} className={inputCls} style={inputSt(false)} onFocus={focusGold} onBlur={e => e.target.style.borderColor = 'var(--color-border)'} />
              </div>
              <button type="submit" disabled={isSubmitting} className="btn-primary w-full justify-center py-4 text-base flex items-center gap-2">
                <Calendar size={18} />
                {isSubmitting ? '...' : t('book.submit')}
              </button>
            </form>
          )}
        </div>
      </div>
    </main>
  );
}
