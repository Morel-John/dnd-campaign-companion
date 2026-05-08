<?php
class Status
{
  public function __construct(
    public string $name,
    public ?int $id = null
  ) {
    $this->id = $id;
    $this->name = $name;
  }
  public static function getAllNpcStatus($pdo): array
  {
    $sql = "SELECT *
            FROM status
            WHERE 
            statusId= 1 OR statusId = 2 OR statusId = 3
            ORDER BY
            statusname ASC";

    return prepSql($pdo, $sql)->fetchAll();
  }
}
