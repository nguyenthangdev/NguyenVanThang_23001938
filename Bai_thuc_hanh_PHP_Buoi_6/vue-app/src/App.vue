<script>
import Bai1 from './components/Bai1.vue'
import Bai2 from './components/Bai2.vue'
import Bai3 from './components/Bai3.vue'

export default {
  components: { Bai1, Bai2, Bai3 },
  data() {
    return {
      current: 'Bai1',
      tabs: [
        { name: 'Bai1', label: 'Bài 1: Thẻ sinh viên' },
        { name: 'Bai2', label: 'Bài 2: Đặt vé xem phim' },
        { name: 'Bai3', label: 'Bài 3: Quản lý công việc' }
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
</template>

<style src="./styles/App.css"></style>
