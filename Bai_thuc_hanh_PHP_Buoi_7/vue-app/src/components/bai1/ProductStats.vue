<script>
import { formatCurrency } from '../../utils/format.js'

export default {
  props: {
    shown: { type: Number, required: true },
    total: { type: Number, required: true },
    stockValue: { type: Number, required: true }
  },
  methods: { formatCurrency }
}
</script>

<template>
  <p class="stats">
    Đang hiển thị {{ shown }}/{{ total }} sản phẩm — Tổng giá trị tồn kho: {{ formatCurrency(stockValue) }}
  </p>
</template>

<style scoped>
.stats { font-weight: 600; background: var(--primary-soft); color: var(--primary-dark); padding: 10px 14px; border-radius: 10px; }
</style>
