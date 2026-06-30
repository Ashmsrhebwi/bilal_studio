import { Link } from 'react-router-dom';
import { motion } from 'framer-motion';

export function Button({ children, variant = 'primary', href, to, onClick, type = 'button', disabled, className = '', ...rest }) {
  const base = variant === 'primary' ? 'btn-primary' : 'btn-outline';
  const cls = `${base} ${className} ${disabled ? 'opacity-50 cursor-not-allowed' : ''}`;
  const motionProps = disabled ? {} : { whileHover: { y: -2 }, whileTap: { scale: 0.97 } };

  if (to) return <motion.div {...motionProps} className="inline-block"><Link to={to} className={cls} {...rest}>{children}</Link></motion.div>;
  if (href) return <motion.a {...motionProps} href={href} className={cls} target="_blank" rel="noopener noreferrer" {...rest}>{children}</motion.a>;
  return <motion.button {...motionProps} type={type} onClick={onClick} disabled={disabled} className={cls} {...rest}>{children}</motion.button>;
}
