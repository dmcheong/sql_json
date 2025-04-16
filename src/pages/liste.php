<?php
// liste des fichiers en formats JSON & YAML
require_once 'classes/FormHandler.php';

$handler = new FormHandler();
// Suppression si formulaire soumis en POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $id = intval($_POST['delete_id']);
    $handler->supprimerUtilisateur($id);
    // Petite redirection pour éviter le resoumission du formulaire en rafraîchissant
    // header("Location: " . $_SERVER['PHP_SELF']);
    // exit;
}

// // Génération JSON
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['json_id'])) {
//     $id = intval($_POST['json_id']);
//     $handler->genererJsonParId($id);
//     // header("Location: " . $_SERVER['PHP_SELF']);
//     // exit;
// }

// // Génération YML
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['yml_id'])) {
//     $id = intval($_POST['yml_id']);
//     $handler->genererYmlParId($id);
//     // header("Location: " . $_SERVER['PHP_SELF']);
//     // exit;
// }

// // Génération + téléchargement immédiat JSON
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['json_download_id'])) {
//     $id = intval($_POST['json_download_id']);
//     $handler->genererJsonParId($id, true); // true = téléchargement
//     exit;
// }

// // Génération + téléchargement immédiat YML
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['yml_download_id'])) {
//     $id = intval($_POST['yml_download_id']);
//     $handler->genererYmlParId($id, true); // true = téléchargement
//     exit;
// }

$utilisateurs = $handler->tousLesUtilisateurs();
?>

<h1>Liste des utilisateurs</h1>
<table border="1" cellpadding="5">
    <tr>
        <th>Nom</th><th>Email</th><th>Actions</th>
    </tr>
    <?php foreach ($utilisateurs as $user): ?>
    <tr>
        <td hidden><?= htmlspecialchars($user['id']) ?></td>
        <td><?= htmlspecialchars($user['nom']) ?></td>
        <td><?= htmlspecialchars($user['email']) ?></td>
        <td style="display: flex; gap: 5px;">
            <!-- Formulaire de suppression par POST -->
            <form method="POST" onsubmit="return confirm('Supprimer ?')">
                <input type="hidden" name="delete_id" value="<?= $user['id'] ?>">
                <button type="submit">🗑️ Supprimer</button>
            </form>

            <!-- Voir JSON dans un nouvel onglet
            <form method="POST" style="display:inline;">
                <input type="hidden" name="json_show" value="<?= $user['id'] ?>">
                <button type="submit">👁️ Voir JSON</button>
            </form>
            <a href="donnees/user_?= $user['id'] ?>.json" download>⬇️</a> -->

            <!-- Voir YML -->
            <!-- <form method="POST" style="display:inline;">
                <input type="hidden" name="yml_show" value="<?= $user['id'] ?>">
                <button type="submit">👁️ Voir YML</button>
            </form>
            <a href="donnees/user_?= $user['id'] ?>.yml" download>⬇️</a> -->

            <!-- Générer JSON -->
            <form method="POST" style="display:inline;">
                <input type="hidden" name="json_id" value="<?= $user['id'] ?>">
                <button type="submit">📁 Générer JSON</button>
            </form>
            <!-- Générer et télécharger JSON -->
            <form method="POST" style="display:inline;">
                <input type="hidden" name="json_download_id" value="<?= $user['id'] ?>">
                <button type="submit">⬇️ Télécharger JSON</button>
            </form>

            <!-- Générer YML -->
            <form method="POST" style="display:inline;">
                <input type="hidden" name="yml_id" value="<?= $user['id'] ?>">
                <button type="submit">📁 Générer YML</button>
            </form>
            <!-- Générer et télécharger YML -->
            <form method="POST" style="display:inline;">
                <input type="hidden" name="yml_download_id" value="<?= $user['id'] ?>">
                <button type="submit">⬇️ Télécharger YML</button>
            </form>

        </td>
    </tr>
    <?php endforeach; ?>
</table>
