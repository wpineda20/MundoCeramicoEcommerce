import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    server: {
        port: 5174,
        host: "127.0.0.1",
        watch: {
            usePolling: true,
        },
    },
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
        },
    },
    build: {
        outDir: "dist",
        chunkSizeWarningLimit: 500,
        rollupOptions: {
            output: {
                manualChunks: {
                    lodash: ["lodash"],
                },
            },
        },
    },
});
