import { reactive } from 'vue'

// Store dùng chung: bất kỳ view nào cũng gọi toast.success/error/info, <ToastList> trong App.vue hiển thị
let nextId = 1

export const toasts = reactive([])

function dismiss(id) {
  const index = toasts.findIndex((t) => t.id === id)
  if (index !== -1) toasts.splice(index, 1)
}

function show(type, message, duration = 3000) {
  const id = nextId++
  toasts.push({ id, type, message })
  setTimeout(() => dismiss(id), duration)
}

export const toast = {
  success: (message) => show('success', message),
  error: (message) => show('error', message),
  info: (message) => show('info', message),
  dismiss
}
