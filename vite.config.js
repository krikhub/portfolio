import { defineConfig } from 'vite';

export default defineConfig({
  root: 'assets',
  base: '/assets/',
  build: {
    outDir: '../public/assets',
    emptyOutDir: true,
    manifest: true,
    rollupOptions: {
      input: {
        main: 'assets/js/index.js',
        style: 'assets/css/index.css'
      }
    }
  },
  server: {
    port: 5173,
    strictPort: true,
    proxy: {
      // Proxy all non-asset requests to Kirby
      '^(?!/assets/).*': {
        target: 'http://localhost:8000',
        changeOrigin: true
      }
    }
  }
});
