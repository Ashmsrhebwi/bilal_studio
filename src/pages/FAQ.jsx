import { useTranslation } from 'react-i18next';
import { useQuery } from '@tanstack/react-query';
import { faqService } from '../services';
import SectionTitle from '../components/ui/SectionTitle';
import { Accordion } from '../components/ui/Accordion';

export default function FAQ() {
  const { t, i18n } = useTranslation();
  const lang = i18n.language;

  const { data: faqs = [] } = useQuery({
    queryKey: ['faq'],
    queryFn: faqService.getAll,
  });

  return (
    <main className="pt-24 pb-20">
      <div className="max-w-3xl mx-auto px-4 sm:px-6">
        <SectionTitle title={t('faq.title')} subtitle={t('faq.subtitle')} center />
        <Accordion items={faqs} lang={lang} />
      </div>
    </main>
  );
}
