<?php
## Function to simplify htmlspecialchars that prevent Cross-Site Scripting
function e($variable){
    return htmlspecialchars($variable ?? ' ', ENT_QUOTES, 'UTF-8');
}
## Function to simplify preparing SQL-Orders 
function prepSql($pdo, $sql, $params = []) {
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt;
}