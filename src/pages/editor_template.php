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

    <!-- Section des templates disponibles -->
    <div class="flex flex-wrap gap-2 mb-4">
      <template x-for="(tpl, name) in templates" :key="name">
        <button 
          class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 text-sm"
          @click="loadTemplate(name)">
          <span x-text="name"></span>
        </button>
      </template>
    </div>

    <!-- Boutons d'action -->
    <div class="flex flex-wrap justify-center gap-4 mt-6">
      <button 
        @click="generateOutput"
        class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
        Générer
      </button>

      <button 
        @click="copyOutput"
        class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700">
        Copier le rendu
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

    templates: {
      "Exemple JSON": `{
  "title": "Exemple",
  "description": "Ceci est un template de démonstration",
  "active": true,
  "items": [
    {"name": "Item 1", "value": 100},
    {"name": "Item 2", "value": 200}
  ]
}`,
      "Staff YAML": `name: Eiji Aonuma
id: zelda-staff-01
worked_on:
  - https://zelda.fanapis.com/api/games/ocarina-of-time
  - https://zelda.fanapis.com/api/games/majora-mask
`,
      "Boss JSON": `{
  "name": "Ganon",
  "type": "Final Boss",
  "difficulty": "Extreme"
}`
    },

    loadTemplate(name) {
      this.input = this.templates[name];
      this.output = '';
      this.error = '';
    },

    loadDefaultTemplate() {
      this.input = this.templates["Exemple JSON"];
    },

    generateOutput() {
      this.error = '';
      try {
        const parsed = JSON.parse(this.input);
        this.output = JSON.stringify(parsed, null, 2);
      } catch (jsonErr) {
        try {
          const parsed = YAML.parse(this.input);
          this.output = YAML.stringify(parsed);
        } catch (yamlErr) {
          this.error = "Format non valide : le contenu n'est ni un JSON ni un YAML valide.";
          this.output = '';
        }
      }
    },

    copyOutput() {
      if (this.output.trim() === '') {
        this.error = "Rien à copier.";
        return;
      }
      navigator.clipboard.writeText(this.output)
        .then(() => this.error = "Rendu copié dans le presse-papier !")
        .catch(() => this.error = "Échec lors de la copie.");
    },

    reset() {
      this.input = '';
      this.output = '';
      this.error = '';
    }
  }
}

  </script>