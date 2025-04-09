<?php
require_once 'classes/FormHandler.php';

if (!isset($_GET['id'])) {
    die("ID utilisateur manquant.");
}

$handler = new FormHandler();
$user = $handler->getUtilisateur((int)$_GET['id']);

if (!$user) {
    die("Utilisateur non trouvé.");
}

// Génération YAML à la main
$yml = "";
foreach ($user as $key => $value) {
    $yml .= "$key: \"$value\"\n";
}

if (!is_dir('donnees')) {
    mkdir('donnees', 0755, true);
}

$filename = "donnees/user_{$user['id']}.yml";
file_put_contents($filename, $yml);

// Redirection vers le fichier généré
header("Location: $filename");
exit;
?>