<?php
class Profession
{
    public function __construct(
        public ?string $name = null,
        public ?int $id = null
    ) {}

    public static function getAll($pdo): array
    {
        $sql = "SELECT *
                FROM profession
                ORDER BY 
                professionname ASC";

        return prepSql($pdo, $sql)->fetchAll();
    }
}
