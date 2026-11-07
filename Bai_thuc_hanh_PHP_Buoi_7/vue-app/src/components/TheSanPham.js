import defaultImage from '../assets/products/default.svg'

// Component dùng chung cho Bài 2, đăng ký toàn cục trong main.js
export default {
  name: 'the-san-pham',
  props: {
    ten: { type: String, required: true },
    gia: { type: Number, required: true },
    anh: { type: String, default: defaultImage },
    moTa: { type: String, default: 'Chưa có mô tả.' },
    soLuong: { type: Number, default: 0 }
  },
  data() {
    return { hienMoTa: false }
  },
  computed: {
    hetHang() {
      return this.soLuong <= 0
    }
  },
  template: `
    <div class="the">
      <img :src="anh" :alt="ten">
      <div class="body">
        <h3>{{ ten }}</h3>
        <p class="gia">{{ gia.toLocaleString('vi-VN') }} đ</p>
        <span :class="['nhan', hetHang ? 'het' : 'con']">
          {{ hetHang ? 'Hết hàng' : 'Còn ' + soLuong }}
        </span>
        <p v-if="hienMoTa" class="mota">{{ moTa }}</p>
        <div class="hanh-dong">
          <button @click="hienMoTa = !hienMoTa">{{ hienMoTa ? 'Ẩn mô tả' : 'Xem mô tả' }}</button>
          <button class="primary" :disabled="hetHang">Mua</button>
        </div>
      </div>
    </div>
  `
}
