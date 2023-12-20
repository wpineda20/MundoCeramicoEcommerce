import { fileURLToPath, URL } from "node:url";

import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";

import terser from "@rollup/plugin-terser";
import { VitePWA } from "vite-plugin-pwa";

// https://vitejs.dev/config/
export default defineConfig({
  input: "src/index.js",
  output: {
    dir: "output",
    format: "cjs",
  },
  plugins: [vue(), terser()],
  resolve: {
    alias: {
      "@": fileURLToPath(new URL("./src", import.meta.url)),
    },
  },
  server: {
    port: 5174,
    host: "0.0.0.0",
    watch: {
      usePolling: true,
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
