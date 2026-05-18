<?php
## Creating class Alignment
class Alignment
{
  ## Building contructor with parameters that can be null (id = auto-increment)
  ## To be able to use null need to put ? infront of variabletype
  public function __construct(
    ?int $id = null,
    ?string $name = null
  ) {}

  ## Function to get all information from database from alignment
  public static function getAll($pdo): array
  {
    $sql = "SELECT *
            FROM alignment
            ORDER BY
            alignmentname ASC";

    ## Return value as array
    return prepSql($pdo, $sql)->fetchAll();
  }
}
