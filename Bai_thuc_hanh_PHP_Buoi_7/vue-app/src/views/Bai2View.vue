<script>
import { catalog } from '../data/catalog.js'

export default {
  data() {
    return { sanPhams: catalog }
  }
}
</script>

<template>
  <section class="card">
    <h1>Danh mục sản phẩm</h1>
    <div class="grid">
      <the-san-pham
        v-for="sp in sanPhams"
        :key="sp.id"
        :ten="sp.ten"
        :gia="sp.gia"
        :anh="sp.anh"
        :mo-ta="sp.moTa"
        :so-luong="sp.soLuong"
      />
    </div>
  </section>
</template>

<style scoped>
.grid { display: flex; flex-wrap: wrap; gap: 16px; align-items: flex-start; }
</style>
