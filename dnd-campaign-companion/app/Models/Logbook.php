<?php
class Logbook
{
    public function __construct(
        public string $date,
        public string $story,
        public string $image,
        public ?int $id = null
    ) {}
    public static function getAll($pdo, $sql)
    {
        $sql = "SELECT *
                From logbook";
    }
}
