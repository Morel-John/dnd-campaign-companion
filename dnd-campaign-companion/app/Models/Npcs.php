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
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->information = $information;
        $this->image = $image;
        $this->townId = $townId;
        $this->raceId = $raceId;
        $this->professionId = $professionId;
        $this->classId = $classId;
        $this->statusId = $statusId;
        $this->alignmentId = $alignmentId;
        $this->sizeId = $sizeId;
    }

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
}
