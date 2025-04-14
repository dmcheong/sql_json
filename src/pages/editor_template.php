<div class="max-w-7xl mx-auto" 
       x-data="templateGenerator()" 
       x-init="loadDefaultTemplate()">
    
    <h1 class="text-2xl font-bold mb-4 text-center">Générateur JSON / YAML</h1>

    <div class="flex flex-col lg:flex-row gap-4">
      
      <!-- Champ Input -->
      <div class="flex-1">
        <label for="templateInput" class="block text-lg font-medium mb-2">Champ d'édition</label>
        <textarea 
          id="templateInput" 
          x-model="input"
          class="w-full h-96 p-3 border border-gray-300 rounded resize-none font-mono text-sm"
          placeholder="Collez ici votre JSON ou YAML...">
        </textarea>
      </div>

      <!-- Champ Output -->
      <div class="flex-1">
        <label for="templateOutput" class="block text-lg font-medium mb-2">Rendu final</label>
        <textarea 
          id="templateOutput" 
          x-model="output"
          class="w-full h-96 p-3 border border-gray-300 rounded resize-none font-mono text-sm bg-gray-50"
          placeholder="Résultat formaté..." readonly>
        </textarea>
      </div>

    </div>

    <!-- Boutons d'action -->
    <div class="flex flex-wrap justify-center gap-4 mt-6">
      <button 
        @click="generateOutput"
        class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
        Générer
      </button>

      <button 
        @click="reset"
        class="px-6 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">
        Reset
      </button>
    </div>

    <!-- Message d'erreur -->
    <template x-if="error">
      <div class="mt-4 text-center text-red-600 font-semibold">
        <p x-text="error"></p>
      </div>
    </template>

  </div>

  <script>
    function templateGenerator() {
      return {
        input: '',
        output: '',
        error: '',
        
        loadDefaultTemplate() {
          this.input = `{
  "title": "Exemple",
  "description": "Ceci est un template de démonstration",
  "active": true,
  "items": [
    {"name": "Item 1", "value": 100},
    {"name": "Item 2", "value": 200}
  ]
}`;
        },

        generateOutput() {
          this.error = '';
          try {
            // Essayer JSON
            const parsed = JSON.parse(this.input);
            this.output = JSON.stringify(parsed, null, 2);
          } catch (jsonErr) {
            try {
              // Essayer YAML
              const parsed = YAML.parse(this.input);
              this.output = YAML.stringify(parsed);
            } catch (yamlErr) {
              this.error = "Format non valide : le contenu n'est ni un JSON ni un YAML valide.";
              this.output = '';
            }
          }
        },

        reset() {
          this.input = '';
          this.output = '';
          this.error = '';
        }
      }
    }
  </script>