<?php

class Student
{
    public $name;
    public $age;
    public $score;

    public function __construct($name, $age, $score)
    {
        $this->name = $name;
        $this->age = $age;
        $this->score = $score;
    }

    public function getRank(): string
    {
        if ($this->score >= 8) {
            return 'Giỏi';
        }
        if ($this->score >= 6.5) {
            return 'Khá';
        }
        if ($this->score >= 5) {
            return 'Trung bình';
        }

        return 'Yếu';
    }

    public function isPassed(): bool
    {
        return $this->score >= 5;
    }

    public function display(): string
    {
        return sprintf(
            '%s | Tuổi: %d | Điểm: %.1f | Xếp loại: %s | %s',
            htmlspecialchars($this->name),
            $this->age,
            $this->score,
            $this->getRank(),
            $this->isPassed() ? 'Đạt' : 'Chưa đạt'
        );
    }
}

function calculateClassAverage(array $students): float
{
    if (count($students) === 0) {
        return 0;
    }

    return array_sum(array_map(static function (Student $student) {
        return $student->score;
    }, $students)) / count($students);
}

function findBestObjectStudent(array $students): ?Student
{
    if (count($students) === 0) {
        return null;
    }

    $bestStudent = $students[0];
    foreach ($students as $student) {
        if ($student->score > $bestStudent->score) {
            $bestStudent = $student;
        }
    }

    return $bestStudent;
}

function countPassedObjectStudents(array $students): int
{
    return count(array_filter($students, static function (Student $student) {
        return $student->isPassed();
    }));
}
