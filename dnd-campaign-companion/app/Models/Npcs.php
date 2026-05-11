<?php
class Npcs
{
    ## Using Property Promotion to reduce amount of code 
    public function __construct(
        public string $name,
        public string $information,
        public string $image,
        public int $townId,
        public int $raceId,
        public int $professionId,
        public int $classId,
        public int $statusId,
        public int $alignmentId,
        public int $sizeId,
        public ?int $id = null  ## Has to be listed as last since it can be null
    ) {}

    public static function getAll($pdo): array
    {
        $sql = "SELECT * 
                FROM npc 
                ORDER BY 
                npcname ASC";

        return prepSql($pdo, $sql)->fetchAll();
    }

    public static function getInfo($pdo): array
    {
        $sql = "SELECT npcId, information
                FROM npc";

        return prepSql($pdo, $sql)->fetchAll();
    }

    ## Function to insert new NPCs
    public static function create($pdo, array $data): bool
    {
        try {
            $sql = "INSERT INTO npc (npcname, parentraceId, townId, classId, professionId, alignmentId, statusId, sizeId, information, image)
                    VALUES (:name,:parentrace,:town,:class,:profession,:alignment,:status,:size,:info,:image)";

            $stmt = prepSql($pdo, $sql, [
                'name'          => $data['name'],
                'parentrace'    => $data['parentrace'],
                'town'          => $data['town'],
                'class'         => $data['class'],
                'profession'    => $data['profession'],
                'alignment'     => $data['alignment'],
                'status'        => $data['status'],
                'size'          => $data['size'],
                'info'          => $data['info'],
                'image'         => $data['image']
            ]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            // die("Dungeon-Master-Fehler: " . $e->getMessage());
            error_log("Database error: When creating new NPC: " . $e->getMessage());
            return false;
        }
    }
}
