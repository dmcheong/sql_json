<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un utilisateur (YML)</title>
</head>
<body>
    <h1>Formulaire YAML</h1>

    <form action="traitement_yml.php" method="POST">
        <label>Nom :</label>
        <input type="text" name="nom" required><br><br>
        <label>Email :</label>
        <input type="email" name="email" required><br><br>
        <button type="submit">Générer YML + Enregistrer</button>
    </form>

    <p><a href="liste.php">← Retour à la liste</a></p>
</body>
</html>
