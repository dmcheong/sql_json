<?php
require_once 'classes/FormHandler.php';

$handler = new FormHandler();
$utilisateurs = $handler->tousLesUtilisateurs();

// Générer le JSON
$json = json_encode($utilisateurs, JSON_PRETTY_PRINT);

// Créer le dossier s'il n'existe pas
if (!is_dir('donnees')) {
    mkdir('donnees', 0755, true);
}

// Enregistrer dans un fichier
$fichier = 'donnees/liste_users.json';
file_put_contents($fichier, $json);

// Affichage
echo "<h2>✅ Export JSON effectué</h2>";
echo "<p>Fichier généré : <code>$fichier</code></p>";
echo '<p><a href="' . $fichier . '" target="_blank">📂 Ouvrir le fichier JSON</a></p>';
echo '<hr>';
echo '<pre>' . $json . '</pre>';
