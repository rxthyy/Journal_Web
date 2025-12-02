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
    host: true, // allow all hosts
    port: parseInt(process.env.PORT) || 4173,
    strictPort: true,
  },
})
