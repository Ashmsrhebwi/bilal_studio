import axiosInstance from '../api/axiosInstance';
import { mockProjects } from '../api/mock/projects';
import { USE_MOCK } from '../api/config';

export const projectsService = {
  getAll: async (params) => {
    if (USE_MOCK) return mockProjects;
    const res = await axiosInstance.get('/projects', { params });
    return res.data;
  },
  getBySlug: async (slug) => {
    if (USE_MOCK) return mockProjects.find((p) => p.slug === slug) || null;
    const res = await axiosInstance.get(`/projects/${slug}`);
    return res.data;
  },
  getFeatured: async () => {
    if (USE_MOCK) return mockProjects.filter((p) => p.featured);
    const res = await axiosInstance.get('/projects?featured=1');
    return res.data;
  },
  getByCategory: async (category) => {
    if (USE_MOCK) return category === 'all' ? mockProjects : mockProjects.filter((p) => p.category === category);
    const res = await axiosInstance.get('/projects', { params: { category } });
    return res.data;
  },
};
