<?php
$category = $_GET['category'] ?? null;
include 'components/header.php';

// Sidebar
include 'components/sidebar.php';
?>

<!-- Main page for Contents with include -->
<div class="flex-1 p-8">
  <?php
    if ($category && file_exists("pages/$category.php")) {
      include "pages/$category.php";
    } else {
      include "pages/accueil.php";
    }
  ?>
</div>

<?php
include 'components/footer.php';
?>