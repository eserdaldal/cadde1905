<?php
$host = '127.0.0.1';
$port = '3307';
$db   = 'cadde1905';
$user = 'cadde';
$pass = 'cadde';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";
try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    echo "--- LATEST MEDIA ---\n";
    $latest = $pdo->query("SELECT * FROM media ORDER BY id DESC LIMIT 1")->fetch();
    if ($latest) {
        foreach($latest as $k => $v) {
            echo "$k: $v\n";
        }
    } else {
        echo "No media found.\n";
    }

} catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage();
}
