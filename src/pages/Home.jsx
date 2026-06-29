import { lazy, Suspense } from 'react';
import Hero from '../components/home/Hero';
import Stats from '../components/home/Stats';

const FeaturedProjects = lazy(() => import('../components/home/FeaturedProjects'));
const ServicesPreview = lazy(() => import('../components/home/ServicesPreview'));
const PartnersBar = lazy(() => import('../components/home/PartnersBar'));
const TestimonialsPreview = lazy(() => import('../components/home/TestimonialsPreview'));
const CTASection = lazy(() => import('../components/home/CTASection'));

const Fallback = () => <div className="py-20" />;

export default function Home() {
  return (
    <main>
      <Hero />
      <Stats />
      <Suspense fallback={<Fallback />}><FeaturedProjects /></Suspense>
      <Suspense fallback={<Fallback />}><ServicesPreview /></Suspense>
      <Suspense fallback={<Fallback />}><PartnersBar /></Suspense>
      <Suspense fallback={<Fallback />}><TestimonialsPreview /></Suspense>
      <Suspense fallback={<Fallback />}><CTASection /></Suspense>
    </main>
  );
}
