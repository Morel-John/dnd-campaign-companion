<?php
function getAllRaces($pdo)
{
    $sql = "SELECT pr.parentracename, r.racename,b.bookname,pr.parentraceId
            FROM race AS r
            JOIN parentrace AS pr ON pr.parentraceId =r.parentraceId
            JOIN sourcebook AS b ON b.bookId = r.bookId";

    return prepSql($pdo,$sql)->fetchAll();
}

function getAllParenraces($pdo){
    $sql="SELECT parentraceId, parentracename 
    FROM parentrace 
    ORDER BY 
    parentracename ASC";
    
    return prepSql($pdo,$sql)->fetchAll();
}
