<?php
$students = [
    ['name' => 'Nguyen Van An', 'age' => 20, 'score' => 8.5],
    ['name' => 'Tran Thi Binh', 'age' => 21, 'score' => 6.5],
    ['name' => 'Le Van Cuong', 'age' => 19, 'score' => 4.5],
    ['name' => 'Pham Thi Dung', 'age' => 20, 'score' => 7.5],
];
$totalScore = 0;
?>
<h1>Bài 1: Biến, mảng và vòng lặp</h1>
<ul>
    <?php foreach ($students as $student): ?>
        <li>Họ tên: <?= htmlspecialchars($student['name']) ?>, Tuổi: <?= $student['age'] ?>, Điểm: <?= $student['score'] ?></li>
        <?php $totalScore += $student['score']; ?>
    <?php endforeach; ?>
</ul>
<p>Điểm trung bình: <?= $totalScore / count($students) ?></p>