import { useState } from 'react';
import { useTranslation } from 'react-i18next';
import { motion } from 'framer-motion';
import { useForm } from 'react-hook-form';
import { zodResolver } from '@hookform/resolvers/zod';
import { z } from 'zod';
import { MapPin, Phone, Mail, Clock, Send, CheckCircle } from 'lucide-react';
import { contactService } from '../services';
import SectionTitle from '../components/ui/SectionTitle';
import { WHATSAPP_NUMBER } from '../api/config';

const schema = z.object({
  name: z.string().min(2, 'required'),
  email: z.string().email('invalid_email'),
  phone: z.string().min(8, 'invalid_phone'),
  project_type: z.string().min(1, 'required'),
  message: z.string().min(10, 'required'),
});

export default function Contact() {
  const { t } = useTranslation();
  const [submitted, setSubmitted] = useState(false);
  const [serverError, setServerError] = useState('');

  const { register, handleSubmit, formState: { errors, isSubmitting } } = useForm({
    resolver: zodResolver(schema),
  });

  const onSubmit = async (data) => {
    setServerError('');
    try {
      await contactService.send(data);
      setSubmitted(true);
    } catch {
      setServerError(t('contact.error'));
    }
  };

  const inputClass = "w-full px-4 py-3 bg-transparent border outline-none transition-colors text-sm";
  const inputStyle = (hasError) => ({ borderColor: hasError ? '#ef4444' : 'var(--color-border)', color: 'var(--color-text)' });

  const contactInfo = [
    { icon: MapPin, label: t('contact.address'), value: t('contact.address_value') },
    { icon: Phone, label: t('contact.phone_label'), value: '+963 21 234 5678', href: 'tel:+963212345678' },
    { icon: Mail, label: t('contact.email_label'), value: 'info@sardinistudio.com', href: 'mailto:info@sardinistudio.com' },
    { icon: Clock, label: t('contact.hours'), value: t('contact.hours_value') },
  ];

  return (
    <main className="pt-24 pb-20">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <SectionTitle title={t('contact.title')} subtitle={t('contact.subtitle')} />

        <div className="grid grid-cols-1 lg:grid-cols-3 gap-12">
          {/* Form */}
          <div className="lg:col-span-2">
            {submitted ? (
              <motion.div
                initial={{ opacity: 0, scale: 0.9 }}
                animate={{ opacity: 1, scale: 1 }}
                className="flex flex-col items-center justify-center py-20 text-center gap-4"
              >
                <CheckCircle size={60} style={{ color: '#C9A14A' }} />
                <h3 className="text-xl font-bold" style={{ color: 'var(--color-text)' }}>{t('contact.success')}</h3>
              </motion.div>
            ) : (
              <form onSubmit={handleSubmit(onSubmit)} className="space-y-5" noValidate>
                <div className="grid grid-cols-1 sm:grid-cols-2 gap-5">
                  <div>
                    <label className="block text-sm mb-1" style={{ color: 'var(--color-text-secondary)' }}>{t('contact.name')}</label>
                    <input {...register('name')} className={inputClass} style={inputStyle(errors.name)} onFocus={e => e.target.style.borderColor = '#C9A14A'} onBlur={e => e.target.style.borderColor = errors.name ? '#ef4444' : 'var(--color-border)'} />
                    {errors.name && <p className="text-xs text-red-500 mt-1">{t(`contact.${errors.name.message}`)}</p>}
                  </div>
                  <div>
                    <label className="block text-sm mb-1" style={{ color: 'var(--color-text-secondary)' }}>{t('contact.email')}</label>
                    <input {...register('email')} type="email" className={inputClass} style={inputStyle(errors.email)} onFocus={e => e.target.style.borderColor = '#C9A14A'} onBlur={e => e.target.style.borderColor = errors.email ? '#ef4444' : 'var(--color-border)'} />
                    {errors.email && <p className="text-xs text-red-500 mt-1">{t(`contact.${errors.email.message}`)}</p>}
                  </div>
                </div>
                <div className="grid grid-cols-1 sm:grid-cols-2 gap-5">
                  <div>
                    <label className="block text-sm mb-1" style={{ color: 'var(--color-text-secondary)' }}>{t('contact.phone')}</label>
                    <input {...register('phone')} type="tel" className={inputClass} style={inputStyle(errors.phone)} onFocus={e => e.target.style.borderColor = '#C9A14A'} onBlur={e => e.target.style.borderColor = errors.phone ? '#ef4444' : 'var(--color-border)'} />
                    {errors.phone && <p className="text-xs text-red-500 mt-1">{t(`contact.${errors.phone.message}`)}</p>}
                  </div>
                  <div>
                    <label className="block text-sm mb-1" style={{ color: 'var(--color-text-secondary)' }}>{t('contact.project_type')}</label>
                    <select {...register('project_type')} className={inputClass} style={inputStyle(errors.project_type)}>
                      <option value="">{t('contact.select_type')}</option>
                      {['residential','commercial','interior','exterior','hospitality','other'].map(type => (
                        <option key={type} value={type}>{t(`contact.${type}`)}</option>
                      ))}
                    </select>
                    {errors.project_type && <p className="text-xs text-red-500 mt-1">{t('contact.required')}</p>}
                  </div>
                </div>
                <div>
                  <label className="block text-sm mb-1" style={{ color: 'var(--color-text-secondary)' }}>{t('contact.message')}</label>
                  <textarea {...register('message')} rows={6} className={inputClass} style={inputStyle(errors.message)} onFocus={e => e.target.style.borderColor = '#C9A14A'} onBlur={e => e.target.style.borderColor = errors.message ? '#ef4444' : 'var(--color-border)'} />
                  {errors.message && <p className="text-xs text-red-500 mt-1">{t('contact.required')}</p>}
                </div>
                {serverError && <p className="text-red-500 text-sm">{serverError}</p>}
                <button type="submit" disabled={isSubmitting} className="btn-primary w-full justify-center py-4 text-base flex items-center gap-2">
                  <Send size={18} />
                  {isSubmitting ? t('contact.sending') : t('contact.send')}
                </button>
              </form>
            )}
          </div>

          {/* Sidebar */}
          <div className="space-y-6">
            <div className="card p-6">
              <h3 className="font-bold mb-6 pb-4" style={{ color: 'var(--color-text)', borderBottom: '1px solid var(--color-border)' }}>
                {t('footer.contact')}
              </h3>
              <div className="space-y-5">
                {contactInfo.map(({ icon: Icon, label, value, href }) => (
                  <div key={label} className="flex items-start gap-3">
                    <Icon size={18} style={{ color: '#C9A14A', marginTop: 2, flexShrink: 0 }} />
                    <div>
                      <p className="text-xs mb-0.5" style={{ color: 'var(--color-text-secondary)' }}>{label}</p>
                      {href ? (
                        <a href={href} className="text-sm font-medium" style={{ color: 'var(--color-text)' }}>{value}</a>
                      ) : (
                        <p className="text-sm font-medium" style={{ color: 'var(--color-text)' }}>{value}</p>
                      )}
                    </div>
                  </div>
                ))}
              </div>
            </div>

            <a
              href={`https://wa.me/${WHATSAPP_NUMBER}`}
              target="_blank"
              rel="noopener noreferrer"
              className="flex items-center gap-3 p-4 transition-opacity hover:opacity-90"
              style={{ background: '#25D366', color: 'white' }}
            >
              <svg width="22" height="22" viewBox="0 0 24 24" fill="white"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
              <span className="font-medium">{t('contact.whatsapp')}</span>
            </a>

            {/* Map placeholder */}
            <div className="aspect-video overflow-hidden" style={{ border: '1px solid var(--color-border)' }}>
              <iframe
                title="Sardini Studio Location"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d103310.62568684296!2d37.09000!3d36.20261!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1531e57f5e89a7b5%3A0x3e3c4fee3d0eb85f!2sAleppo%2C%20Syria!5e0!3m2!1sen!2s!4v1693000000000!5m2!1sen!2s"
                className="w-full h-full"
                loading="lazy"
                style={{ filter: 'grayscale(1) contrast(1.1)' }}
              />
            </div>
          </div>
        </div>
      </div>
    </main>
  );
}
