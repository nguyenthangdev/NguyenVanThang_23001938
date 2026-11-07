<script>
import { toasts, toast } from '../../services/toast.js'

export default {
  data() {
    return { toasts }
  },
  methods: {
    close: toast.dismiss
  }
}
</script>

<template>
  <Teleport to="body">
    <TransitionGroup name="toast" tag="div" class="toast-list">
      <div v-for="t in toasts" :key="t.id" :class="['toast', t.type]" role="alert">
        <span class="mark">{{ t.type === 'success' ? '✓' : t.type === 'error' ? '✕' : 'i' }}</span>
        <span class="msg">{{ t.message }}</span>
        <button class="x" aria-label="Đóng" @click="close(t.id)">×</button>
      </div>
    </TransitionGroup>
  </Teleport>
</template>

<style scoped>
.toast-list {
  position: fixed;
  top: 16px;
  right: 16px;
  display: flex;
  flex-direction: column;
  gap: 10px;
  z-index: 200;
  width: 320px;
  max-width: calc(100vw - 32px);
}

.toast {
  display: flex;
  align-items: center;
  gap: 10px;
  background: #fff;
  border-left: 5px solid var(--primary);
  border-radius: 10px;
  padding: 12px 12px 12px 14px;
  box-shadow: 0 8px 24px rgba(17, 24, 39, 0.18);
}

.toast.success { border-left-color: var(--success); }
.toast.error { border-left-color: var(--danger); }

.mark {
  flex: none;
  width: 24px;
  height: 24px;
  border-radius: 50%;
  text-align: center;
  line-height: 24px;
  font-size: 13px;
  font-weight: 700;
  background: var(--primary-soft);
  color: var(--primary);
}

.success .mark { background: var(--success-soft); color: var(--success); }
.error .mark { background: var(--danger-soft); color: var(--danger); }

.msg { flex: 1; font-size: 14px; }

.x {
  border: none;
  background: transparent;
  color: var(--muted);
  font-size: 20px;
  line-height: 1;
  padding: 0 4px;
}

.toast-enter-active,
.toast-leave-active { transition: all 0.25s; }
.toast-leave-active { position: absolute; width: 100%; }
.toast-enter-from,
.toast-leave-to { opacity: 0; transform: translateX(40px); }
.toast-move { transition: transform 0.25s; }
</style>
