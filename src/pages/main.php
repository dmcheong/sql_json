<?php
$category = $_GET['category'] ?? null;
include 'components/header.php';

// Sidebar
include 'components/sidebar.php';
// if (isset($_GET['action'])) {
//   $action = $_GET['action'];
//   switch ($action) {
//       case 'delete':
//           include 'delete.php';
//           break;
//       case 'edit':
//           include 'actions/edit.php';
//           break;
//       default:
//           echo "<p>Action inconnue</p>";
//     }
// } 
?>

<!-- Main Content -->
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