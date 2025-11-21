import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                // Adicionando os arquivos novos aqui:
                'resources/css/style.css',
                'resources/js/header-wrapper.js',
                'resources/js/header.js',
                'resources/js/hero-carousel.js'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});