<?php
$prices = [150000, 320000, 89000, 450000, 210000];

function isValidPrices($arr)
{
  if (!is_array($arr) || count($arr) === 0) {
    return false;
  }
  foreach ($arr as $price) {
    if (!is_numeric($price) || $price < 0) {
      return false;
    }
  }
  return true;
}

function calculateTotal($arr)
{
  if (!isValidPrices($arr)) {
    return null;
  }
  $total = 0;
  foreach ($arr as $price) {
    $total += $price;
  }
  return $total;
}

function findMaxPrice($arr)
{
  if (!isValidPrices($arr)) {
    return null;
  }
  $max = reset($arr); // lấy phần tử đầu, kể cả khi key không bắt đầu từ 0
  foreach ($arr as $price) {
    if ($price > $max) {
      $max = $price;
    }
  }
  return $max;
}

$tong = calculateTotal($prices);
$max = findMaxPrice($prices);

if ($tong === null || $max === null) {
  echo "Lỗi: Danh sách giá rỗng hoặc chứa giá trị không hợp lệ.";
} else {
  echo "Tổng giá trị sản phẩm: " . number_format($tong) . " đ<br>";
  echo "Giá sản phẩm cao nhất: " . number_format($max) . " đ";
}
