import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

export default defineConfig({
  plugins: [vue()],
  resolve: {
    // Bản có trình biên dịch template, cần cho component viết bằng template string (TheSanPham.js)
    alias: { vue: 'vue/dist/vue.esm-bundler.js' }
  }
})
