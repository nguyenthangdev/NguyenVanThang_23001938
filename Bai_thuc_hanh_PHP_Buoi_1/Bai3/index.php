<?php
require_once __DIR__ . '/functions.php';
$students = [
    ['name' => 'Nguyen Van An', 'age' => 20, 'score' => 8.5],
    ['name' => 'Tran Thi Binh', 'age' => 21, 'score' => 6.5],
    ['name' => 'Le Van Cuong', 'age' => 19, 'score' => 4.5],
    ['name' => 'Pham Thi Dung', 'age' => 20, 'score' => 7.5],
];
$best = findBestStudent($students);
$worst = findWorstStudent($students);
$found = findStudentByName($students, 'Tran Thi Binh');
?>
<h1>Bài 3: Xử lý danh sách sinh viên</h1>
<p>Sinh viên điểm cao nhất: <?= htmlspecialchars($best['name']) ?> (<?= $best['score'] ?>)</p>
<p>Sinh viên điểm thấp nhất: <?= htmlspecialchars($worst['name']) ?> (<?= $worst['score'] ?>)</p>
<p>Số sinh viên đạt: <?= countPassedStudents($students) ?></p>
<p>Tìm kiếm Tran Thi Binh: <?= $found ? displayStudent($found) : 'Không tìm thấy' ?></p>