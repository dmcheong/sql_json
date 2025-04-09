<?php
// liste des fichiers en formats JSON
require_once 'classes/FormHandler.php';
$handler = new FormHandler();
$utilisateurs = $handler->tousLesUtilisateurs();
?>

<h1>Liste des utilisateurs</h1>
<!-- <a href="editor.php">➕ Ajouter un fichier</a> -->
<table border="1" cellpadding="5">
    <tr>
        <th>Nom</th><th>Email</th><th>Actions</th>
    </tr>
    <?php foreach ($utilisateurs as $user): ?>
    <tr>
        <td hidden><?= htmlspecialchars($user['id']) ?></td>
        <td><?= htmlspecialchars($user['nom']) ?></td>
        <td><?= htmlspecialchars($user['email']) ?></td>
        <td>
            <!-- <a href="update.php?id=?= $user['id'] ?>">✏️ Modifier</a> | -->
            <a href="delete.php?id=<?= $user['id'] ?>" onclick="return confirm('Supprimer ?')">🗑️ Supprimer</a> |
            <!-- <a href="export_json.php?id=<?= $user['id'] ?>">📁 Générer JSON</a> | -->
            <!-- <a href="donnees/user_<?= $user['id'] ?>.json" download>⬇️ Télécharger JSON</a> | -->
            <!-- <a href="export_yml.php?id=<?= $user['id'] ?>">📁 Générer YML</a> | -->
            <!-- <a href="donnees/user_<?= $user['id'] ?>.yml" download>⬇️ Télécharger YML</a> | -->
        </td>
    </tr>
    <?php endforeach; ?>
</table>


<h1>Liste des utilisateurs</h1>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th><th>Nom</th><th>Email</th><th>Actions</th>
    </tr>
    <?php foreach ($utilisateurs as $user): ?>
    <tr>
        <td><?= $user['id'] ?></td>
        <td><?= htmlspecialchars($user['nom']) ?></td>
        <td><?= htmlspecialchars($user['email']) ?></td>
        <td>
            <form action="delete.php" method="POST" style="display:inline;">
                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                <button type="submit" onclick="return confirm('Supprimer ?')">🗑️ Supprimer</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>