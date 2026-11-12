<script>
import { productApi } from '../api/productApi.js'
import { toast } from '../services/toast.js'
import ProductTable from '../components/product/ProductTable.vue'
import ProductForm from '../components/product/ProductForm.vue'
import ConfirmModal from '../components/common/ConfirmModal.vue'

export default {
  components: { ProductTable, ProductForm, ConfirmModal },
  data() {
    return {
      products: [],
      loading: false,
      saving: false,
      editing: null,
      pendingRemove: null,
      error: ''
    }
  },
  methods: {
    async load() {
      this.loading = true
      try {
        this.products = await productApi.list()
        this.error = ''
      } catch (e) {
        this.error = e.message
      } finally {
        this.loading = false
      }
    },
    async save(data) {
      this.saving = true
      try {
        const res = this.editing
          ? await productApi.update(this.editing.id, data)
          : await productApi.create(data)
        toast.success(res.message)
        this.editing = null
        await this.load() // cập nhật bảng mà không tải lại trang
      } catch (e) {
        toast.error(e.message)
      } finally {
        this.saving = false
      }
    },
    async confirmRemove() {
      const product = this.pendingRemove
      this.pendingRemove = null
      try {
        const res = await productApi.remove(product.id)
        toast.success(res.message)
        if (this.editing?.id === product.id) this.editing = null
        await this.load()
      } catch (e) {
        toast.error(e.message)
      }
    }
  },
  mounted() {
    this.load()
  }
}
</script>

<template>
  <section class="card">
    <h1>Quản lý sản phẩm</h1>
    <p v-if="error" class="alert">{{ error }}</p>

    <ProductTable :products="products" :loading="loading" @edit="editing = $event" @remove="pendingRemove = $event" />

    <h2>{{ editing ? `Sửa sản phẩm: ${editing.name}` : 'Thêm sản phẩm' }}</h2>
    <ProductForm :editing="editing" :saving="saving" @save="save" @cancel="editing = null" />

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
.alert { background: var(--danger-soft); color: var(--danger); padding: 10px 14px; border-radius: 10px; }
</style>
