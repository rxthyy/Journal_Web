// server.js
import serve from 'serve';

const port = process.env.PORT || 4173;

serve('dist', {
  port,
  single: true,
  listen: '0.0.0.0',
});

console.log(`Server running on port ${port}`);
