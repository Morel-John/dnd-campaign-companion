<?php
class Races
{
    public function __construct(
        public string $name,
        public int $raceId,
        public int $bookId,
        public ?int $id = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->raceId = $raceId;
        $this->bookId = $bookId;
    }
    public static function getAllRaces($pdo): array
    {
        $sql = "SELECT pr.parentracename, r.racename,b.bookname,pr.parentraceId
                FROM race AS r
                JOIN parentrace AS pr ON pr.parentraceId =r.parentraceId
                JOIN sourcebook AS b ON b.bookId = r.bookId";

        return prepSql($pdo, $sql)->fetchAll();
    }
}
