import { createApp } from 'vue'
import App from './App.vue'
import TheSanPham from './components/TheSanPham.js'
import './styles/global.css'
import './styles/the-san-pham.css'

const app = createApp(App)
// Đăng ký component dùng chung trước khi mount
app.component('the-san-pham', TheSanPham)
app.mount('#app')
