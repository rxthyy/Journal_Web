import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
    }),
  ],
  preview: {
    port: parseInt(process.env.PORT) || 4173,
    strictPort: true,
    allowedHosts: ['public-pages-xsey.onrender.com'], // <-- add your Render hostname here
  },
})
