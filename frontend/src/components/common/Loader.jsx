import { motion, useReducedMotion } from 'framer-motion';

const EASE_LUXE = [0.22, 1, 0.36, 1];
const LETTERS = 'SARDINI'.split('');

export default function Loader() {
  const prefersReducedMotion = useReducedMotion();

  return (
    <motion.div
      initial={{ opacity: 1 }}
      exit={{ opacity: 0 }}
      transition={{ duration: 0.6, ease: EASE_LUXE }}
      className="fixed inset-0 z-50 flex flex-col items-center justify-center"
      style={{ background: '#0E0E0E' }}
    >
      <div className="flex flex-col items-center gap-7">
        {/* Logo: gold ring draws itself */}
        <div className="relative w-16 h-16">
          <svg viewBox="0 0 100 100" className="w-16 h-16 -rotate-90">
            <motion.circle
              cx="50"
              cy="50"
              r="44"
              fill="none"
              stroke="#C9A14A"
              strokeWidth="2"
              strokeLinecap="round"
              initial={{ pathLength: 0, opacity: prefersReducedMotion ? 1 : 0.9 }}
              animate={{ pathLength: 1, opacity: 1 }}
              transition={{ duration: prefersReducedMotion ? 0.4 : 1.3, ease: EASE_LUXE }}
            />
          </svg>
          <motion.div
            className="absolute inset-0 flex items-center justify-center"
            style={{ color: '#C9A14A', fontFamily: 'Cormorant Garamond, serif', fontSize: '1.25rem', fontWeight: 600 }}
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            transition={{ delay: prefersReducedMotion ? 0 : 0.9, duration: 0.5 }}
          >
            S
          </motion.div>
        </div>

        <div className="text-center">
          <p style={{ color: '#C9A14A', fontFamily: 'Cormorant Garamond, serif', fontSize: '1.5rem', letterSpacing: '0.2em' }}>
            {LETTERS.map((letter, i) => (
              <motion.span
                key={i}
                className="inline-block"
                initial={{ opacity: 0, y: 8 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ delay: prefersReducedMotion ? 0 : 1.2 + i * 0.05, duration: 0.4, ease: EASE_LUXE }}
              >
                {letter}
              </motion.span>
            ))}
          </p>
          <motion.p
            style={{ color: '#a0958a', fontFamily: 'Tajawal, sans-serif', fontSize: '0.75rem', letterSpacing: '0.15em', marginTop: '2px' }}
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            transition={{ delay: prefersReducedMotion ? 0 : 1.7, duration: 0.5 }}
          >
            STUDIO
          </motion.p>
        </div>
      </div>
    </motion.div>
  );
}
