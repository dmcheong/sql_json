<?php
$host = getenv('DB_HOST') ?: 'db';
$db   = getenv('DB_NAME') ?: 'monapp';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: 'root';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass);
    echo "<h2>✅ Connexion à MySQL réussie !</h2>";
} catch (PDOException $e) {
    echo "<h2>❌ Échec de la connexion à MySQL :</h2>";
    echo "<p>" . $e->getMessage() . "</p>";
}
