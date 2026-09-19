<?php
function calculateAverageScore(array $students): float
{
    $total = 0;
    foreach ($students as $student) $total += $student['score'];
    return count($students) ? $total / count($students) : 0;
}

function getRank(float $score): string
{
    if ($score >= 8) return 'Giỏi';
    if ($score >= 6.5) return 'Khá';
    if ($score >= 5) return 'Trung bình';
    return 'Yếu';
}

function displayStudent(array $student): void
{
    echo '<li>Họ tên: ' . htmlspecialchars($student['name']) . ', Tuổi: ' . $student['age']
        . ', Điểm: ' . $student['score'] . ', Xếp loại: ' . getRank($student['score']) . '</li>';
}

$students = [
    ['name' => 'Nguyen Van An', 'age' => 20, 'score' => 8.5],
    ['name' => 'Tran Thi Binh', 'age' => 21, 'score' => 6.5],
    ['name' => 'Le Van Cuong', 'age' => 19, 'score' => 4.5],
    ['name' => 'Pham Thi Dung', 'age' => 20, 'score' => 7.5],
];
?>
<h1>Bài 2: Tách hàm xử lý sinh viên</h1>
<ul><?php foreach ($students as $student) displayStudent($student); ?></ul>
<p>Điểm trung bình: <?= calculateAverageScore($students) ?></p>