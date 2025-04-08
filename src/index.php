<?php
require_once 'index_yml.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Formulaire JSON + BDD</title>
</head>
<body>
    <h1>Ajouter un utilisateur</h1>

    <form action="traitement.php" method="POST">
        <label>Nom :</label>
        <input type="text" name="nom" required><br><br>

        <label>Email :</label>
        <input type="email" name="email" required><br><br>

        <button type="submit">Envoyer</button>
    </form>

    <hr>
    <p><a href="read.php">📄 Voir la liste des utilisateurs</a></p>
    <p><a href="editor_json.php">📄 créer un nouveau json à partir d'un existant</a></p>
    <p><a href="editeur_yml.php">📄 créer un nouveau yml à partir d'un existant</a></p>
</body>
</html>

<?php
require_once 'import_json.php';
// require_once 'editor_json.php';
require_once 'import_yml.php';
?>
