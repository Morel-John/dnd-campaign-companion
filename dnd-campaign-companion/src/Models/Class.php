<?php
function getAllClasses($pdo)
{
    $sql = "SELECT classname, classId 
    FROM class 
    ORDER BY 
    classname ASC";
    
    return prepSql($pdo, $sql)->fetchall();
}
