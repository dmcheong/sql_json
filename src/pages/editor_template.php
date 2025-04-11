 <h1 class="text-2xl font-bold mb-4 text-center">Éditeur de templates JSON / YAML</h1>

    <div class="flex flex-col lg:flex-row gap-4">
      
      <!-- Champ Input -->
      <div class="flex-1">
        <label for="templateInput" class="block text-lg font-medium mb-2">Champ d'édition (JSON / YAML)</label>
        <textarea 
          id="templateInput" 
          x-model="input"
          class="w-full h-96 p-3 border border-gray-300 rounded resize-none font-mono text-sm"
          placeholder="Collez ou modifiez ici votre template...">
        </textarea>
      </div>

      <!-- Champ Output -->
      <div class="flex-1">
        <label for="templateOutput" class="block text-lg font-medium mb-2">Rendu final</label>
        <textarea 
          id="templateOutput" 
          x-model="output"
          class="w-full h-96 p-3 border border-gray-300 rounded resize-none font-mono text-sm bg-gray-50"
          placeholder="Rendu formaté ici..." readonly>
        </textarea>
      </div>

    </div>
*<?php
echo "JE suis làààà!!!!!!";
?>