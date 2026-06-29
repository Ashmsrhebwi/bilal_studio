import { useParams, Link, Navigate } from 'react-router-dom';
import { useTranslation } from 'react-i18next';
import { motion } from 'framer-motion';
import { useQuery } from '@tanstack/react-query';
import { Calendar, Clock, ArrowLeft, ArrowRight, Share2 } from 'lucide-react';
import { useSEO } from '../hooks/useSEO';
import SchemaOrg, { buildArticleSchema } from '../components/SEO/SchemaOrg';
import { blogService } from '../services';
import LazyImage from '../components/ui/LazyImage';

export default function BlogPost() {
  const { slug } = useParams();
  const { t, i18n } = useTranslation();
  const lang = i18n.language;
  const isRTL = lang === 'ar';
  const BackArrow = isRTL ? ArrowRight : ArrowLeft;

  const { data: post, isLoading } = useQuery({
    queryKey: ['blog-post', slug],
    queryFn: () => blogService.getBySlug(slug),
  });

  useSEO({
    titleFallback: post ? (lang === 'ar' ? post.meta_title_ar || post.title_ar : post.meta_title_en || post.title_en) : '',
    descFallback: post ? (lang === 'ar' ? post.meta_description_ar || post.excerpt_ar : post.meta_description_en || post.excerpt_en) : '',
    ogImage: post?.image,
    ogType: 'article',
    canonical: `https://sardinistudio.com/blog/${slug}`,
  });

  if (isLoading) return <div className="pt-24 flex items-center justify-center min-h-screen"><div className="w-10 h-10 border-2 rounded-full animate-spin" style={{ borderColor: 'transparent', borderTopColor: '#C9A14A' }} /></div>;
  if (!post) return <Navigate to="/blog" replace />;

  const content = lang === 'ar' ? post.content_ar : post.content_en;
  const articleSchema = buildArticleSchema({
    title: lang === 'ar' ? post.title_ar : post.title_en,
    description: lang === 'ar' ? post.excerpt_ar : post.excerpt_en,
    slug,
    publishedAt: post.date,
    image: post.image,
  });

  return (
    <main className="pt-24 pb-20">
      <SchemaOrg type="article" data={articleSchema} />
      <div className="max-w-4xl mx-auto px-4 sm:px-6">
        <Link to="/blog" className="inline-flex items-center gap-2 text-sm mb-8 transition-colors" style={{ color: 'var(--color-text-secondary)' }}>
          <BackArrow size={16} />
          {t('blog.back')}
        </Link>

        {/* Header */}
        <motion.div initial={{ opacity: 0, y: 20 }} animate={{ opacity: 1, y: 0 }}>
          <span className="text-xs uppercase tracking-wider font-medium" style={{ color: '#C9A14A' }}>
            {lang === 'ar' ? post.category_ar : post.category_en}
          </span>
          <h1 className="text-3xl md:text-4xl font-bold mt-2 mb-6" style={{ color: 'var(--color-text)' }}>
            {lang === 'ar' ? post.title_ar : post.title_en}
          </h1>
          <div className="flex items-center justify-between mb-8 pb-6" style={{ borderBottom: '1px solid var(--color-border)' }}>
            <div className="flex items-center gap-4 text-sm" style={{ color: 'var(--color-text-secondary)' }}>
              <span className="font-medium" style={{ color: '#C9A14A' }}>
                {lang === 'ar' ? post.author_ar : post.author_en}
              </span>
              <span className="flex items-center gap-1"><Calendar size={14} /> {post.date}</span>
              <span className="flex items-center gap-1"><Clock size={14} /> {post.read_time} {t('blog.min_read')}</span>
            </div>
            <button className="flex items-center gap-1 text-sm" style={{ color: 'var(--color-text-secondary)' }}>
              <Share2 size={16} /> {t('blog.share')}
            </button>
          </div>
        </motion.div>

        {/* Cover */}
        <div className="aspect-video overflow-hidden mb-10">
          <LazyImage src={post.image} alt={lang === 'ar' ? post.title_ar : post.title_en} className="w-full h-full" />
        </div>

        {/* Content */}
        <div
          className="prose max-w-none leading-loose text-base"
          style={{ color: 'var(--color-text)' }}
          dangerouslySetInnerHTML={{ __html: content }}
        />
      </div>
    </main>
  );
}
