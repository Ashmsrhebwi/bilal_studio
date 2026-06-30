import { useEffect } from 'react';
import { motion, AnimatePresence, useReducedMotion } from 'framer-motion';
import { X, ChevronLeft, ChevronRight } from 'lucide-react';

const EASE_LUXE = [0.22, 1, 0.36, 1];

export default function Lightbox({ images, currentIndex, onClose, onPrev, onNext }) {
  const prefersReducedMotion = useReducedMotion();

  useEffect(() => {
    const handler = (e) => {
      if (e.key === 'Escape') onClose();
      if (e.key === 'ArrowLeft') onPrev();
      if (e.key === 'ArrowRight') onNext();
    };
    document.addEventListener('keydown', handler);
    document.body.style.overflow = 'hidden';
    return () => {
      document.removeEventListener('keydown', handler);
      document.body.style.overflow = '';
    };
  }, [onClose, onPrev, onNext]);

  return (
    <AnimatePresence>
      <motion.div
        initial={{ opacity: 0 }}
        animate={{ opacity: 1 }}
        exit={{ opacity: 0 }}
        transition={{ duration: 0.5, ease: EASE_LUXE }}
        className="lightbox-overlay"
        onClick={onClose}
      >
        <button
          onClick={onClose}
          className="absolute top-4 end-4 z-10 p-2.5 border transition-colors duration-300"
          style={{ borderColor: 'rgba(201,161,74,0.4)', color: '#F5F1E8' }}
          onMouseEnter={(e) => (e.currentTarget.style.borderColor = '#C9A14A')}
          onMouseLeave={(e) => (e.currentTarget.style.borderColor = 'rgba(201,161,74,0.4)')}
          aria-label="Close"
        >
          <X size={22} />
        </button>

        <button
          onClick={(e) => { e.stopPropagation(); onPrev(); }}
          className="absolute start-4 top-1/2 -translate-y-1/2 p-3 border transition-colors duration-300"
          style={{ borderColor: 'rgba(201,161,74,0.4)', color: '#F5F1E8' }}
          onMouseEnter={(e) => (e.currentTarget.style.borderColor = '#C9A14A')}
          onMouseLeave={(e) => (e.currentTarget.style.borderColor = 'rgba(201,161,74,0.4)')}
          aria-label="Previous"
        >
          <ChevronLeft size={22} />
        </button>

        <motion.img
          key={currentIndex}
          initial={{ opacity: 0, scale: prefersReducedMotion ? 1 : 0.96 }}
          animate={{ opacity: 1, scale: 1 }}
          exit={{ opacity: 0 }}
          transition={{ duration: 0.5, ease: EASE_LUXE }}
          src={images[currentIndex]}
          alt={`Image ${currentIndex + 1}`}
          className="max-w-[90vw] max-h-[85vh] object-contain"
          style={{ boxShadow: '0 30px 80px rgba(0,0,0,0.6)' }}
          onClick={(e) => e.stopPropagation()}
        />

        <button
          onClick={(e) => { e.stopPropagation(); onNext(); }}
          className="absolute end-4 top-1/2 -translate-y-1/2 p-3 border transition-colors duration-300"
          style={{ borderColor: 'rgba(201,161,74,0.4)', color: '#F5F1E8' }}
          onMouseEnter={(e) => (e.currentTarget.style.borderColor = '#C9A14A')}
          onMouseLeave={(e) => (e.currentTarget.style.borderColor = 'rgba(201,161,74,0.4)')}
          aria-label="Next"
        >
          <ChevronRight size={22} />
        </button>

        <div className="absolute bottom-6 left-1/2 -translate-x-1/2 flex items-center gap-3">
          <span className="text-xs tracking-wider2 uppercase" style={{ color: '#C9A14A' }}>
            {currentIndex + 1} / {images.length}
          </span>
        </div>
      </motion.div>
    </AnimatePresence>
  );
}
