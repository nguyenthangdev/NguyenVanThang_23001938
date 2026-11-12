<script>
const emptyForm = () => ({ name: '', price: '', stock: '' })

export default {
  props: {
    // Sản phẩm đang sửa; null nghĩa là chế độ thêm
    editing: { type: Object, default: null },
    saving: { type: Boolean, default: false }
  },
  emits: ['save', 'cancel'],
  data() {
    return { form: emptyForm() }
  },
  watch: {
    editing: {
      immediate: true,
      handler(product) {
        this.form = product
          ? { name: product.name, price: product.price, stock: product.stock }
          : emptyForm()
      }
    }
  },
  methods: {
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
    <label>Tên sản phẩm <input v-model="form.name" placeholder="Bút bi" /></label>
    <label>Đơn giá <input v-model="form.price" type="number" placeholder="5000" /></label>
    <label>Số lượng tồn <input v-model="form.stock" type="number" placeholder="20" /></label>
    <div class="buttons">
      <button class="primary" type="submit" :disabled="saving">
        {{ editing ? 'Lưu thay đổi' : 'Thêm sản phẩm' }}
      </button>
      <button v-if="editing" type="button" @click="$emit('cancel')">Hủy sửa</button>
    </div>
  </form>
</template>

<style scoped>
.form { display: flex; flex-wrap: wrap; gap: 12px; align-items: flex-end; }
label { display: flex; flex-direction: column; gap: 4px; font-size: 14px; color: var(--muted); }
label input { min-width: 160px; }
.buttons { display: flex; gap: 8px; }
</style>
