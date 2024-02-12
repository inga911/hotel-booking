import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'public/frontend/assets/css/style.css',
                'resources/scss/main.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
