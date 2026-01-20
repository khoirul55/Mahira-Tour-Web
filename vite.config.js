// vite.config.js - ADD THIS IF MISSING
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js', // Pastikan ini ada
            ],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0',
        cors: true,
        hmr: {
            host: '192.168.100.182'
        },
    },
    resolve: {
        alias: {
            '@': '/resources/js',
        },
    },
    // CRITICAL: Build Alpine properly
    build: {
        rollupOptions: {
            output: {
                manualChunks: {
                    'alpine': ['alpinejs'],
                }
            }
        }
    }
});