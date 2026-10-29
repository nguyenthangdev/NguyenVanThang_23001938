<script>
import { formatCurrency } from '../utils/format'
import {
  SHOWTIMES,
  TICKET_TYPES,
  COMBO_PRICE,
  MIN_QUANTITY,
  MAX_QUANTITY
} from '../constants/cinema'

export default {
  data() {
    return {
      name: '',
      showtime: SHOWTIMES[0],
      ticketType: TICKET_TYPES[0].value,
      quantity: MIN_QUANTITY,
      combo: false,
      confirmed: null,
      showtimes: SHOWTIMES,
      ticketTypes: TICKET_TYPES,
      comboPrice: COMBO_PRICE,
      minQuantity: MIN_QUANTITY,
      maxQuantity: MAX_QUANTITY
    }
  },
  computed: {
    currentType() {
      return TICKET_TYPES.find(t => t.value === this.ticketType)
    },
    validQuantity() {
      return Number.isInteger(this.quantity)
        && this.quantity >= MIN_QUANTITY
        && this.quantity <= MAX_QUANTITY
    },
    // Tổng tiền = Giá vé × Số lượng + Tiền combo
    total() {
      if (!this.validQuantity) return 0
      return this.currentType.price * this.quantity + (this.combo ? COMBO_PRICE : 0)
    },
    canSubmit() {
      return this.name !== '' && this.validQuantity
    }
  },
  methods: {
    format: formatCurrency,
    increase() {
      if (this.quantity < MAX_QUANTITY) this.quantity++
    },
    decrease() {
      if (this.quantity > MIN_QUANTITY) this.quantity--
    },
    reset() {
      this.name = ''
      this.showtime = SHOWTIMES[0]
      this.ticketType = TICKET_TYPES[0].value
      this.quantity = MIN_QUANTITY
      this.combo = false
      this.confirmed = null
    },
    submitForm() {
      if (!this.canSubmit) return
      this.confirmed = {
        name: this.name,
        showtime: this.showtime,
        typeLabel: this.currentType.label,
        quantity: this.quantity,
        combo: this.combo,
        total: this.total
      }
    }
  }
}
</script>

<template>
  <form class="card booking" @submit.prevent="submitForm">
    <h2>🎬 Đặt vé xem phim: Vua Sư Tử</h2>

    <div class="row">
      <label class="title">Họ tên khách hàng</label>
      <input type="text" v-model.trim="name" placeholder="Nhập họ tên">
      <div class="error" v-if="name === ''">Họ tên không được để trống</div>
    </div>

    <div class="row">
      <label class="title">Suất chiếu</label>
      <select v-model="showtime">
        <option v-for="s in showtimes" :key="s" :value="s">{{ s }}</option>
      </select>
    </div>

    <div class="row">
      <label class="title">Loại vé</label>
      <label v-for="t in ticketTypes" :key="t.value" class="radio">
        <input type="radio" :value="t.value" v-model="ticketType">
        {{ t.label }} ({{ format(t.price) }})
      </label>
    </div>

    <div class="row qty">
      <label class="title">Số lượng vé ({{ minQuantity }} - {{ maxQuantity }})</label>
      <button type="button" @click="decrease" :disabled="quantity <= minQuantity">−</button>
      <input type="number" :min="minQuantity" :max="maxQuantity" step="1" v-model.number="quantity">
      <button type="button" @click="increase" :disabled="quantity >= maxQuantity">+</button>
      <div class="error" v-if="!validQuantity">
        Số lượng phải là số nguyên từ {{ minQuantity }} đến {{ maxQuantity }}
      </div>
    </div>

    <div class="row">
      <label><input type="checkbox" v-model="combo"> Combo bắp nước ({{ format(comboPrice) }} / đơn)</label>
    </div>

    <div class="row">Tổng tiền: <span class="total">{{ format(total) }}</span></div>

    <button type="submit" :disabled="!canSubmit">Đặt vé</button>
    <button type="button" @click="reset">Đặt lại</button>

    <div class="confirm" v-if="confirmed">
      <b>✔ Đặt vé thành công!</b><br>
      Khách hàng: {{ confirmed.name }}<br>
      Suất chiếu: {{ confirmed.showtime }}<br>
      Loại vé: {{ confirmed.typeLabel }} × {{ confirmed.quantity }}<br>
      Combo bắp nước: {{ confirmed.combo ? 'Có' : 'Không' }}<br>
      Tổng tiền: <b>{{ format(confirmed.total) }}</b>
    </div>
  </form>
</template>

<style scoped src="../styles/Bai2.css"></style>
