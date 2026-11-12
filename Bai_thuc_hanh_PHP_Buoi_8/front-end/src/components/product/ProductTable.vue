<script>
import { formatCurrency } from '../../utils/format.js'

export default {
  props: {
    products: { type: Array, required: true },
    loading: { type: Boolean, default: false }
  },
  emits: ['edit', 'remove'],
  methods: { formatCurrency }
}
</script>

<template>
  <table>
    <thead>
      <tr><th>Tên sản phẩm</th><th class="num">Đơn giá</th><th class="num">Số lượng tồn</th><th></th></tr>
    </thead>
    <tbody>
      <tr v-for="p in products" :key="p.id">
        <td>{{ p.name }}</td>
        <td class="num">{{ formatCurrency(p.price) }}</td>
        <td class="num">
          <span :class="['badge', p.stock > 0 ? 'in' : 'out']">{{ p.stock > 0 ? p.stock : 'Hết hàng' }}</span>
        </td>
        <td class="actions">
          <button @click="$emit('edit', p)">Sửa</button>
          <button class="ghost-danger" @click="$emit('remove', p)">Xóa</button>
        </td>
      </tr>
      <tr v-if="products.length === 0">
        <td colspan="4" class="empty">{{ loading ? 'Đang tải...' : 'Chưa có sản phẩm nào' }}</td>
      </tr>
    </tbody>
  </table>
</template>

<style scoped>
table { border-collapse: separate; border-spacing: 0; width: 100%; border: 1px solid var(--border); border-radius: 12px; overflow: hidden; }
th, td { padding: 10px 12px; text-align: left; border-bottom: 1px solid var(--border); }
th { background: var(--primary-soft); color: var(--primary-dark); font-size: 14px; }
tbody tr:last-child td { border-bottom: none; }
.num { text-align: right; }
.actions { text-align: right; white-space: nowrap; }
.actions button { margin-left: 6px; }
.badge { padding: 2px 10px; border-radius: 999px; font-size: 13px; font-weight: 600; }
.in { background: var(--success-soft); color: var(--success); }
.out { background: var(--danger-soft); color: var(--danger); }
.empty { text-align: center; color: var(--muted); padding: 28px; }
</style>
