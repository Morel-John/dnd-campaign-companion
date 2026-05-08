<?php
class Classes{
    public ?int $id;
    public ?string $name;

    public function __construct(?int $id=null, ?string $name=null)
    {
        $this->id=$id;
        $this->name=$name;
    }

    public static function getAll($pdo): array
    {
        $sql = "SELECT classname, classId 
                FROM class 
                ORDER BY 
                classname ASC";
    
    return prepSql($pdo, $sql)->fetchAll();
    }
    }
