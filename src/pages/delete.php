<?php

require_once 'classes/FormHandler.php';
$handler = new FormHandler();
$handler->supprimerUtilisateur($_GET['id']);
header('Location: liste.php');
exit;
?>