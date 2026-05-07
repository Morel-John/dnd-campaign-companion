<?php
  function getAllAlignment($pdo){
    $sql= "SELECT *
    FROM alignment
    ORDER BY
    alignmentname ASC";

    return prepSql($pdo, $sql)->fetchAll();
  }
?>