<?php

// ======================================
// 🛠️ FONCTION : Chargement du fichier .env
// ======================================
function loadEnv($file = __DIR__ . '/../../.env') {
    if (!file_exists($file)) return;

    $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        // Ignorer les commentaires ou lignes vides
        if (strpos(trim($line), '#') === 0 || !str_contains($line, '=')) continue;

        list($key, $value) = explode('=', $line, 2);
        $key = trim($key);
        $value = trim($value, " \"'");

        // Ajouter dans $_ENV sans écraser s'il existe déjà
        if (!isset($_ENV[$key])) {
            $_ENV[$key] = $value;
        }
    }
}

// ======================================
// 🔌 FONCTION : Connexion MySQL avec mysqli
// ======================================
function getDBConnection() {
    loadEnv(); // Charger les variables d'environnement

    // Lire les valeurs du .env (avec fallback de sécurité)
    $host = $_ENV['DB_HOST'] ?? 'localhost';
    $user = $_ENV['DB_USER'] ?? 'root';
    $pass = $_ENV['DB_PASS'] ?? '';
    $dbname = $_ENV['DB_NAME'] ?? 'test';

    // Activer les erreurs de mysqli en mode exception (facultatif mais pratique)
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    try {
        $conn = new mysqli($host, $user, $pass, $dbname);
        $conn->set_charset("utf8mb4"); // Optionnel : encodage sûr
        return $conn;
    } catch (mysqli_sql_exception $e) {
        // Gérer proprement l'erreur (log à venir si besoin)
        die("❌ Erreur de connexion MySQL : " . $e->getMessage());
    }
}

?>