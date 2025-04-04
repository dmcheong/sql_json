<?php
require_once 'classes/FormHandler.php';
$handler = new FormHandler();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $handler->modifierUtilisateur($_POST['id'], $_POST['nom'], $_POST['email']);
    header('Location: read.php');
    exit;
}

$user = $handler->getUtilisateur($_GET['id']);
?>

<h1>Modifier l'utilisateur</h1>
<form method="POST">
    <input type="hidden" name="id" value="<?= $user['id'] ?>">
    Nom : <input type="text" name="nom" value="<?= htmlspecialchars($user['nom']) ?>"><br><br>
    Email : <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>"><br><br>
    <button type="submit">Enregistrer</button>
</form>
