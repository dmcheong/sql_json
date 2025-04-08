<?php
require_once 'classes/FormHandlerYML.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nom'], $_POST['email'])) {
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);

    $data = [
        'nom' => $nom,
        'email' => $email,
        'timestamp' => date('Y-m-d H:i:s')
    ];

    $yml = "";
    foreach ($data as $key => $value) {
        $yml .= "$key: \"$value\"\n";
    }

    if (!is_dir('donnees')) {
        mkdir('donnees', 0755, true);
    }

    $filename = 'donnees/generated_' . time() . '.yml';
    file_put_contents($filename, $yml);

    // Insertion en base (optionnel ici, désactivé par défaut)
    $handler = new FormHandlerYML();
    if (!$handler->emailExiste($email)) {
        $handler->ajouterUtilisateur($nom, $email);
        echo "<p style='color:green'>✅ Données enregistrées dans la base.</p>";
    } else {
        echo "<p style='color:orange'>⚠️ Email déjà présent, pas de réinsertion.</p>";
    }

    echo "<h2>✅ Fichier généré :</h2>";
    echo "<p><a href=\"$filename\" target=\"_blank\">📁 Ouvrir le fichier YML</a></p>";
    echo "<p><a href=\"editeur_yml.php\">↩️ Retour à l’éditeur</a></p>";
} else {
    echo "❌ Données manquantes.";
}
