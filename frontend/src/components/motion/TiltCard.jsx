import { useRef } from 'react';
import { motion, useMotionValue, useSpring, useTransform, useReducedMotion } from 'framer-motion';

export default function TiltCard({ children, className = '', maxTilt = 8, glare = true, ...rest }) {
  const ref = useRef(null);
  const prefersReducedMotion = useReducedMotion();

  const x = useMotionValue(0.5);
  const y = useMotionValue(0.5);
  const springX = useSpring(x, { stiffness: 200, damping: 22 });
  const springY = useSpring(y, { stiffness: 200, damping: 22 });

  const rotateX = useTransform(springY, [0, 1], [maxTilt, -maxTilt]);
  const rotateY = useTransform(springX, [0, 1], [-maxTilt, maxTilt]);
  const glareX = useTransform(springX, [0, 1], ['0%', '100%']);
  const glareY = useTransform(springY, [0, 1], ['0%', '100%']);

  const handleMouseMove = (e) => {
    if (prefersReducedMotion || !ref.current) return;
    const rect = ref.current.getBoundingClientRect();
    x.set((e.clientX - rect.left) / rect.width);
    y.set((e.clientY - rect.top) / rect.height);
  };

  const handleMouseLeave = () => {
    x.set(0.5);
    y.set(0.5);
  };

  if (prefersReducedMotion) {
    return <div className={className} {...rest}>{children}</div>;
  }

  return (
    <motion.div
      ref={ref}
      onMouseMove={handleMouseMove}
      onMouseLeave={handleMouseLeave}
      style={{ rotateX, rotateY, transformPerspective: 1000 }}
      className={`preserve-3d relative ${className}`}
      {...rest}
    >
      {children}
      {glare && (
        <motion.div
          aria-hidden
          className="pointer-events-none absolute inset-0"
          style={{
            background: `radial-gradient(circle at ${glareX} ${glareY}, rgba(245,241,232,0.12), transparent 60%)`,
          }}
        />
      )}
    </motion.div>
  );
}
