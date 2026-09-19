<?php

function calculateAverageScore(array $students): float
{
    if (count($students) === 0) {
        return 0;
    }

    $totalScore = 0;
    foreach ($students as $student) {
        $totalScore += $student['score'];
    }

    return $totalScore / count($students);
}

function getRank(float $score): string
{
    if ($score >= 8) {
        return 'Giỏi';
    }
    if ($score >= 6.5) {
        return 'Khá';
    }
    if ($score >= 5) {
        return 'Trung bình';
    }

    return 'Yếu';
}

function displayStudent(array $student): string
{
    return sprintf(
        '%s | Tuổi: %d | Điểm: %.1f | Xếp loại: %s',
        htmlspecialchars($student['name']),
        $student['age'],
        $student['score'],
        getRank($student['score'])
    );
}

function findBestStudent(array $students): ?array
{
    if (count($students) === 0) {
        return null;
    }

    $bestStudent = $students[0];
    foreach ($students as $student) {
        if ($student['score'] > $bestStudent['score']) {
            $bestStudent = $student;
        }
    }

    return $bestStudent;
}

function findWorstStudent(array $students): ?array
{
    if (count($students) === 0) {
        return null;
    }

    $worstStudent = $students[0];
    foreach ($students as $student) {
        if ($student['score'] < $worstStudent['score']) {
            $worstStudent = $student;
        }
    }

    return $worstStudent;
}

function countPassedStudents(array $students): int
{
    $passedCount = 0;
    foreach ($students as $student) {
        if ($student['score'] >= 5) {
            $passedCount++;
        }
    }

    return $passedCount;
}

function findStudentByName(array $students, string $name): ?array
{
    foreach ($students as $student) {
        if (strtolower($student['name']) === strtolower(trim($name))) {
            return $student;
        }
    }

    return null;
}
