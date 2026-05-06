<?php
function getAllQuest($pdo)
{
    $sql = "SELECT * 
    FROM quest 
    ORDER BY 
    questId ASC";

    return prepSql($pdo,$sql)->fetchAll();
}
