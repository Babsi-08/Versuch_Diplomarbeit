import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';
import instruckt from 'instruckt/vite'

export default defineConfig({
    plugins: [
        instruckt({ server: false, endpoint: '/instruckt', adapters: ['react', 'blade'], mcp: true }),
        laravel({
            input: 'resources/js/app.tsx',
            refresh: true,
        }),
        react(),
    ],
});
