<?php
$category = $_GET['category'] ?? null;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>sql_json_yml</title>
  <link rel="stylesheet" href="/public/style.css">
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 text-gray-800">
  <div class="flex min-h-screen">
    
    <!-- Sidebar -->
    <?php include 'components/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="flex-1 p-8">
      <?php
        if ($category && file_exists("pages/$category.php")) {
          include "pages/$category.php";
        } else {
          echo "<h1 class='text-3xl font-bold mb-4'>Bienvenue !</h1>";
          echo "<p>Sélectionne votre format dans le menu de gauche.</p>";
        }
      ?>
    </div>
  </div>
</body>
</html>