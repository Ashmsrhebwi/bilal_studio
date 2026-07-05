import { useState } from 'react';
import { motion, AnimatePresence } from 'framer-motion';
import { ChevronDown } from 'lucide-react';

export function Accordion({ items, lang = 'ar' }) {
  const [openId, setOpenId] = useState(null);

  return (
    <div className="space-y-3">
      {items.map((item) => (
        <div key={item.id} className="card overflow-hidden">
          <button
            className="w-full flex items-center justify-between p-5 text-start transition-colors duration-300"
            onClick={() => setOpenId(openId === item.id ? null : item.id)}
            aria-expanded={openId === item.id}
          >
            <span className="font-semibold text-base" style={{ color: openId === item.id ? 'var(--color-gold)' : 'var(--color-text)' }}>
              {lang === 'ar' ? item.question_ar : item.question_en}
            </span>
            <motion.span animate={{ rotate: openId === item.id ? 180 : 0 }} transition={{ duration: 0.4, ease: [0.22, 1, 0.36, 1] }}>
              <ChevronDown size={20} style={{ color: 'var(--color-gold)' }} />
            </motion.span>
          </button>
          <AnimatePresence initial={false}>
            {openId === item.id && (
              <motion.div
                initial={{ height: 0, opacity: 0 }}
                animate={{ height: 'auto', opacity: 1 }}
                exit={{ height: 0, opacity: 0 }}
                transition={{ duration: 0.4, ease: [0.22, 1, 0.36, 1] }}
              >
                <p className="px-5 pb-5 section-subtitle leading-relaxed">
                  {lang === 'ar' ? item.answer_ar : item.answer_en}
                </p>
              </motion.div>
            )}
          </AnimatePresence>
        </div>
      ))}
    </div>
  );
}
