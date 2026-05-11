<?php
class Subclass
{
    public function __construct(
        public string $name,
        public ?int $classId = null,
        public ?int $bookId = null,
        public ?int $id = null
    ) {}

    public static function getAll($pdo, $sql)
    {
        $sql = "SELECT *
                FROM subclass";
    }
}
