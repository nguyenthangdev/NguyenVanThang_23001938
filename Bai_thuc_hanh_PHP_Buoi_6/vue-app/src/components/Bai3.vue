<script>
import { FILTERS } from '../constants/todo'

export default {
  data() {
    return {
      tasks: [
        { id: 1, title: 'Học VueJS', done: false },
        { id: 2, title: 'Làm bài tập thực hành', done: true }
      ],
      nextId: 3,
      newTask: '',
      error: '',
      filter: 'all',
      filters: FILTERS
    }
  },
  computed: {
    totalCount() { return this.tasks.length },
    doneCount() { return this.tasks.filter(t => t.done).length },
    remainingCount() { return this.totalCount - this.doneCount },
    filteredTasks() {
      if (this.filter === 'active') return this.tasks.filter(t => !t.done)
      if (this.filter === 'done') return this.tasks.filter(t => t.done)
      return this.tasks
    }
  },
  methods: {
    addTask() {
      const title = this.newTask.trim()
      if (!title) {
        this.error = 'Tên công việc không được để trống.'
        return
      }
      this.error = ''
      this.tasks.push({ id: this.nextId++, title, done: false })
      this.newTask = ''
    },
    removeTask(id) {
      this.tasks = this.tasks.filter(t => t.id !== id)
    },
    clearDone() {
      this.tasks = this.tasks.filter(t => !t.done)
    }
  }
}
</script>

<template>
  <div class="card todo">
    <h2>📝 Công việc hôm nay</h2>

    <form class="add" @submit.prevent="addTask">
      <input type="text" v-model="newTask" placeholder="Nhập tên công việc...">
      <button type="submit">Thêm</button>
    </form>
    <div class="error" v-if="error">{{ error }}</div>

    <div class="stats">Tổng: <b>{{ totalCount }}</b> việc · Chưa hoàn thành: <b>{{ remainingCount }}</b></div>

    <div class="filters">
      <button v-for="f in filters" :key="f.value"
              :class="{ active: filter === f.value }" @click="filter = f.value">{{ f.label }}</button>
    </div>

    <ul v-if="filteredTasks.length">
      <li v-for="task in filteredTasks" :key="task.id" :class="{ done: task.done }">
        <input type="checkbox" v-model="task.done">
        <span>{{ task.title }}</span>
        <button @click="removeTask(task.id)">Xóa</button>
      </li>
    </ul>
    <div class="msg" v-else-if="tasks.length === 0">Chưa có công việc nào. Hãy thêm công việc mới!</div>
    <div class="msg" v-else>Không có công việc nào phù hợp với bộ lọc.</div>

    <button @click="clearDone" :disabled="doneCount === 0">Xóa các việc đã hoàn thành</button>
  </div>
</template>

<style scoped src="../styles/Bai3.css"></style>
