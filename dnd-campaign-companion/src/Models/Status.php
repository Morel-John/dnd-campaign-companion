<?php
  function getAllNpcStatus($pdo){
    $sql="SELECT *
    FROM status
    WHERE 
    statusId= 1 OR statusId = 2 OR statusId = 3
    ORDER BY
    statusname ASC";

    return prepSql($pdo, $sql)->fetchAll();
  }
?>