import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';

// Import the http-proxy-middleware
import { createProxyMiddleware } from 'http-proxy-middleware';

const laravelDevServer = 'http://localhost:8000';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/css/ck-content.css',
                'resources/js/app.js',
                'resources/css/filament/admin/theme.css'
            ],
            refresh: [
                ...refreshPaths,
                'app/Livewire/**',
            ],
        }),
    ],
    server: {
        proxy: {
            // Proxy requests with "/images" to your Laravel development server
            '/images': {
                target: laravelDevServer,
                changeOrigin: true,
            },
        },
    },
});
