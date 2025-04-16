<?php
// sidebar component menu navigate
$categories = [
  'Accueil' => 'accueil',
  'Liste' => 'liste',
  'Edition' => 'editor_template',
  'Ajouter un fichier' => 'editor'
];
?>

<div class="w-64 bg-white shadow-md p-4">
  <h2 class="text-xl font-semibold mb-4">Menu</h2>
  <ul class="space-y-2">
    <?php foreach ($categories as $label => $endpoint): ?>
      <li>
        <a href="?category=<?= $endpoint ?>" class="block py-2 px-3 rounded hover:bg-gray-200">
          <?= htmlspecialchars($label) ?>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
</div>