<script>
import { formatCurrency } from '../../utils/format.js'

export default {
  props: { items: { type: Array, required: true } },
  emits: ['remove'],
  methods: { formatCurrency }
}
</script>

<template>
  <table>
    <thead>
      <tr><th>ID</th><th>Tên</th><th>Giá</th><th>Danh mục</th><th>Tồn kho</th><th>Trạng thái</th><th></th></tr>
    </thead>
    <tbody>
      <tr v-for="p in items" :key="p.id">
        <td>{{ p.id }}</td>
        <td>{{ p.name }}</td>
        <td>{{ formatCurrency(p.price) }}</td>
        <td>{{ p.category }}</td>
        <td>{{ p.stock }}</td>
        <td><span :class="['badge', p.stock > 0 ? 'in' : 'out']">{{ p.stock > 0 ? 'Còn hàng' : 'Hết hàng' }}</span></td>
        <td><button class="ghost-danger" @click="$emit('remove', p)">Xóa</button></td>
      </tr>
      <tr v-if="items.length === 0">
        <td colspan="7" class="empty">Không có sản phẩm phù hợp</td>
      </tr>
    </tbody>
  </table>
</template>

<style scoped>
table { border-collapse: separate; border-spacing: 0; width: 100%; border: 1px solid var(--border); border-radius: 12px; overflow: hidden; }
th, td { padding: 10px 12px; text-align: left; border-bottom: 1px solid var(--border); }
th { background: var(--primary-soft); color: var(--primary-dark); font-size: 14px; }
tbody tr:last-child td { border-bottom: none; }
tbody tr:hover { background: #fafafa; }
.badge { padding: 2px 10px; border-radius: 999px; font-size: 12px; font-weight: 600; }
.in { background: var(--success-soft); color: var(--success); }
.out { background: var(--danger-soft); color: var(--danger); }
.empty { text-align: center; color: var(--muted); padding: 28px; }
</style>
