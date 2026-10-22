<?php
$prices = [150000, 320000, 89000, 450000, 210000];

function calculateTotal($arr)
{
  $total = 0;
  foreach ($arr as $price) {
    $total += $price;
  }
  return $total;
}

function findMaxPrice($arr)
{
  $max = $arr[0];
  foreach ($arr as $price) {
    if ($price > $max) {
      $max = $price;
    }
  }
  return $max;
}

$tong = calculateTotal($prices);
$max = findMaxPrice($prices);

echo "Tổng giá trị sản phẩm: " . number_format($tong) . " đ<br>";
echo "Giá sản phẩm cao nhất: " . number_format($max) . " đ";
