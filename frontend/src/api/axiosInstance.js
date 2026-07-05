import axios from 'axios';
import { API_URL } from './config';

const axiosInstance = axios.create({
  baseURL: API_URL,
  timeout: 10000,
  headers: { 'Content-Type': 'application/json', Accept: 'application/json' },
});

axiosInstance.interceptors.response.use(
  (res) => res,
  (error) => {
    console.error('API Error:', error.response?.data || error.message);
    return Promise.reject(error);
  }
);

export default axiosInstance;
