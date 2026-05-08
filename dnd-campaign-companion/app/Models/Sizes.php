<?php
class Sizes
{
  public function __construct(
    public string $name,
    public string $image,
    public ?int $id = null
  ) {
    $this->id = $id;
    $this->name = $name;
    $this->image = $image;
  }

  public static function getAll($pdo): array
  {
    $sql = "SELECT *
            FROM size
            ORDER BY
            sizename ASC";

    return prepSql($pdo, $sql)->fetchAll();
  }
}
