import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';

// Import the http-proxy-middleware
import { createProxyMiddleware } from 'http-proxy-middleware';

const laravelDevServer = 'http://localhost:80';

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
        https: false,
        hmr: {
            host: 'localhost',
        },
        proxy: {
            // Proxy requests to the Laravel server
            '/images': {
                target: `${laravelDevServer}:80`,
                changeOrigin: true,
            },
        },
    },
});
