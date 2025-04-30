import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'; 
import copy from 'rollup-plugin-copy';
import fs from 'fs-extra';
import path from "path";

const folder = {
    src: "resources/", // source files
    src_assets: "resources/", // source assets files
    dist: "public/", // build files
    dist_assets: "public/build/" //build assets files
};

export default defineConfig({
    plugins: [
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                }
            }
        }),
        laravel({
            input: [
                'resources/scss/bootstrap.scss',
                'resources/scss/app.scss',
                'resources/scss/icons.scss',
                'resources/scss/custom.scss',

                'resources/vue/pages/operaciones-diarias/operaciones-diarias.page.js',
                'resources/vue/pages/ingreso-counter/ingreso-counter.page.js',
                'resources/vue/pages/nueva-ficha/nueva-ficha.page.js',
                'resources/vue/pages/roles/roles.page.js',
                'resources/vue/pages/sucursales/sucursales.page.js',
                'resources/vue/pages/usuarios/usuarios.page.js',
            ],
            refresh: [
                ...refreshPaths,
                'resources/views/**',
            ],
        }),
        copy({
            targets: [
                { src: 'node_modules/jquery/dist/jquery.min.js', dest: 'public/vendor' },
                { src: 'node_modules/bootstrap/dist/js/bootstrap.bundle.min.js', dest: 'public/vendor' },
                { src: 'node_modules/simplebar/dist/simplebar.min.js', dest: 'public/vendor' },
                { src: 'node_modules/sweetalert2/dist/sweetalert2.all.min.js', dest: 'public/vendor' },
            ],
            hook: 'buildStart',
        }),
        {
            name: 'copy-specific-packages',
            async writeBundle() {
                try {
                    // Copy images, json, fonts, and js
                    await Promise.all([
                        fs.copy(folder.src_assets + 'fonts', folder.dist_assets + 'fonts'),
                        fs.copy(folder.src_assets + 'images', folder.dist_assets + 'images'),
                        fs.copy(folder.src_assets + 'js', folder.dist_assets + 'js'),
                    ]);
                } catch (error) {
                    console.error('Error copying assets:', error);
                }
            },
            hook: 'buildStart',
        }
    ],
    resolve: {
        alias: {
            "@": path.resolve(__dirname, "resources/vue"),
            vue: 'vue/dist/vue.esm-bundler.js'
        }
    },
    build: {
        rollupOptions: {
          output: {
            entryFileNames: `assets/[name].js`,
            chunkFileNames: `assets/[name].js`,
            assetFileNames: `assets/[name].[ext]`
          }
        }
    }
});
