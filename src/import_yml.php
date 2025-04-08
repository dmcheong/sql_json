<?php
require_once 'classes/FormHandlerYML.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Importer un utilisateur (YAML)</title>
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
    </style>
</head>
<body>
    <h1>📥 Importer un utilisateur via un fichier YAML</h1>

    <form id="upload-form" action="import_yml.php" method="POST" enctype="multipart/form-data">
        <div id="drop-area">
            Glissez-déposez un fichier `.yml` ici<br><br>
            ou<br><br>
            <input type="file" name="ymlfile" accept=".yml,.yaml">
            <br><br>
            <button type="submit">Importer</button>
        </div>
    </form>

    <p><a href="liste_yml.php">← Retour à la liste YAML</a></p>

    <script>
        const dropArea = document.getElementById('drop-area');

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
            const fileInput = document.querySelector('input[type="file"]');
            fileInput.files = e.dataTransfer.files;
        });
    </script>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['ymlfile'])) {
    $file = $_FILES['ymlfile']['tmp_name'];
    $content = file_get_contents($file);

    // Parser YAML "à la main" (structure simple)
    $lines = explode("\n", $content);
    $data = [];
    foreach ($lines as $line) {
        if (strpos($line, ':') !== false) {
            list($key, $value) = explode(':', $line, 2);
            $key = trim($key);
            $value = trim($value, " \"");
            if ($key) $data[$key] = $value;
        }
    }

    if (isset($data['nom'], $data['email'])) {
        $handler = new FormHandlerYML();

        if ($handler->emailExiste($data['email'])) {
            echo "<p style='color:orange'>⚠️ L'utilisateur avec l'email <strong>{$data['email']}</strong> existe déjà.</p>";
        } else {
            $handler->ajouterUtilisateur($data['nom'], $data['email']);
            $handler->saveAsYml($data['nom'], $data['email']);
            echo "<p style='color:green'>✅ Utilisateur importé avec succès !</p>";
        }
    } else {
        echo "<p style='color:red'>❌ Fichier YML invalide. Il doit contenir au minimum les champs <code>nom</code> et <code>email</code>.</p>";
    }
}
?>
