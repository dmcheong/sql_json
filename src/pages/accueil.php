<?php
// welcome page
echo "<h1 class='text-3xl font-bold mb-4'>Bienvenue !</h1>";
echo "<p>Bienvenue dans votre service YML/JSON.</p>";
echo "hell o world";
?>
<div x-data="{ count: 0 }" class="p-4">
  <button @click="count++" class="border px-4 py-2 bg-blue-500 text-white rounded">
    Clique-moi
  </button>
  <p class="mt-2">Compteur : <span x-text="count"></span></p>
</div>