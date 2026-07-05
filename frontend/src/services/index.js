import axiosInstance from '../api/axiosInstance';
import { mockTestimonials, mockBlogPosts, mockFaqs, mockSettings, mockPartners } from '../api/mock/data';
import { USE_MOCK } from '../api/config';

export const testimonialsService = {
  getAll: async () => {
    if (USE_MOCK) return mockTestimonials;
    const res = await axiosInstance.get('/testimonials');
    return res.data.data;
  },
};

export const blogService = {
  getAll: async () => {
    if (USE_MOCK) return mockBlogPosts;
    const res = await axiosInstance.get('/blog');
    return res.data.data;
  },
  getBySlug: async (slug) => {
    if (USE_MOCK) return mockBlogPosts.find((p) => p.slug === slug) || null;
    const res = await axiosInstance.get(`/blog/${slug}`);
    return res.data.data;
  },
};

export const faqService = {
  getAll: async () => {
    if (USE_MOCK) return mockFaqs;
    const res = await axiosInstance.get('/faqs');
    return res.data.data;
  },
};

export const settingsService = {
  get: async () => {
    if (USE_MOCK) return mockSettings;
    const res = await axiosInstance.get('/settings');
    return res.data.data;
  },
};

export const partnersService = {
  getAll: async () => {
    if (USE_MOCK) return mockPartners;
    const res = await axiosInstance.get('/partners');
    return res.data.data;
  },
};

export const servicesService = {
  getAll: async () => {
    const res = await axiosInstance.get('/services');
    return res.data.data;
  },
  getBySlug: async (slug) => {
    const res = await axiosInstance.get(`/services/${slug}`);
    return res.data.data;
  },
};

export const contactService = {
  send: async (data) => {
    if (USE_MOCK) return { success: true };
    const res = await axiosInstance.post('/contact', data);
    return res.data;
  },
};

export const bookingService = {
  create: async (data) => {
    if (USE_MOCK) return { success: true };
    const { date, time, ...rest } = data;
    const res = await axiosInstance.post('/consultations', {
      ...rest,
      preferred_date: date,
      preferred_time: time,
    });
    return res.data;
  },
};

export const newsletterService = {
  subscribe: async (email) => {
    if (USE_MOCK) return { success: true };
    const res = await axiosInstance.post('/newsletter', { email });
    return res.data;
  },
};
