import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
    }),
  ],
  base: './', // ensures assets are served correctly from dist
  preview: {
    port: parseInt(process.env.PORT) || 4173,
    strictPort: true,
    allowedHosts: ['public-pages-xsey.onrender.com'],
  },
})
