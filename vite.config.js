import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';
import * as glob from 'glob';
import path from 'path'


export default defineConfig({
    server: {
        watch: {
            ignored: ['!**/node_modules/your-package-name/**'],
        }
    },
    plugins: [
        react(),
        laravel({
            input: [
                ...glob.sync('resources/js/**/*.jsx'),
                ...glob.sync('Modules/Crm/Resources/js/**/*.jsx'),
                'resources/css/app.css',
                'resources/js/app.js',
                
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            // El alias para tu carpeta de utilidades
            '@Utils': path.resolve(__dirname, 'resources/js/Utils'),
            // Opcional: El alias general para la carpeta JS
            '@': path.resolve(__dirname, 'resources/js'),
        },
    },
    
    base: 'https://romulio.factusode.xyz/',
    build: {
        sourcemap: true,
        rollupOptions: {
            output: {
                assetFileNames: (assetInfo) => {
                    if (assetInfo.name == 'app-C6GHMxSp.css')
                        return 'app.css';
                    return assetInfo.name;
                },
            },
        },
    },
});
