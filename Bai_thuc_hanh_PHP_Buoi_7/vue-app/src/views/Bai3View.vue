<script>
import { initialCart, cartCatalog } from '../data/cart.js'
import { MIN_QTY, MAX_QTY } from '../constants/cart.js'
import { isValidQuantity } from '../utils/validators.js'
import { formatCurrency } from '../utils/format.js'
import { toast } from '../services/toast.js'
import CartRow from '../components/bai3/CartRow.vue'

export default {
  components: { 'dong-gio-hang': CartRow },
  data() {
    return { gioHang: [...initialCart], danhMuc: cartCatalog }
  },
  computed: {
    tongSoLuong() {
      return this.gioHang.reduce((sum, i) => sum + i.soLuong, 0)
    },
    tongTien() {
      return this.gioHang.reduce((sum, i) => sum + i.gia * i.soLuong, 0)
    }
  },
  methods: {
    formatCurrency,
    doiSoLuong(id, soLuong) {
      if (!isValidQuantity(soLuong, MIN_QTY, MAX_QTY)) return
      this.gioHang = this.gioHang.map((i) => (i.id === id ? { ...i, soLuong } : i))
    },
    xoa(id) {
      const item = this.gioHang.find((i) => i.id === id)
      if (item) toast.success(`Đã xóa "${item.ten}" khỏi giỏ hàng`)
      this.gioHang = this.gioHang.filter((i) => i.id !== id)
    },
    themVaoGio(sp) {
      const co = this.gioHang.find((i) => i.id === sp.id)
      if (co) this.doiSoLuong(sp.id, co.soLuong + 1)
      else this.gioHang.push({ ...sp, soLuong: 1 })
      toast.success(`Đã thêm "${sp.ten}" vào giỏ hàng`)
    }
  }
}
</script>

<template>
  <section class="card">
    <h1>Giỏ hàng</h1>
    <p v-if="gioHang.length === 0" class="empty">Giỏ hàng trống</p>
    <dong-gio-hang
      v-for="item in gioHang"
      :key="item.id"
      :item="item"
      @doi-so-luong="doiSoLuong"
      @yeu-cau-xoa="xoa"
    />
    <p class="sum">Tổng số lượng: {{ tongSoLuong }} — Tổng tiền: {{ formatCurrency(tongTien) }}</p>

    <div class="add">
      Thêm vào giỏ:
      <button v-for="sp in danhMuc" :key="sp.id" @click="themVaoGio(sp)">{{ sp.ten }}</button>
    </div>
  </section>
</template>

<style scoped>
.empty { color: var(--muted); text-align: center; padding: 24px; background: var(--bg); border-radius: 10px; }
.sum { font-weight: 700; background: var(--primary-soft); color: var(--primary-dark); padding: 12px 16px; border-radius: 10px; margin-top: 16px; }
.add { display: flex; flex-wrap: wrap; gap: 8px; align-items: center; margin-top: 16px; }
</style>
