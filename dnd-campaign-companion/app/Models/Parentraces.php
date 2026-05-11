<?php
class Parentraces
{
    public function __construct(
        public string $name,
        public int $bookId,
        public ?int $id = null
    ) {}
    public static function getAllParenraces($pdo): array
    {
        $sql = "SELECT parentraceId, parentracename 
                FROM parentrace 
                ORDER BY 
                parentracename ASC";

        return prepSql($pdo, $sql)->fetchAll();
    }
}
