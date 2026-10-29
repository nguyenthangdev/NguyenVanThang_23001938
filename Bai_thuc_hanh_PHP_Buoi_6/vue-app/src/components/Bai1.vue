<script>
import avatar from "../assets/avatar.svg";

export default {
  data() {
    return {
      student: {
        id: "SV68001",
        name: "Nguyễn Văn Thắng",
        className: "K68 Khoa học máy tính",
        avatar,
        gpa: 7.2,
        studying: true,
        intro: "Sinh viên khoa Toán - Cơ - Tin học, yêu thích lập trình web.",
      },
      showIntro: true,
    };
  },
  computed: {
    rank() {
      const g = this.student.gpa;
      if (g >= 8) return "Giỏi";
      if (g >= 6.5) return "Khá";
      if (g >= 5) return "Trung bình";
      return "Chưa đạt";
    },
    rankClass() {
      const g = this.student.gpa;
      return {
        gioi: g >= 8,
        kha: g >= 6.5 && g < 8,
        "trung-binh": g >= 5 && g < 6.5,
        "chua-dat": g < 5,
      };
    },
  },
};
</script>

<template>
  <div class="card student">
    <img
      v-bind:src="student.avatar"
      :alt="'Ảnh đại diện của ' + student.name"
    />

    <h2>{{ student.name }}</h2>

    <div class="info">
      <div><b>Mã SV:</b> {{ student.id }}</div>
      <div><b>Lớp:</b> <span v-text="student.className"></span></div>
      <div><b>Điểm TB:</b> {{ student.gpa }}</div>
      <div>
        <b>Xếp loại:</b> <span :class="rankClass">{{ rank }}</span>
      </div>
      <div>
        <b>Trạng thái:</b>
        <span
          class="badge"
          :style="{ backgroundColor: student.studying ? '#2e7d32' : '#757575' }"
        >
          <template v-if="student.studying">Đang học</template>
          <template v-else>Đã nghỉ</template>
        </span>
      </div>
    </div>

    <button @click="showIntro = !showIntro">
      {{ showIntro ? "Ẩn giới thiệu" : "Hiện giới thiệu" }}
    </button>
    <div class="intro" v-show="showIntro">{{ student.intro }}</div>

    <!-- Chỉnh dữ liệu để kiểm tra giao diện tự cập nhật -->
    <div class="edit">
      <div>
        Điểm TB:
        <input
          type="number"
          min="0"
          max="10"
          step="0.1"
          v-model.number="student.gpa"
        />
      </div>
      <div>
        <label
          ><input type="checkbox" v-model="student.studying" /> Đang học</label
        >
      </div>
    </div>
  </div>
</template>

<style scoped src="../styles/Bai1.css"></style>
