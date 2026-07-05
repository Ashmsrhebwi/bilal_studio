import { motion, useReducedMotion } from 'framer-motion';

export default function GoldLineDivider({ width = 64, delay = 0, className = '', center = false }) {
  const prefersReducedMotion = useReducedMotion();

  return (
    <div className={`${center ? 'flex justify-center' : ''} ${className}`}>
      <motion.span
        className="block h-px origin-start"
        style={{ width, backgroundColor: 'var(--color-gold)' }}
        initial={prefersReducedMotion ? false : { scaleX: 0 }}
        whileInView={prefersReducedMotion ? undefined : { scaleX: 1 }}
        viewport={{ once: true, amount: 0.8 }}
        transition={{ duration: 1.1, delay, ease: [0.22, 1, 0.36, 1] }}
      />
    </div>
  );
}
