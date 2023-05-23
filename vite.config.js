import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'
import path from 'path'

export default defineConfig({
  plugins: [
    vue(),
    laravel({
      input: ['resources/js/main.js'],
      refresh: true,
    }),
  ],
  resolve: {
    alias: {
      '@': path.resolve(__dirname, 'resources/js'),
      '@images': path.resolve(__dirname, 'resources/images'),
    },
  }
})
