import { motion } from 'framer-motion';

export default function Loader() {
  return (
    <motion.div
      initial={{ opacity: 1 }}
      exit={{ opacity: 0 }}
      transition={{ duration: 0.5 }}
      className="fixed inset-0 z-50 flex flex-col items-center justify-center"
      style={{ background: '#0E0E0E' }}
    >
      <motion.div
        initial={{ opacity: 0, scale: 0.8 }}
        animate={{ opacity: 1, scale: 1 }}
        transition={{ duration: 0.6 }}
        className="flex flex-col items-center gap-6"
      >
        {/* Logo */}
        <div className="relative">
          <motion.div
            animate={{ rotate: 360 }}
            transition={{ duration: 2, repeat: Infinity, ease: 'linear' }}
            className="w-16 h-16 border-2 border-transparent rounded-full"
            style={{ borderTopColor: '#C9A14A', borderRightColor: '#C9A14A' }}
          />
          <div
            className="absolute inset-2 flex items-center justify-center"
            style={{ color: '#C9A14A', fontFamily: 'Cormorant Garamond, serif', fontSize: '1.25rem', fontWeight: 600 }}
          >
            S
          </div>
        </div>

        <motion.div
          initial={{ opacity: 0 }}
          animate={{ opacity: 1 }}
          transition={{ delay: 0.4 }}
          className="text-center"
        >
          <p style={{ color: '#C9A14A', fontFamily: 'Cormorant Garamond, serif', fontSize: '1.5rem', letterSpacing: '0.2em' }}>
            SARDINI
          </p>
          <p style={{ color: '#a0958a', fontFamily: 'Tajawal, sans-serif', fontSize: '0.75rem', letterSpacing: '0.15em', marginTop: '2px' }}>
            STUDIO
          </p>
        </motion.div>
      </motion.div>
    </motion.div>
  );
}
