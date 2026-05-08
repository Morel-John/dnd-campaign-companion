<?php
# load .env for login details
function loadEnv($path) {
    if (!file_exists($path)) return;
    
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;   # Ignore comments
        list($name, $value) = explode('=', $line, 2);   # Cut the information max. into 2 slices. So if password uses = it wont be seperated
        $_ENV[trim($name)] = trim($value);              # Put slice one into $name, and slice two into the $value
    }
}

loadEnv(BASE_PATH . '/.env');

# Insert variable from .env file
$host = $_ENV['DB_HOST'] ?? 'localhost';
$dbname = $_ENV['DB_NAME'] ?? '';
$user = $_ENV['DB_USER'] ?? 'root';
$password = $_ENV['DB_PASS'] ?? '';

$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    # echo "Connection successful!";
} catch (PDOException $e) {
    error_log($e->getMessage());
    die("Connection to database failed. The Beholder probably bite through the cable...!");
}
