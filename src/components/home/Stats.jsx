import { useEffect, useRef, useState } from 'react';
import { useTranslation } from 'react-i18next';
import { motion, useInView } from 'framer-motion';
import { mockSettings } from '../../api/mock/data';

function CountUp({ target, suffix = '' }) {
  const [count, setCount] = useState(0);
  const ref = useRef(null);
  const inView = useInView(ref, { once: true });

  useEffect(() => {
    if (!inView) return;
    let start = 0;
    const duration = 1500;
    const step = Math.ceil(target / (duration / 16));
    const timer = setInterval(() => {
      start += step;
      if (start >= target) { setCount(target); clearInterval(timer); }
      else setCount(start);
    }, 16);
    return () => clearInterval(timer);
  }, [inView, target]);

  return <span ref={ref}>{count}{suffix}</span>;
}

export default function Stats() {
  const { t } = useTranslation();
  const { stats } = mockSettings;

  const items = [
    { value: stats.projects, suffix: '+', label: t('stats.projects') },
    { value: stats.years, suffix: '+', label: t('stats.years') },
    { value: stats.clients, suffix: '+', label: t('stats.clients') },
    { value: stats.awards, suffix: '', label: t('stats.awards') },
  ];

  return (
    <section className="py-16" style={{ background: '#0a0a0a' }}>
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="grid grid-cols-2 lg:grid-cols-4 gap-8">
          {items.map((item, i) => (
            <motion.div
              key={i}
              initial={{ opacity: 0, y: 20 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ delay: i * 0.1, duration: 0.6 }}
              className="text-center"
            >
              <div className="text-4xl lg:text-5xl font-bold mb-2" style={{ color: '#C9A14A', fontFamily: 'Cormorant Garamond, serif' }}>
                <CountUp target={item.value} suffix={item.suffix} />
              </div>
              <p className="text-sm" style={{ color: '#a0958a' }}>{item.label}</p>
            </motion.div>
          ))}
        </div>
      </div>
    </section>
  );
}
