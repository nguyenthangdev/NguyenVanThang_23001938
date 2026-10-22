<?php
$name = "Nguyễn Văn A";
$score = 7.5;

if ($score >= 8) {
  $xepLoai = "Giỏi";
} elseif ($score >= 6.5) {
  $xepLoai = "Khá";
} elseif ($score >= 5) {
  $xepLoai = "Trung bình";
} else {
  $xepLoai = "Yếu";
}

echo "Tên: " . $name . "<br>";
echo "Điểm: " . $score . "<br>";
echo "Xếp loại: " . $xepLoai;
