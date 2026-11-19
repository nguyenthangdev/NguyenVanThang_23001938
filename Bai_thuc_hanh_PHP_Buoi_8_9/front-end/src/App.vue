<script>
import ProductsView from './views/ProductsView.vue'
import ToastList from './components/common/ToastList.vue'

export default {
  components: { ProductsView, ToastList }
}
</script>

<template>
  <ProductsView />
  <ToastList />
</template>
