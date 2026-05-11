<?php
class Classes
{
    public function __construct(
        ?int $id = null,
        ?string $name = null
    ) {}

    public static function getAll($pdo): array
    {
        $sql = "SELECT classname, classId 
                FROM class 
                ORDER BY 
                classname ASC";

        return prepSql($pdo, $sql)->fetchAll();
    }
}
