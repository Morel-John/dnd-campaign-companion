<?php
class Quests
{
    public function __construct(
        public string $name,
        public string $description,
        public string $reward,
        public int $npcId,
        public int $townId,
        public int $statusId,
        public ?int $id = null
    ) {
    }
    public static function getAll($pdo): array
    {
        $sql = "SELECT * 
                FROM quest 
                ORDER BY 
                questId ASC";

        return prepSql($pdo, $sql)->fetchAll();
    }
}
