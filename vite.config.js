// vite.config.js
import { defineConfig } from 'vite';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    base: './',
    plugins: [
        tailwindcss(),
    ],
    build: {
        outDir: 'dist',
        manifest: true, // تولید فایل manifest.json برای وردپرس
        emptyOutDir: true,
        rollupOptions: {
            input: {
                main: 'src/js/main.js',
                app: 'src/css/app.css',
            },
        },
    },
    server: {
        port: 5173,
        strictPort: true,
        cors: true,
        hmr: {
            host: 'localhost',
        },
    },
});