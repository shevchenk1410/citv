// https://nuxt.com/docs/api/configuration/nuxt-config
import { definePreset } from '@primevue/themes';
import Aura from '@primevue/themes/aura';

const myPreset = definePreset(Aura, {
  semantic: {
    primary: { 50: '#eff6ff', 100: '#dbeafe', 200: '#bfdbfe', 300: '#93c5fd', 400: '#60a5fa', 500: '#3b82f6', 600: '#2563eb', 700: '#1d4ed8', 800: '#1e40af', 900: '#1e3a8a', 950: '#172554' }
  }
});

export default defineNuxtConfig({
  ssr: false,
  compatibilityDate: '2024-04-03',
  devtools: { enabled: false },
  devServer: {
    port: 3000
  },
  modules: ['nuxt-auth-sanctum','@primevue/nuxt-module','@nuxtjs/tailwindcss'],
  css: ['remixicon/fonts/remixicon.css','~/assets/styles.scss','~/assets/tailwind.css','~/assets/custom.scss'],
  postcss: {
    plugins: {
      'postcss-import': {},
      tailwindcss: {},
      autoprefixer: {},
    },
  },
  primevue: {
    options: {
      theme: {
        preset: myPreset,
        options: {
            darkModeSelector: '.app-dark'
        },        
      }
    }
  },
  sanctum: {
    baseUrl: process.env.API_URL,
    mode: 'token',
    redirectIfAuthenticated: true,
    redirectIfUnauthenticated: true,
    redirect: {
      onLogin: '/',
      onLogout: '/login',
      onAuthOnly: '/login',
      onGuestOnly: '/'
    },
    endpoints: {
      login: '/api/login',
      logout: '/api/logout',
      user: '/api/usuario',
    },
    globalMiddleware: {
      enabled: true,
    }
  },
  runtimeConfig: {
    public: {
      apiUrl: process.env.API_URL
    }
  }
})