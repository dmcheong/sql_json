<?php require_once 'classes/FormHandler.php'; ?>
<!-- Drag & Drop form with insert mysql bdd -->
<!DOCTYPE html>
<html>
<head>
    <title>🧠 Éditeur universel JSON/YAML</title>
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

        input[type="text"], input[type="email"], select {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
        }
    </style>
</head>
<body>

<h1>📥 Glisser un fichier JSON ou YML</h1>

<div id="drop-area">
    Glissez un fichier `.json` ou `.yml` ici<br><br>
    ou<br><br>
    <input type="file" id="dataFile" accept=".json,.yml,.yaml">
</div>

<form id="edit-form" method="POST">
    <input type="text" name="nom" id="nom" placeholder="Nom" required><br>
    <input type="email" name="email" id="email" placeholder="Email" required><br>
    <select name="format" id="format">
        <option value="json">📄 Générer JSON</option>
        <option value="yml">📄 Générer YAML</option>
    </select><br>
    <button type="submit">✅ Générer & Insérer</button>
</form>

<script>
    const dropArea = document.getElementById('drop-area');
    const fileInput = document.getElementById('dataFile');
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

    function parseFile(file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const content = e.target.result;
            let data = {};
            try {
                if (file.name.endsWith('.json')) {
                    data = JSON.parse(content);
                    document.getElementById('format').value = 'json';
                } else if (file.name.endsWith('.yml') || file.name.endsWith('.yaml')) {
                    data = parseYML(content);
                    document.getElementById('format').value = 'yml';
                } else {
                    alert("Format non reconnu.");
                    return;
                }

                document.getElementById('nom').value = data.nom || '';
                document.getElementById('email').value = data.email || '';
                document.getElementById('edit-form').style.display = "block";

            } catch (err) {
                alert("Erreur de lecture du fichier : " + err.message);
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
        parseFile(file);
    });

    fileInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        parseFile(file);
    });
</script>

</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nom'], $_POST['email'], $_POST['format'])) {
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $format = $_POST['format'];
    $timestamp = date('Y-m-d H:i:s');

    if (!is_dir('donnees')) mkdir('donnees', 0755, true);

    if ($format === 'json') {
        $data = [
            'nom' => $nom,
            'email' => $email,
            'timestamp' => $timestamp
        ];
        $filename = 'donnees/generated_' . time() . '.json';
        file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));

        $handler = new FormHandler();
        if (!$handler->emailExiste($email)) {
            $handler->ajouterUtilisateur($nom, $email);
            echo "<p style='color:green'>✅ Utilisateur inséré en base (JSON)</p>";
        } else {
            echo "<p style='color:orange'>⚠️ Email déjà existant (JSON)</p>";
        }
    }

    if ($format === 'yml') {
        $yml = "nom: \"$nom\"\nemail: \"$email\"\ntimestamp: \"$timestamp\"\n";
        $filename = 'donnees/generated_' . time() . '.yml';
        file_put_contents($filename, $yml);

        $handler = new FormHandler();
        if (!$handler->emailExiste($email)) {
            $handler->ajouterUtilisateur($nom, $email);
            echo "<p style='color:green'>✅ Utilisateur inséré en base (YML)</p>";
        } else {
            echo "<p style='color:orange'>⚠️ Email déjà existant (YML)</p>";
        }
    }

    echo "<p>📁 Fichier généré : <a href=\"$filename\" target=\"_blank\">$filename</a></p>";
}
?>
