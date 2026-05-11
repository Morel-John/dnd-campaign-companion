<?php
class Sourcebook
{
    public function __construct(
        public string $name,
        public ?int $id = null
    ) {}

    public static function getAll($pdo,$sql){
        $sql = "SELECT * 
                FROM sourcebook";
    }
}
