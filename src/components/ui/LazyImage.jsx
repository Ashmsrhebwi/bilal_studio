import { useState } from 'react';

export default function LazyImage({ src, alt, className = '', style }) {
  const [loaded, setLoaded] = useState(false);
  const [error, setError] = useState(false);

  return (
    <div className={`relative overflow-hidden ${className}`} style={style}>
      {!loaded && !error && (
        <div className="absolute inset-0 bg-gray-800 animate-pulse" />
      )}
      {error ? (
        <div className="absolute inset-0 flex items-center justify-center bg-gray-900">
          <span className="text-gray-500 text-sm">{alt}</span>
        </div>
      ) : (
        <img
          src={src}
          alt={alt}
          loading="lazy"
          onLoad={() => setLoaded(true)}
          onError={() => setError(true)}
          className={`w-full h-full object-cover transition-opacity duration-500 ${loaded ? 'opacity-100' : 'opacity-0'}`}
        />
      )}
    </div>
  );
}
