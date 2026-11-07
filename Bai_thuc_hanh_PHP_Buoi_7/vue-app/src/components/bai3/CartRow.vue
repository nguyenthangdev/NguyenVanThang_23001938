<script>
import { MIN_QTY, MAX_QTY } from '../../constants/cart.js'
import { formatCurrency } from '../../utils/format.js'

// Component <dong-gio-hang>: chỉ hiển thị và phát sự kiện, không sửa props.
export default {
  name: 'dong-gio-hang',
  props: { item: { type: Object, required: true } },
  emits: {
    'doi-so-luong': (id, soLuong) => typeof id === 'number' && typeof soLuong === 'number',
    'yeu-cau-xoa': (id) => typeof id === 'number'
  },
  data() {
    return { MIN_QTY, MAX_QTY }
  },
  computed: {
    lineTotal() {
      return this.item.gia * this.item.soLuong
    }
  },
  methods: {
    formatCurrency,
    change(qty) {
      this.$emit('doi-so-luong', this.item.id, qty)
    },
    onInput(e) {
      this.change(Number(e.target.value))
      // Cha có thể từ chối giá trị sai, nên đồng bộ lại ô nhập với props
      this.$nextTick(() => { e.target.value = this.item.soLuong })
    }
  }
}
</script>

<template>
  <div class="row">
    <span class="name">{{ item.ten }} ({{ formatCurrency(item.gia) }})</span>
    <button :disabled="item.soLuong <= MIN_QTY" @click="change(item.soLuong - 1)">-</button>
    <input type="number" :min="MIN_QTY" :max="MAX_QTY" :value="item.soLuong" @change="onInput" />
    <button :disabled="item.soLuong >= MAX_QTY" @click="change(item.soLuong + 1)">+</button>
    <span class="total">= {{ formatCurrency(lineTotal) }}</span>
    <button class="ghost-danger" @click="$emit('yeu-cau-xoa', item.id)">Xóa</button>
  </div>
</template>

<style scoped>
.row { display: flex; flex-wrap: wrap; align-items: center; gap: 10px; border-bottom: 1px solid var(--border); padding: 12px 0; }
.total { font-weight: 600; min-width: 110px; text-align: right; }
.name { flex: 1; }
input { width: 56px; text-align: center; }
</style>
