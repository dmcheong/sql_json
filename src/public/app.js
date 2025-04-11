function templateTool() {
    return {
      rawInput: '',
      renderedOutput: '',
      templates: [
        `{"name":"Link","game":"Ocarina of Time"}`,
        `---
  name: Zelda
  role: Princess
  game: Breath of the Wild`
      ],
  
      generate() {
        try {
          if (this.rawInput.trim().startsWith('{')) {
            this.renderedOutput = JSON.stringify(JSON.parse(this.rawInput), null, 2);
          } else {
            // suppose que YAML est autorisé côté serveur ou client
            this.renderedOutput = this.rawInput; // pour le moment, brut
          }
        } catch (e) {
          this.renderedOutput = "❌ Erreur de format : " + e.message;
        }
      },
  
      reset() {
        this.rawInput = '';
        this.renderedOutput = '';
      },
  
      loadTemplate(tpl) {
        this.rawInput = tpl;
        this.generate();
      },
  
      copyOutput() {
        navigator.clipboard.writeText(this.renderedOutput);
      },
  
      downloadOutput() {
        const blob = new Blob([this.renderedOutput], { type: "text/plain;charset=utf-8" });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = "template.txt";
        a.click();
        URL.revokeObjectURL(url);
      }
    }
  }
  