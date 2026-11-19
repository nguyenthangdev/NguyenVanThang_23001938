<script>
import { productApi } from '../api/productApi.js'
import { toast } from '../services/toast.js'
import ProductTable from '../components/product/ProductTable.vue'
import ProductForm from '../components/product/ProductForm.vue'
import ProductPagination from '../components/product/ProductPagination.vue'
import ConfirmModal from '../components/common/ConfirmModal.vue'

const PAGE_SIZE = 5

export default {
  components: { ProductTable, ProductForm, ProductPagination, ConfirmModal },
  data() {
    return {
      products: [],
      pagination: { page: 1, limit: PAGE_SIZE, total: 0, total_pages: 1 },
      loading: false,
      saving: false,
      editing: null,
      file: null,
      uploadError: '',
      formKey: 0,
      pendingRemove: null,
      error: ''
    }
  },
  watch: {
    // Chọn ảnh khác thì bỏ thông báo lỗi upload cũ
    file() {
      this.uploadError = ''
    }
  },
  methods: {
    // Gọi API lấy một trang; trang thực tế lấy theo pagination.page API trả về
    async load(page = this.pagination.page) {
      this.loading = true
      try {
        const res = await productApi.list(page, PAGE_SIZE)
        this.products = res.data
        this.pagination = res.pagination
        this.error = ''
      } catch (e) {
        this.error = e.message
      } finally {
        this.loading = false
      }
    },
    startEdit(product) {
      this.editing = product
      this.file = null
      this.uploadError = ''
    },
    resetForm() {
      this.editing = null
      this.file = null
      this.uploadError = ''
      this.formKey++ // tạo lại form để xóa dữ liệu đã nhập
    },
    async save(data) {
      const isNew = !this.editing
      this.saving = true
      try {
        // Bước 1: lưu thông tin sản phẩm bằng JSON
        let saved
        try {
          const res = isNew ? await productApi.create(data) : await productApi.update(this.editing.id, data)
          saved = res.data
          toast.success(res.message)
        } catch (e) {
          toast.error(e.message)
          return
        }

        // Bước 2: nếu có chọn ảnh thì upload theo mã sản phẩm vừa lưu
        if (this.file) {
          try {
            await productApi.uploadImage(saved.id, this.file)
            toast.success('Tải ảnh lên thành công.')
          } catch (e) {
            // Sản phẩm đã lưu; chuyển form sang sửa sản phẩm đó và giữ ảnh đã chọn để bấm Lưu thử lại
            this.editing = saved
            this.uploadError = `Tải ảnh lên thất bại: ${e.message} Bấm Lưu để thử lại.`
            toast.error(this.uploadError)
            await this.load(isNew ? 1 : this.pagination.page)
            return
          }
        }

        this.resetForm()
        await this.load(isNew ? 1 : this.pagination.page)
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
        if (this.editing?.id === product.id) this.resetForm()
        // Nếu vừa xóa sản phẩm duy nhất ở trang cuối, API tự trả về trang cuối mới
        await this.load(this.pagination.page)
      } catch (e) {
        toast.error(e.message)
      }
    }
  },
  mounted() {
    this.load(1)
  }
}
</script>

<template>
  <section class="card">
    <h1>Quản lý sản phẩm</h1>
    <p v-if="error" class="alert">{{ error }}</p>

    <ProductTable :products="products" :loading="loading" @edit="startEdit" @remove="pendingRemove = $event" />
    <ProductPagination
      :page="pagination.page"
      :total-pages="pagination.total_pages"
      :total="pagination.total"
      :disabled="loading"
      @change="load"
    />

    <h2>{{ editing ? `Sửa sản phẩm: ${editing.name}` : 'Thêm sản phẩm' }}</h2>
    <ProductForm
      :key="formKey"
      v-model:file="file"
      :editing="editing"
      :saving="saving"
      :upload-error="uploadError"
      @save="save"
      @cancel="resetForm"
    />

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
