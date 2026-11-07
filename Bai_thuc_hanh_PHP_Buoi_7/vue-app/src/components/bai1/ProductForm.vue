<script>
import { validateProduct } from '../../utils/validators.js'

const emptyForm = () => ({ name: '', price: '', stock: '' })

export default {
  props: { categories: { type: Array, required: true } },
  emits: ['add'],
  data() {
    return { form: emptyForm(), category: this.categories[0], error: '' }
  },
  methods: {
    submit() {
      this.error = validateProduct(this.form)
      if (this.error) return
      this.$emit('add', {
        name: this.form.name.trim(),
        price: Number(this.form.price),
        category: this.category,
        stock: Number(this.form.stock)
      })
      this.form = emptyForm()
    }
  }
}
</script>

<template>
  <form class="form" @submit.prevent="submit">
    <input v-model="form.name" placeholder="Tên" />
    <input v-model="form.price" type="number" placeholder="Giá" />
    <select v-model="category">
      <option v-for="c in categories" :key="c" :value="c">{{ c }}</option>
    </select>
    <input v-model="form.stock" type="number" placeholder="Tồn kho" />
    <button class="primary" type="submit">Thêm</button>
    <p v-if="error" class="error">{{ error }}</p>
  </form>
</template>

<style scoped>
.form { display: flex; flex-wrap: wrap; gap: 8px; align-items: center; }
.error { flex-basis: 100%; margin: 0; }
</style>
