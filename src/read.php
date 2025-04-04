<?php
require_once 'classes/FormHandler.php';
$handler = new FormHandler();
$utilisateurs = $handler->tousLesUtilisateurs();
?>

<h1>Liste des utilisateurs</h1>
<a href="index.php">➕ Ajouter un utilisateur</a>
<a href="export_json.php">📤 Exporter en JSON</a>
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
            <a href="update.php?id=<?= $user['id'] ?>">✏️ Modifier</a> |
            <a href="delete.php?id=<?= $user['id'] ?>" onclick="return confirm('Supprimer ?')">🗑️ Supprimer</a>
            <a href="export_user.php?id=<?= $user['id'] ?>">📁 Générer JSON</a> |
            <a href="donnees/user_<?= $user['id'] ?>.json" download>⬇️ Télécharger JSON</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
