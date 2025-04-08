<?php
require_once 'classes/FormHandler.php';

$handler = new FormHandler();
$users = $handler->tousLesUtilisateurs();

$yml = "---\n";
foreach ($users as $user) {
    $yml .= "- id: \"{$user['id']}\"\n";
    $yml .= "  nom: \"{$user['nom']}\"\n";
    $yml .= "  email: \"{$user['email']}\"\n";
    $yml .= "  created_at: \"{$user['created_at']}\"\n";
}

if (!is_dir('donnees')) {
    mkdir('donnees', 0755, true);
}

$filename = 'donnees/liste_users.yml';
file_put_contents($filename, $yml);

header("Location: $filename");
exit;
