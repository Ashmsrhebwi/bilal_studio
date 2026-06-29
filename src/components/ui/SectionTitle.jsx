import { motion } from 'framer-motion';

export default function SectionTitle({ title, subtitle, center = false, light = false }) {
  return (
    <motion.div
      initial={{ opacity: 0, y: 20 }}
      whileInView={{ opacity: 1, y: 0 }}
      viewport={{ once: true }}
      transition={{ duration: 0.6 }}
      className={`mb-12 ${center ? 'text-center' : ''}`}
    >
      <span className="gold-line mb-4" style={{ margin: center ? '0 auto 1rem' : '0 0 1rem' }} />
      <h2 className={`section-title mb-4 ${light ? 'text-white' : ''}`}>{title}</h2>
      {subtitle && (
        <p className={`section-subtitle max-w-2xl ${center ? 'mx-auto' : ''} ${light ? 'text-gray-300' : ''}`}>
          {subtitle}
        </p>
      )}
    </motion.div>
  );
}
