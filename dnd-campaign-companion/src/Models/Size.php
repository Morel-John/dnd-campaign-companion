<?php
  function getAllSizes($pdo){
    $sql= "SELECT *
    FROM size
    ORDER BY
    sizename ASC";

    return prepSql($pdo, $sql)->fetchAll();
  }
?>