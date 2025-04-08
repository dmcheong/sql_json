<!DOCTYPE html>
<html>
<head>
    <title>📝 Éditeur de JSON</title>
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

    <h1>📥 Glisser un fichier JSON à modifier</h1>

    <div id="drop-area">
        Glissez-déposez un fichier JSON ici<br><br>
        ou<br><br>
        <input type="file" id="jsonFile" accept=".json">
    </div>

    <form id="edit-form" method="POST" action="generate_json.php">
        <input type="text" name="nom" placeholder="Nom"><br>
        <input type="email" name="email" placeholder="Email"><br>
        <button type="submit">📤 Générer le nouveau fichier JSON</button>
    </form>

    <script>
        const dropArea = document.getElementById('drop-area');
        const fileInput = document.getElementById('jsonFile');
        const form = document.getElementById('edit-form');

        function handleFile(file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                try {
                    const data = JSON.parse(e.target.result);
                    form.style.display = "block";
                    form.nom.value = data.nom || '';
                    form.email.value = data.email || '';
                } catch (err) {
                    alert("❌ Fichier JSON invalide.");
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

    <p><a href="liste.php">← Retour à la liste</a></p>

</body>
</html>
