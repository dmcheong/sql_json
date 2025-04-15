<?php
// header component

// // appel yaml from node_module
// $yamlData = shell_exec("node /app/parseYaml.js");
// $data = json_decode($yamlData, true);
// echo "<pre>";
// print_r($data);
// echo "</pre>";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>sql_json_yml</title>
  <link rel="stylesheet" href="assets/css/output.css">
   <!-- Alpinejs local copié de /app/node_modules -->
  <script defer src="/assets/vendor/alpine/alpine.min.js"></script>
  <!-- Alpine.js via CDN (version stable) -->
  <!-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> -->
  <script defer src="/assets/vendor/yaml/yaml.min.js"></script> <!-- YAML JS local -->
</head>
<body class="bg-gray-100 min-h-screen p-4" x-data="templateTool()">
  <div class="flex min-h-screen">
