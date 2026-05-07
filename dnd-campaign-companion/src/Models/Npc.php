<?php
function getAllNpcs($pdo)
{
    $sql = "SELECT * 
    FROM npc 
    ORDER BY 
    npcname ASC";

    return prepSql($pdo,$sql)->fetchAll();
}

function getInformation($pdo){
    $sql="SELECT npcId, information
    FROM npc";

    return prepSql($pdo,$sql)->fetchAll();
  }