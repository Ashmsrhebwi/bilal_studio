import { Link } from 'react-router-dom';

export function Button({ children, variant = 'primary', href, to, onClick, type = 'button', disabled, className = '', ...rest }) {
  const base = variant === 'primary' ? 'btn-primary' : 'btn-outline';
  const cls = `${base} ${className} ${disabled ? 'opacity-50 cursor-not-allowed' : ''}`;

  if (to) return <Link to={to} className={cls} {...rest}>{children}</Link>;
  if (href) return <a href={href} className={cls} target="_blank" rel="noopener noreferrer" {...rest}>{children}</a>;
  return <button type={type} onClick={onClick} disabled={disabled} className={cls} {...rest}>{children}</button>;
}
