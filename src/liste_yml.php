<?php
require_once 'classes/FormHandler.php'; // même classe que JSON pour lecture DB
$handler = new FormHandler();
$utilisateurs = $handler->tousLesUtilisateurs();
?>

<h1>📄 Liste des utilisateurs (version YAML)</h1>
<p><a href="index_yml.php">➕ Ajouter via YAML</a> | <a href="export_liste_yml.php">📤 Export global YAML</a></p>

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
            <a href="export_user_yml.php?id=<?= $user['id'] ?>">📁 Générer YML</a> |
            <a href="donnees/user_<?= $user['id'] ?>.yml" download>⬇️ Télécharger YML</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
