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

    public static function getById($pdo, int $id)
    {
        $sql = "SELECT *
                FROM npc
                WHERE npcId =:id";

        return prepSql($pdo, $sql, ['id' => $id])->fetch();
    }

    ## Function to CREATE new NPCs
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

    ## Function to UPDATE NPC
    public static function update($pdo, array $data): bool
    {
        try {
            $sql = "UPDATE  npc
                    SET     npcname =:name,
                            parentraceId =:parentrace,
                            townId =:town,
                            classId =:class,
                            professionId =:profession,
                            alignmentId =:alignment,
                            statusId =:status,
                            sizeId =:size,
                            information =:info,
                            image =:image
                    WHERE   npcId =:id";

            $stmt = prepSql($pdo, $sql, [
                'name'       => $data['name'],
                'parentrace' => $data['parentrace'],
                'town'       => $data['town'],
                'class'      => $data['class'],
                'profession' => $data['profession'],
                'alignment'  => $data['alignment'],
                'status'     => $data['status'],
                'size'       => $data['size'],
                'info'       => $data['info'],
                'image'      => $data['image'],
                'id'         => $data['id']
            ]);
            return true;
        } catch (PDOException $e) {
            error_log("Update error: " . $e->getMessage());
            return false;
        }
    }

    ## Function to DELETE
    public static function delete($pdo, int $id): bool
    {
        try {
            $sql = "DELETE FROM npc 
                    WHERE npcId = ?";
            $stmt = prepSql($pdo, $sql, [$id]);
            return true;
        } catch (PDOException $e) {
            error_log("Delete error: " . $e->getMessage());
            return false;
        }
    }
}
