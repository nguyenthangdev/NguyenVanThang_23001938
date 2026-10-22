<?php
$name = "Nguyễn Văn A";
$score = 7.5;

if (trim($name) === "") {
  echo "Lỗi: Tên học sinh không được để trống.";
} elseif (!is_numeric($score)) {
  echo "Lỗi: Điểm phải là số.";
} elseif ($score < 0 || $score > 10) {
  echo "Lỗi: Điểm phải nằm trong khoảng 0 đến 10.";
} else {
  if ($score >= 8) {
    $xepLoai = "Giỏi";
  } elseif ($score >= 6.5) {
    $xepLoai = "Khá";
  } elseif ($score >= 5) {
    $xepLoai = "Trung bình";
  } else {
    $xepLoai = "Yếu";
  }

  echo "Tên: " . htmlspecialchars($name) . "<br>";
  echo "Điểm: " . $score . "<br>";
  echo "Xếp loại: " . $xepLoai;
}
