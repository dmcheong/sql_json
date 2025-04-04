<?php
require_once 'classes/FormHandler.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $email = $_POST['email'];

    $handler = new FormHandler();

    $handler->saveAsJson($nom, $email);
    $handler->ajouterUtilisateur($nom, $email);

    echo "<h2>Données traitées avec succès !</h2>";
    echo '<p><a href="read.php">📄 Voir la liste des utilisateurs</a></p>';
} else {
    echo "<h2>Requête invalide</h2>";
}
