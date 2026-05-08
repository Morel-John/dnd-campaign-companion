<?php
class Towns
{
  public function __construct(
    public string $name,
    public ?int $id = null
  ) {
    $this->id = $id;
    $this->name = $name;
  }
  public static function getAll($pdo):array
  {
    $sql = "SELECT * 
            FROM town 
            ORDER BY 
            townname ASC";
            
    return prepSql($pdo, $sql)->fetchAll();
  }
}
