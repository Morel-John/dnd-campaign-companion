<?php
function getAllProfession($pdo)
{
    $sql = "SELECT *
    FROM profession
    ORDER BY 
    professionname ASC";

    return prepSql($pdo, $sql)->fetchAll();
}
