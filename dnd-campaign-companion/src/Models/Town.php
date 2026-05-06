<?php
  function getAllTowns($pdo){
    $sql="SELECT * 
    FROM town 
    ORDER BY 
    townname ASC";
    return prepSql($pdo,$sql)->fetchAll();
  }
?>