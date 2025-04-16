<?php
// header component
include_once 'classes/FormHandler.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>sql_json_yml</title>
  <!-- Lien pour tailwind -->
  <link rel="stylesheet" href="assets/css/output.css">
   <!-- Alpinejs local copié de /app/node_modules -->
  <script defer src="/assets/vendor/alpine/alpine.min.js"></script>
  <!-- CDN yaml pour test -->
  <!-- <script defer src="https://cdn.jsdelivr.net/npm/js-yaml@4.1.0/dist/js-yaml.min.js"></script> -->
  <!-- YAML JS local mais non utiliser -->
  <script defer src="/assets/vendor/yaml/yaml.min.js"></script>
  <!-- YAML JS local mais non utiliser -->
  <script defer src="/classes/scriptJS.js"></script> 
</head>
<body class="bg-gray-100 min-h-screen p-4" >
  <div class="flex min-h-screen">
