<script>
import { products } from '../data/products.js'
import ProductToolbar from '../components/bai1/ProductToolbar.vue'
import ProductTable from '../components/bai1/ProductTable.vue'
import ProductStats from '../components/bai1/ProductStats.vue'
import ProductForm from '../components/bai1/ProductForm.vue'
import { toast } from '../services/toast.js'
import ConfirmModal from '../components/common/ConfirmModal.vue'

export default {
  components: { ProductToolbar, ProductTable, ProductStats, ProductForm, ConfirmModal },
  data() {
    return {
      status: 'Đang tải...',
      items: [...products],
      keyword: '',
      category: '',
      sort: '',
      notice: '',
      pendingRemove: null
    }
  },
  computed: {
    categories() {
      return [...new Set(this.items.map((p) => p.category))]
    },
    visibleItems() {
      const k = this.keyword.trim().toLowerCase()
      const list = this.items.filter(
        (p) => p.name.toLowerCase().includes(k) && (!this.category || p.category === this.category)
      )
      // list là mảng mới (do filter) nên sort không làm đổi mảng gốc
      if (this.sort === 'asc') return list.sort((a, b) => a.price - b.price)
      if (this.sort === 'desc') return list.sort((a, b) => b.price - a.price)
      return list
    },
    stockValue() {
      return this.visibleItems.reduce((sum, p) => sum + p.price * p.stock, 0)
    }
  },
  watch: {
    keyword(value) {
      this.notice = value.length === 1 ? 'Từ khóa mới có 1 ký tự, hãy nhập thêm.' : ''
    }
  },
  methods: {
    addProduct(data) {
      const id = this.items.reduce((max, p) => Math.max(max, p.id), 0) + 1
      this.items.push({ id, ...data })
      toast.success(`Đã thêm sản phẩm "${data.name}"`)
    },
    askRemove(product) {
      this.pendingRemove = product
    },
    confirmRemove() {
      this.items = this.items.filter((p) => p.id !== this.pendingRemove.id)
      toast.success(`Đã xóa sản phẩm "${this.pendingRemove.name}"`)
      this.pendingRemove = null
    }
  },
  mounted() {
    this.status = 'Sẵn sàng'
  }
}
</script>

<template>
  <section class="card">
    <h1>Quản lý sản phẩm</h1>
    <p>Trạng thái trang: <span class="status">{{ status }}</span></p>

    <ProductToolbar
      v-model:keyword="keyword"
      v-model:category="category"
      v-model:sort="sort"
      :categories="categories"
    />
    <p v-if="notice" class="notice">{{ notice }}</p>

    <ProductTable :items="visibleItems" @remove="askRemove" />
    <ProductStats :shown="visibleItems.length" :total="items.length" :stock-value="stockValue" />

    <h2>Thêm sản phẩm</h2>
    <ProductForm :categories="categories" @add="addProduct" />

    <ConfirmModal
      :open="pendingRemove !== null"
      title="Xóa sản phẩm?"
      :message="pendingRemove ? `Bạn có chắc muốn xóa &quot;${pendingRemove.name}&quot;? Hành động này không thể hoàn tác.` : ''"
      confirm-text="Xóa"
      @confirm="confirmRemove"
      @cancel="pendingRemove = null"
    />
  </section>
</template>

<style scoped>
.status { display: inline-block; background: var(--success-soft); color: var(--success); padding: 2px 12px; border-radius: 999px; font-weight: 600; }
.notice { background: var(--warning-soft); color: var(--warning); padding: 8px 12px; border-radius: 8px; }
</style>
