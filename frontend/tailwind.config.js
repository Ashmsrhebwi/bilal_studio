/** @type {import('tailwindcss').Config} */
export default {
  content: ['./index.html', './src/**/*.{js,ts,jsx,tsx}'],
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        gold: { DEFAULT: '#C9A14A', light: '#E0C06B', dark: '#A07830', muted: 'rgba(201, 161, 74, 0.4)' },
        charcoal: { DEFAULT: '#0E0E0E', 50: '#1a1a1a', 100: '#212121', 200: '#2a2a2a', 300: '#333333' },
        ivory: { DEFAULT: '#F5F1E8', dim: '#E8E2D4' },
        cream: '#F5F0E8',
      },
      fontFamily: {
        arabic: ['Tajawal', 'sans-serif'],
        'arabic-heading': ['El Messiri', 'Tajawal', 'serif'],
        heading: ['Cormorant Garamond', 'Playfair Display', 'serif'],
        display: ['Playfair Display', 'Cormorant Garamond', 'serif'],
        body: ['Inter', 'sans-serif'],
      },
      letterSpacing: {
        luxe: '0.18em',
        wider2: '0.28em',
      },
      boxShadow: {
        gold: '0 10px 40px rgba(201, 161, 74, 0.15)',
        'gold-lg': '0 20px 60px rgba(201, 161, 74, 0.2)',
        soft: '0 20px 50px rgba(0, 0, 0, 0.35)',
      },
      transitionTimingFunction: {
        luxe: 'cubic-bezier(0.22, 1, 0.36, 1)',
      },
      animation: {
        'fade-in': 'fadeIn 0.8s var(--ease-luxe) forwards',
        'slide-up': 'slideUp 0.8s var(--ease-luxe) forwards',
        'loader-spin': 'loaderSpin 1.5s linear infinite',
        'line-draw': 'lineDraw 1.2s var(--ease-luxe) forwards',
        'ken-burns': 'kenBurns 16s var(--ease-luxe) infinite alternate',
      },
      keyframes: {
        fadeIn: { '0%': { opacity: '0' }, '100%': { opacity: '1' } },
        slideUp: { '0%': { opacity: '0', transform: 'translateY(30px)' }, '100%': { opacity: '1', transform: 'translateY(0)' } },
        loaderSpin: { '0%': { transform: 'rotate(0deg)' }, '100%': { transform: 'rotate(360deg)' } },
        lineDraw: { '0%': { transform: 'scaleX(0)' }, '100%': { transform: 'scaleX(1)' } },
        kenBurns: { '0%': { transform: 'scale(1) translate(0,0)' }, '100%': { transform: 'scale(1.08) translate(-1%, -1%)' } },
      },
    },
  },
  plugins: [],
};
