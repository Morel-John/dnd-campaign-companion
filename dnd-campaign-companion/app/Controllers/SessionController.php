<?php
$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');

if (!empty($username) && !empty($password)) {
    $sql  = "SELECT *
             FROM user
             WHERE LOWER(username) = LOWER(:username)";
    $user = prepSql($pdo, $sql, ['username' => $username])->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['userId']    = $user['userId'];
        $_SESSION['username']  = $user['username'];
        $_SESSION['user_role'] = $user['role'];

        header('Location: index.php?page=home');
        exit;
    }
}

header('Location: index.php?page=login&error=invalid');
exit;