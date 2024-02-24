import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'node_modules/admin-lte/dist/js/adminlte.min.js'
            ],
            refresh: true,
        }),
    ],
    server: {
        hmr: {
            host: "localhost",
        },
    },
    resolve: {
        alias: [
            {
                find: /^~(.*)$/,
                replacement: "$1",
            },
            {
                find: "vue",
                replacement: "vue/dist/vue.esm-bundler.js",
            },
        ],
    },
});
