<script>
export default {
  props: {
    keyword: { type: String, required: true },
    category: { type: String, required: true },
    sort: { type: String, required: true },
    categories: { type: Array, required: true }
  },
  emits: ['update:keyword', 'update:category', 'update:sort']
}
</script>

<template>
  <div class="toolbar">
    <input :value="keyword" placeholder="Tìm theo tên..." @input="$emit('update:keyword', $event.target.value)" />
    <select :value="category" @change="$emit('update:category', $event.target.value)">
      <option value="">Tất cả danh mục</option>
      <option v-for="c in categories" :key="c" :value="c">{{ c }}</option>
    </select>
    <select :value="sort" @change="$emit('update:sort', $event.target.value)">
      <option value="">Không sắp xếp</option>
      <option value="asc">Giá tăng dần</option>
      <option value="desc">Giá giảm dần</option>
    </select>
  </div>
</template>

<style scoped>
.toolbar {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin: 12px 0;
}
</style>
