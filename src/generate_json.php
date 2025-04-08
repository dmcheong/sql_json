<?php
require_once 'classes/FormHandler.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nom'], $_POST['email'])) {
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);

    $data = [
        'nom' => htmlspecialchars($nom),
        'email' => htmlspecialchars($email),
        'timestamp' => date('Y-m-d H:i:s')
    ];

    if (!is_dir('donnees')) {
        mkdir('donnees', 0755, true);
    }

    // Générer un nom de fichier unique
    $filename = 'donnees/generated_' . time() . '.json';
    file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));

    // Insertion dans la base
    $handler = new FormHandler();

    if ($handler->emailExiste($email)) {
        echo "<h2>⚠️ L'email <code>$email</code> existe déjà dans la base.</h2>";
    } else {
        $handler->ajouterUtilisateur($nom, $email);
        echo "<h2>✅ Données insérées dans la base avec succès.</h2>";
    }

    echo "<p>📁 Fichier généré : <a href=\"$filename\" target=\"_blank\">$filename</a></p>";
    echo "<p><a href=\"json_editor.php\">↩️ Retour à l'éditeur</a></p>";
    echo "<p><a href=\"liste.php\">📄 Voir la liste des utilisateurs</a></p>";
} else {
    echo "❌ Données manquantes.";
}
