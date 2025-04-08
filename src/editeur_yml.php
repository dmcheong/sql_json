<!DOCTYPE html>
<html>
<head>
    <title>📝 Éditeur de YAML</title>
    <style>
        #drop-area {
            border: 2px dashed #ccc;
            padding: 30px;
            text-align: center;
            color: #888;
            margin: 50px auto;
            width: 400px;
            background-color: #f9f9f9;
        }

        #drop-area.dragover {
            border-color: #000;
            background-color: #e9e9e9;
        }

        form {
            margin: 40px auto;
            width: 400px;
            display: none;
        }

        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
        }
    </style>
</head>
<body>

    <h1>📥 Glisser un fichier YAML à modifier</h1>

    <div id="drop-area">
        Glissez-déposez un fichier `.yml` ici<br><br>
        ou<br><br>
        <input type="file" id="ymlFile" accept=".yml,.yaml">
    </div>

    <form id="edit-form" method="POST" action="generate_yml.php">
        <input type="text" name="nom" placeholder="Nom"><br>
        <input type="email" name="email" placeholder="Email"><br>
        <button type="submit">📤 Générer un nouveau fichier YML</button>
    </form>

    <p><a href="liste_yml.php">← Retour à la liste YAML</a></p>

    <script>
        const dropArea = document.getElementById('drop-area');
        const fileInput = document.getElementById('ymlFile');
        const form = document.getElementById('edit-form');

        function parseYML(content) {
            const lines = content.split('\n');
            const data = {};
            lines.forEach(line => {
                if (line.includes(':')) {
                    const parts = line.split(':', 2);
                    const key = parts[0].trim();
                    const value = parts[1].trim().replace(/^"(.*)"$/, '$1');
                    data[key] = value;
                }
            });
            return data;
        }

        function handleFile(file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                try {
                    const data = parseYML(e.target.result);
                    form.style.display = "block";
                    form.nom.value = data.nom || '';
                    form.email.value = data.email || '';
                } catch (err) {
                    alert("❌ Fichier YAML invalide.");
                }
            };
            reader.readAsText(file);
        }

        dropArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropArea.classList.add('dragover');
        });

        dropArea.addEventListener('dragleave', () => {
            dropArea.classList.remove('dragover');
        });

        dropArea.addEventListener('drop', (e) => {
            e.preventDefault();
            dropArea.classList.remove('dragover');
            const file = e.dataTransfer.files[0];
            handleFile(file);
        });

        fileInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            handleFile(file);
        });
    </script>

</body>
</html>
