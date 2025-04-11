<?php
// require_once 'classes/FormHandler.php';

// if (!isset($_GET['id'])) {
//     die("ID manquant");
// }

// $id = (int) $_GET['id'];

// $handler = new FormHandler();
// $user = $handler->getUtilisateur($id);

// if (!$user) {
//     die("Utilisateur introuvable");
// }

// $json = json_encode($user, JSON_PRETTY_PRINT);

// // Créer dossier si besoin
// if (!is_dir('donnees')) {
//     mkdir('donnees', 0755, true);
// }

// // Enregistrer dans un fichier
// $filename = "donnees/user_{$id}.json";
// file_put_contents($filename, $json);

// // Rediriger vers le fichier pour téléchargement
// header("Location: $filename");
// exit;

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'classes/FormHandler.php';

if (!isset($_GET['id'])) {
    die("ID utilisateur manquant.");
}

$handler = new FormHandler();
$user = $handler->getUtilisateur((int)$_GET['id']);

if (!$user) {
    die("Utilisateur introuvable.");
}

$data = [
    'nom' => $user['nom'],
    'email' => $user['email'],
    'timestamp' => $user['created_at'] ?? date('Y-m-d H:i:s')
];

$json = json_encode($data, JSON_PRETTY_PRINT);

if (!is_dir('donnees')) {
    mkdir('donnees', 0755, true);
}

$filename = "donnees/user_{$user['id']}.json";
file_put_contents($filename, $json);

header("Location: $filename");
exit;

?>