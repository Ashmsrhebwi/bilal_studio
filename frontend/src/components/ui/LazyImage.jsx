import { useState } from 'react';

export default function LazyImage({ src, alt, className = '', style }) {
  const [loaded, setLoaded] = useState(false);
  const [error, setError] = useState(false);

  return (
    <div className={`relative overflow-hidden ${className}`} style={style}>
      {!loaded && !error && (
        <div className="absolute inset-0 animate-pulse" style={{ backgroundColor: 'var(--color-bg-secondary)' }} />
      )}
      {error ? (
        <div className="absolute inset-0 flex items-center justify-center" style={{ backgroundColor: 'var(--color-bg-secondary)' }}>
          <span className="text-sm" style={{ color: 'var(--color-text-secondary)' }}>{alt}</span>
        </div>
      ) : (
        <img
          src={src}
          alt={alt}
          loading="lazy"
          onLoad={() => setLoaded(true)}
          onError={() => setError(true)}
          className={`w-full h-full object-cover transition-opacity duration-700 ${loaded ? 'opacity-100' : 'opacity-0'}`}
          style={{ transitionTimingFunction: 'var(--ease-luxe)' }}
        />
      )}
    </div>
  );
}
