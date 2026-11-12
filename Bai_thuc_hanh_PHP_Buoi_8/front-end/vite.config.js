import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

export default defineConfig({
  plugins: [vue()],
  server: {
    // Chuyển /api sang back-end PHP để front-end gọi cùng origin, không dính CORS
    proxy: {
      '/api': 'http://localhost:8000'
    }
  }
})
