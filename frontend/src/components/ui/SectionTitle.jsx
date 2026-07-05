import RevealOnScroll from '../motion/RevealOnScroll';
import GoldLineDivider from '../motion/GoldLineDivider';

export default function SectionTitle({ title, subtitle, center = false, light = false }) {
  return (
    <RevealOnScroll className={`mb-12 md:mb-16 ${center ? 'text-center' : ''}`}>
      <GoldLineDivider width={64} center={center} className="mb-5" />
      <h2 className={`section-title mb-4 ${light ? 'text-white' : ''}`}>{title}</h2>
      {subtitle && (
        <p className={`section-subtitle max-w-2xl ${center ? 'mx-auto' : ''} ${light ? 'text-gray-300' : ''}`}>
          {subtitle}
        </p>
      )}
    </RevealOnScroll>
  );
}
