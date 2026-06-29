export const API_URL = import.meta.env.VITE_API_URL || 'http://localhost:8000/api';
export const WHATSAPP_NUMBER = import.meta.env.VITE_WHATSAPP_NUMBER || '963991234567';

export const API_ENDPOINTS = {
  projects: `${API_URL}/projects`,
  services: `${API_URL}/services`,
  blog: `${API_URL}/blog`,
  testimonials: `${API_URL}/testimonials`,
  contact: `${API_URL}/contact`,
  newsletter: `${API_URL}/newsletter`,
  booking: `${API_URL}/booking`,
  settings: `${API_URL}/settings`,
  partners: `${API_URL}/partners`,
};

export const USE_MOCK = true;
