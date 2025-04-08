<?php
require_once 'classes/FormHandlerYML.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);

    $handler = new FormHandlerYML();

    if ($handler->emailExiste($email)) {
        echo "<p style='color:orange'>⚠️ L'email <strong>$email</strong> existe déjà dans la base.</p>";
    } else {
        $handler->ajouterUtilisateur($nom, $email);
        $handler->saveAsYml($nom, $email);
        echo "<p style='color:green'>✅ Utilisateur enregistré et fichier YAML généré.</p>";
    }
} else {
    echo "<p>❌ Requête invalide.</p>";
}
?>

<p><a href="index_yml.php">← Retour</a> | <a href="liste.php">📄 Liste des utilisateurs</a></p>
