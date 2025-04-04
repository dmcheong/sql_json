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
</body>
</html>
