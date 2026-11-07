<script>
import Bai1View from './views/Bai1View.vue'
import Bai2View from './views/Bai2View.vue'
import Bai3View from './views/Bai3View.vue'
import ToastList from './components/common/ToastList.vue'

export default {
  components: { Bai1View, Bai2View, Bai3View, ToastList },
  data() {
    return {
      current: 'Bai1View',
      tabs: [
        { name: 'Bai1View', label: 'Bài 1: Danh sách sản phẩm' },
        { name: 'Bai2View', label: 'Bài 2: Danh mục sản phẩm' },
        { name: 'Bai3View', label: 'Bài 3: Giỏ hàng' }
      ]
    }
  }
}
</script>

<template>
  <nav class="tabs">
    <button v-for="t in tabs" :key="t.name" :class="{ active: current === t.name }" @click="current = t.name">
      {{ t.label }}
    </button>
  </nav>
  <component :is="current" />
  <ToastList />
</template>
