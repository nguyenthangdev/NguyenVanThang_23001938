<?php
require_once __DIR__ . '/Student.php';
$students = [
    new Student('Nguyen Van An', 20, 8.5),
    new Student('Tran Thi Binh', 21, 6.5),
    new Student('Le Van Cuong', 19, 4.5),
    new Student('Pham Thi Dung', 20, 7.5),
];
$best = findBestObjectStudent($students);
?>
<h1>Bài 4: Lập trình hướng đối tượng</h1>
<ul><?php foreach ($students as $student): ?><li><?= $student->display() ?></li><?php endforeach; ?></ul>
<p>Sinh viên điểm cao nhất: <?= htmlspecialchars($best->name) ?> (<?= $best->score ?>)</p>
<p>Số sinh viên đạt: <?= countPassedObjectStudents($students) ?></p>
<p>Điểm trung bình lớp: <?= calculateClassAverage($students) ?></p>