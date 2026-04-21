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

    echo "--- LATEST NEWS ---\n";
    $latest = $pdo->query("SELECT id, title, slug, created_at FROM news ORDER BY id DESC LIMIT 5")->fetchAll();
    if ($latest) {
        foreach($latest as $row) {
            echo "ID: {$row['id']} | Title: {$row['title']} | Created: {$row['created_at']}\n";
        }
    } else {
        echo "No news found.\n";
    }

} catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage();
}
