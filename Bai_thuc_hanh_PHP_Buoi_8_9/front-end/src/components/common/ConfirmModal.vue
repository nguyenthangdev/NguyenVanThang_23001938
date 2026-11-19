<script>
export default {
  props: {
    open: { type: Boolean, required: true },
    title: { type: String, default: 'Xác nhận' },
    message: { type: String, default: '' },
    confirmText: { type: String, default: 'Xác nhận' },
    cancelText: { type: String, default: 'Hủy' }
  },
  emits: ['confirm', 'cancel'],
  watch: {
    open(value) {
      if (value) this.$nextTick(() => this.$refs.cancelBtn?.focus())
    }
  }
}
</script>

<template>
  <Teleport to="body">
    <Transition name="modal">
      <div v-if="open" class="overlay" @click.self="$emit('cancel')" @keydown.esc="$emit('cancel')">
        <div class="dialog" role="dialog" aria-modal="true">
          <div class="icon">!</div>
          <h3>{{ title }}</h3>
          <p>{{ message }}</p>
          <div class="actions">
            <button ref="cancelBtn" @click="$emit('cancel')">{{ cancelText }}</button>
            <button class="danger" @click="$emit('confirm')">{{ confirmText }}</button>
          </div>
        </div>
      </div>
    </Transition>
  </Teleport>
</template>

<style scoped>
.overlay {
  position: fixed;
  inset: 0;
  background: rgba(17, 24, 39, 0.5);
  backdrop-filter: blur(2px);
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 16px;
  z-index: 100;
}

.dialog {
  background: #fff;
  border-radius: 16px;
  padding: 28px 28px 22px;
  width: 100%;
  max-width: 400px;
  text-align: center;
  box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
}

.icon {
  width: 52px;
  height: 52px;
  margin: 0 auto 12px;
  border-radius: 50%;
  background: var(--danger-soft);
  color: var(--danger);
  font-size: 28px;
  font-weight: 700;
  line-height: 52px;
}

h3 {
  margin: 0 0 8px;
  font-size: 19px;
}

p {
  margin: 0 0 22px;
  color: var(--muted);
}

.actions {
  display: flex;
  gap: 10px;
  justify-content: center;
}

.actions button {
  min-width: 100px;
}

.modal-enter-active,
.modal-leave-active {
  transition: opacity 0.18s;
}

.modal-enter-active .dialog,
.modal-leave-active .dialog {
  transition: transform 0.18s;
}

.modal-enter-from,
.modal-leave-to {
  opacity: 0;
}

.modal-enter-from .dialog,
.modal-leave-to .dialog {
  transform: scale(0.92) translateY(8px);
}
</style>
