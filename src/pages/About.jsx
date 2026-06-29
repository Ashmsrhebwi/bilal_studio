import { useTranslation } from 'react-i18next';
import { motion } from 'framer-motion';
import { Award, Users, Briefcase, GraduationCap } from 'lucide-react';
import { useSEO } from '../hooks/useSEO';
import SchemaOrg from '../components/SEO/SchemaOrg';
import SectionTitle from '../components/ui/SectionTitle';
import LazyImage from '../components/ui/LazyImage';

const PORTRAIT = 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&q=80';

const timeline = [
  { year: '2013', event_ar: 'تأسيس Sardini Studio في حلب', event_en: 'Founded Sardini Studio in Aleppo' },
  { year: '2015', event_ar: 'أول مشروع فندقي بارز', event_en: 'First major hotel project' },
  { year: '2018', event_ar: 'فريق متخصص من 8 مهندسين', event_en: 'Specialized team of 8 engineers' },
  { year: '2020', event_ar: 'جائزة أفضل تصميم معماري السوري', event_en: 'Syrian Best Architectural Design Award' },
  { year: '2022', event_ar: 'توسع إلى دمشق والساحل', event_en: 'Expanded to Damascus and Coastal Syria' },
  { year: '2024', event_ar: 'أكثر من 150 مشروع منجز', event_en: 'Over 150 completed projects' },
];

export default function About() {
  useSEO({ titleKey: 'seo.about_title', descKey: 'seo.about_desc' });
  const { t, i18n } = useTranslation();
  const lang = i18n.language;

  const stats = [
    { icon: Briefcase, value: '12+', label: t('about.experience') },
    { icon: Award, value: '150+', label: t('about.projects_done') },
    { icon: Users, value: '8', label: t('about.team_size') },
    { icon: GraduationCap, value: '8', label: t('stats.awards') },
  ];

  return (
    <main className="pt-24 pb-20">
      <SchemaOrg type="business" />
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <SectionTitle title={t('about.title')} subtitle={t('about.subtitle')} />

        {/* Bio */}
        <div className="grid grid-cols-1 lg:grid-cols-2 gap-14 items-center mb-20">
          <motion.div
            initial={{ opacity: 0, x: -30 }}
            whileInView={{ opacity: 1, x: 0 }}
            viewport={{ once: true }}
            transition={{ duration: 0.7 }}
          >
            <div className="relative">
              <div className="aspect-[3/4] overflow-hidden">
                <LazyImage src={PORTRAIT} alt={t('about.bio_title')} className="w-full h-full" />
              </div>
              <div
                className="absolute -bottom-4 -end-4 p-6"
                style={{ background: '#C9A14A', color: '#0E0E0E' }}
              >
                <p className="text-3xl font-bold" style={{ fontFamily: 'Cormorant Garamond' }}>12+</p>
                <p className="text-sm font-medium">{t('about.experience')}</p>
              </div>
            </div>
          </motion.div>

          <motion.div
            initial={{ opacity: 0, x: 30 }}
            whileInView={{ opacity: 1, x: 0 }}
            viewport={{ once: true }}
            transition={{ duration: 0.7 }}
          >
            <span className="gold-line mb-4" />
            <h2 className="text-3xl font-bold mb-1" style={{ color: 'var(--color-text)' }}>{t('about.bio_title')}</h2>
            <p className="mb-6 font-medium" style={{ color: '#C9A14A' }}>{t('about.bio_role')}</p>
            <p className="leading-relaxed mb-8" style={{ color: 'var(--color-text-secondary)' }}>{t('about.bio_text')}</p>

            <div className="grid grid-cols-2 gap-6">
              {stats.map(({ icon: Icon, value, label }) => (
                <div key={label} className="flex items-center gap-3">
                  <div className="w-10 h-10 flex items-center justify-center" style={{ background: 'rgba(201,161,74,0.1)', color: '#C9A14A' }}>
                    <Icon size={18} />
                  </div>
                  <div>
                    <p className="text-xl font-bold" style={{ color: '#C9A14A' }}>{value}</p>
                    <p className="text-xs" style={{ color: 'var(--color-text-secondary)' }}>{label}</p>
                  </div>
                </div>
              ))}
            </div>
          </motion.div>
        </div>

        {/* Philosophy */}
        <div
          className="p-10 md:p-16 mb-20 text-center"
          style={{ background: 'linear-gradient(135deg, rgba(201,161,74,0.08), rgba(201,161,74,0.03))', border: '1px solid rgba(201,161,74,0.2)' }}
        >
          <span className="gold-line mb-6" style={{ margin: '0 auto 1.5rem' }} />
          <h2 className="text-2xl font-bold mb-6" style={{ color: 'var(--color-text)' }}>{t('about.philosophy_title')}</h2>
          <p className="text-lg leading-relaxed max-w-3xl mx-auto italic" style={{ color: 'var(--color-text-secondary)' }}>
            "{t('about.philosophy_text')}"
          </p>
        </div>

        {/* Timeline */}
        <div>
          <h2 className="text-2xl font-bold mb-12 text-center" style={{ color: 'var(--color-text)' }}>{t('about.timeline_title')}</h2>
          <div className="relative">
            <div className="absolute top-0 bottom-0 start-1/2 -translate-x-1/2 w-px" style={{ background: 'var(--color-border)' }} />
            <div className="space-y-8">
              {timeline.map((item, i) => (
                <motion.div
                  key={item.year}
                  initial={{ opacity: 0, y: 20 }}
                  whileInView={{ opacity: 1, y: 0 }}
                  viewport={{ once: true }}
                  transition={{ delay: i * 0.08 }}
                  className={`flex items-center gap-8 ${i % 2 === 0 ? 'flex-row' : 'flex-row-reverse'}`}
                >
                  <div className={`flex-1 ${i % 2 === 0 ? 'text-end' : 'text-start'}`}>
                    <p className="font-medium" style={{ color: 'var(--color-text)' }}>
                      {lang === 'ar' ? item.event_ar : item.event_en}
                    </p>
                  </div>
                  <div
                    className="w-12 h-12 rounded-full flex items-center justify-center z-10 shrink-0 text-xs font-bold"
                    style={{ background: '#C9A14A', color: '#0E0E0E' }}
                  >
                    {item.year.slice(2)}
                  </div>
                  <div className="flex-1">
                    <p className="text-lg font-bold" style={{ color: '#C9A14A' }}>{item.year}</p>
                  </div>
                </motion.div>
              ))}
            </div>
          </div>
        </div>
      </div>
    </main>
  );
}
