<script>
import { validateImage, imageUrl, ACCEPTED_IMAGE_TYPES } from '../../utils/image.js'

const emptyForm = () => ({ name: '', price: '', stock: '' })

export default {
  props: {
    // Sản phẩm đang sửa; null nghĩa là chế độ thêm
    editing: { type: Object, default: null },
    saving: { type: Boolean, default: false },
    // File ảnh mới đã chọn (v-model:file), do cha giữ để còn thử upload lại khi thất bại
    file: { type: File, default: null },
    uploadError: { type: String, default: '' }
  },
  emits: ['save', 'cancel', 'update:file'],
  data() {
    return {
      form: emptyForm(),
      fileError: '',
      previewUrl: '',
      accept: ACCEPTED_IMAGE_TYPES.join(',')
    }
  },
  computed: {
    // Ảnh mới chọn được ưu tiên; nếu không có thì hiện ảnh hiện tại của sản phẩm đang sửa
    shownImage() {
      return this.previewUrl || imageUrl(this.editing?.image)
    }
  },
  watch: {
    editing: {
      immediate: true,
      handler(product) {
        this.form = product
          ? { name: product.name, price: product.price, stock: product.stock }
          : emptyForm()
      }
    },
    file: {
      immediate: true,
      handler(file) {
        if (this.previewUrl) URL.revokeObjectURL(this.previewUrl)
        this.previewUrl = file ? URL.createObjectURL(file) : ''
        if (!file && this.$refs.fileInput) this.$refs.fileInput.value = ''
      }
    }
  },
  beforeUnmount() {
    if (this.previewUrl) URL.revokeObjectURL(this.previewUrl)
  },
  methods: {
    onFileChange(e) {
      const file = e.target.files[0]
      if (!file) return
      this.fileError = validateImage(file)
      this.$emit('update:file', this.fileError ? null : file)
    },
    clearFile() {
      this.fileError = ''
      this.$emit('update:file', null)
    },
    submit() {
      this.$emit('save', {
        name: this.form.name,
        price: this.form.price === '' ? null : Number(this.form.price),
        stock: this.form.stock === '' ? null : Number(this.form.stock)
      })
    }
  }
}
</script>

<template>
  <form class="form" @submit.prevent="submit">
    <div class="fields">
      <label>Tên sản phẩm <input v-model="form.name" placeholder="Bút bi" /></label>
      <label>Đơn giá <input v-model="form.price" type="number" placeholder="5000" /></label>
      <label>Số lượng tồn <input v-model="form.stock" type="number" placeholder="20" /></label>
    </div>

    <div class="image-field">
      <div class="preview">
        <img v-if="shownImage" :src="shownImage" alt="Xem trước ảnh" />
        <span v-else>Chưa có ảnh</span>
      </div>
      <div class="image-controls">
        <label class="file-label">
          Ảnh sản phẩm (JPG, PNG, tối đa 2 MB, có thể để trống)
          <input ref="fileInput" type="file" :accept="accept" @change="onFileChange" />
        </label>
        <p v-if="file" class="hint">
          Ảnh mới: {{ file.name }}
          <button type="button" class="link" @click="clearFile">Bỏ chọn</button>
        </p>
        <p v-else-if="editing?.image" class="hint">Không chọn ảnh mới thì giữ ảnh hiện tại.</p>
        <p v-if="fileError" class="error">{{ fileError }}</p>
        <p v-else-if="uploadError" class="error">{{ uploadError }}</p>
      </div>
    </div>

    <div class="buttons">
      <button class="primary" type="submit" :disabled="saving">
        {{ saving ? 'Đang lưu...' : editing ? 'Lưu thay đổi' : 'Thêm sản phẩm' }}
      </button>
      <button v-if="editing" type="button" @click="$emit('cancel')">Hủy sửa</button>
    </div>
  </form>
</template>

<style scoped>
.form { display: flex; flex-direction: column; gap: 16px; }
.fields { display: flex; flex-wrap: wrap; gap: 12px; }
label { display: flex; flex-direction: column; gap: 4px; font-size: 14px; color: var(--muted); }
label input { min-width: 160px; }
.image-field { display: flex; gap: 16px; align-items: flex-start; }
.preview {
  flex: none; width: 110px; height: 110px; border-radius: 12px; overflow: hidden;
  background: var(--bg); border: 1px dashed var(--border);
  display: flex; align-items: center; justify-content: center; color: var(--muted); font-size: 13px;
}
.preview img { width: 100%; height: 100%; object-fit: cover; }
.image-controls { display: flex; flex-direction: column; gap: 6px; }
.file-label input { padding: 6px; }
.hint { margin: 0; font-size: 13px; color: var(--muted); }
.error { margin: 0; font-size: 14px; }
.link { border: none; background: none; padding: 0 4px; color: var(--primary); text-decoration: underline; }
.link:hover:not(:disabled) { background: none; }
.buttons { display: flex; gap: 8px; }
</style>
