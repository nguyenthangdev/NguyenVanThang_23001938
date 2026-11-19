<script>
export default {
  props: {
    page: { type: Number, required: true },
    totalPages: { type: Number, required: true },
    total: { type: Number, required: true },
    disabled: { type: Boolean, default: false }
  },
  emits: ['change']
}
</script>

<template>
  <div class="pagination">
    <button :disabled="disabled || page <= 1" @click="$emit('change', page - 1)">← Trước</button>
    <span class="info">Trang {{ page }} / {{ totalPages }} — Tổng {{ total }} sản phẩm</span>
    <button :disabled="disabled || page >= totalPages" @click="$emit('change', page + 1)">Sau →</button>
  </div>
</template>

<style scoped>
.pagination { display: flex; align-items: center; justify-content: center; gap: 16px; margin-top: 14px; }
.info { color: var(--muted); font-size: 14px; }
</style>
