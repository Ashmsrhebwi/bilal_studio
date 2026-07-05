import { Link } from 'react-router-dom';
import { useTranslation } from 'react-i18next';
import { motion } from 'framer-motion';
import { useQuery } from '@tanstack/react-query';
import { Calendar, Clock } from 'lucide-react';
import { useSEO } from '../hooks/useSEO';
import { blogService } from '../services';
import SectionTitle from '../components/ui/SectionTitle';
import LazyImage from '../components/ui/LazyImage';

export default function Blog() {
  useSEO({ titleKey: 'seo.blog_title', descKey: 'seo.blog_desc' });
  const { t, i18n } = useTranslation();
  const lang = i18n.language;

  const { data: posts = [], isLoading, isError, refetch } = useQuery({
    queryKey: ['blog'],
    queryFn: blogService.getAll,
  });

  return (
    <main className="pt-24 pb-20">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <SectionTitle title={t('blog.title')} subtitle={t('blog.subtitle')} />

        {isLoading ? (
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {Array.from({ length: 6 }).map((_, i) => (
              <div key={i} className="aspect-[4/3] animate-pulse rounded" style={{ background: 'var(--color-card)' }} />
            ))}
          </div>
        ) : isError ? (
          <div className="text-center py-20">
            <p className="mb-4" style={{ color: 'var(--color-text-secondary)' }}>{t('common.error')}</p>
            <button onClick={() => refetch()} className="btn-outline inline-flex">{t('common.retry')}</button>
          </div>
        ) : posts.length === 0 ? (
          <p className="text-center py-20" style={{ color: 'var(--color-text-secondary)' }}>
            {t('common.no_results')}
          </p>
        ) : (
        <>
        {/* Featured post */}
        {posts[0] && (
          <motion.div initial={{ opacity: 0, y: 20 }} whileInView={{ opacity: 1, y: 0 }} viewport={{ once: true }} transition={{ duration: 0.7, ease: [0.22, 1, 0.36, 1] }} className="mb-12">
            <Link to={`/blog/${posts[0].slug}`} className="group grid grid-cols-1 lg:grid-cols-2 gap-0 overflow-hidden">
              <div className="aspect-[16/9] lg:aspect-auto overflow-hidden">
                <LazyImage src={posts[0].image} alt={lang === 'ar' ? posts[0].title_ar : posts[0].title_en} className="w-full h-full transition-transform duration-700 group-hover:scale-105" />
              </div>
              <div className="p-8 lg:p-12 flex flex-col justify-center" style={{ border: '1px solid var(--color-border)', background: 'var(--color-card)' }}>
                <span className="text-xs uppercase tracking-wider mb-3 font-medium" style={{ color: '#C9A14A' }}>
                  {lang === 'ar' ? (posts[0].category?.name_ar ?? posts[0].category_ar) : (posts[0].category?.name_en ?? posts[0].category_en)}
                </span>
                <h2 className="text-2xl lg:text-3xl font-bold mb-4 group-hover:text-yellow-500 transition-colors" style={{ color: 'var(--color-text)' }}>
                  {lang === 'ar' ? posts[0].title_ar : posts[0].title_en}
                </h2>
                <p className="leading-relaxed mb-6" style={{ color: 'var(--color-text-secondary)' }}>
                  {lang === 'ar' ? posts[0].excerpt_ar : posts[0].excerpt_en}
                </p>
                <div className="flex items-center gap-4 text-sm" style={{ color: 'var(--color-text-secondary)' }}>
                  <span className="flex items-center gap-1"><Calendar size={14} /> {posts[0].date}</span>
                  <span className="flex items-center gap-1"><Clock size={14} /> {posts[0].read_time} {t('blog.min_read')}</span>
                </div>
              </div>
            </Link>
          </motion.div>
        )}

        {/* Rest of posts */}
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          {posts.slice(1).map((post, i) => (
            <motion.article
              key={post.id}
              initial={{ opacity: 0, y: 20 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ delay: i * 0.08, duration: 0.6, ease: [0.22, 1, 0.36, 1] }}
            >
              <Link to={`/blog/${post.slug}`} className="group block overflow-hidden">
                <div className="aspect-[16/9] overflow-hidden">
                  <LazyImage src={post.image} alt={lang === 'ar' ? post.title_ar : post.title_en} className="w-full h-full transition-transform duration-700 group-hover:scale-110" />
                </div>
                <div className="p-5" style={{ border: '1px solid var(--color-border)', borderTop: 'none', background: 'var(--color-card)' }}>
                  <span className="text-xs uppercase tracking-wider mb-2 block" style={{ color: '#C9A14A' }}>
                    {lang === 'ar' ? (post.category?.name_ar ?? post.category_ar) : (post.category?.name_en ?? post.category_en)}
                  </span>
                  <h3 className="font-bold text-base mb-2 group-hover:text-yellow-500 transition-colors" style={{ color: 'var(--color-text)' }}>
                    {lang === 'ar' ? post.title_ar : post.title_en}
                  </h3>
                  <p className="text-sm leading-relaxed mb-4 line-clamp-2" style={{ color: 'var(--color-text-secondary)' }}>
                    {lang === 'ar' ? post.excerpt_ar : post.excerpt_en}
                  </p>
                  <div className="flex items-center gap-3 text-xs" style={{ color: 'var(--color-text-secondary)' }}>
                    <span className="flex items-center gap-1"><Calendar size={12} /> {post.date}</span>
                    <span className="flex items-center gap-1"><Clock size={12} /> {post.read_time} {t('blog.min_read')}</span>
                  </div>
                </div>
              </Link>
            </motion.article>
          ))}
        </div>
        </>
        )}
      </div>
    </main>
  );
}
