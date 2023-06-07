import { defineConfig, loadEnv }  from 'vite';

import vue from '@vitejs/plugin-vue';

import { fileURLToPath as fp, URL } from "url";
import path from "path";

const basePath = "../src/www"

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [vue({
    template: {
      compilerOptions: {
        isCustomElement: tag => ['math','mi','mn','mo','msup','mrow'].includes(tag)
      }
    }
  })],
  server: {
    port: 5173,
    watch: {
      usePolling: true,
    }
  },
  root: path.resolve(__dirname, "../src/www"),
  resolve: {
      alias: [
        { find: '@',       replacement: fp(new URL(basePath, import.meta.url)) },
        { find: '@fonts',  replacement: fp(new URL(`${basePath}/fonts`, import.meta.url)) },
        { find: '@css',    replacement: fp(new URL(`${basePath}/assets/css`, import.meta.url)) },
        { find: '@views',  replacement: fp(new URL(`${basePath}/views`, import.meta.url)) },   
        { find: '@comps',  replacement: fp(new URL(`${basePath}/components`, import.meta.url)) }, 
        { find: '@dirx',   replacement: fp(new URL(`${basePath}/directives`, import.meta.url)) },  
        { find: '@stores', replacement: fp(new URL(`${basePath}/stores`, import.meta.url)) }, 
        { find: '@routes', replacement: fp(new URL(`${basePath}/routes`, import.meta.url)) },  
        { find: '@libs',    replacement: fp(new URL(`${basePath}/libs`, import.meta.url)) },         
        { find: '@utils',  replacement: fp(new URL(`${basePath}/libs/utils`, import.meta.url)) },  
        { find: '@mixins', replacement: fp(new URL(`${basePath}//mixins`, import.meta.url)) }, 
        { find: '@x',      replacement: fp(new URL(`${basePath}/components/x`, import.meta.url)) }, 
      ]
  },
 build: {
    sourcemap: true, // Must be true or 'hidden'
    manifest: true,
    outDir: '../../dist'
  },
  minify: 'terser',
  target: 'es2019',
  terserOptions: {
    compress: {
      defaults: false,
    }
  }
});

