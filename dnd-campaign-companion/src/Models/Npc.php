<?php
function getAllNpcs($pdo)
{
    $sql = "SELECT * 
    FROM npc 
    ORDER BY 
    npcname ASC";

    return prepSql($pdo,$sql)->fetchAll();
}
