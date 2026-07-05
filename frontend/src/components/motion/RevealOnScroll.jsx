import { motion, useReducedMotion } from 'framer-motion';

const DIRECTIONS = {
  up: { y: 28, x: 0 },
  down: { y: -28, x: 0 },
  left: { y: 0, x: 28 },
  right: { y: 0, x: -28 },
  none: { y: 0, x: 0 },
};

export default function RevealOnScroll({
  children,
  direction = 'up',
  delay = 0,
  duration = 0.8,
  scale = false,
  once = true,
  amount = 0.2,
  as = 'div',
  className = '',
  ...rest
}) {
  const prefersReducedMotion = useReducedMotion();
  const offset = DIRECTIONS[direction] || DIRECTIONS.up;
  const Component = motion[as] || motion.div;

  if (prefersReducedMotion) {
    const Plain = as;
    return <Plain className={className} {...rest}>{children}</Plain>;
  }

  return (
    <Component
      initial={{ opacity: 0, x: offset.x, y: offset.y, scale: scale ? 0.96 : 1 }}
      whileInView={{ opacity: 1, x: 0, y: 0, scale: 1 }}
      viewport={{ once, amount }}
      transition={{ duration, delay, ease: [0.22, 1, 0.36, 1] }}
      className={className}
      {...rest}
    >
      {children}
    </Component>
  );
}
