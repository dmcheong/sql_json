<?php

require_once 'config/db_config.php';

$conn = getDBConnection();
echo "✅ Connexion réussie à la base : " . $_ENV['DB_NAME'];

?>