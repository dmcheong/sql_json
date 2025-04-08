<!-- add new json file from drag & drop -->
<?php
require_once 'classes/FormHandler.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Importer un utilisateur JSON</title>
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
    <h1>📥 Importer un fichier JSON</h1>
    <form id="upload-form" action="import_json.php" method="POST" enctype="multipart/form-data">
        <div id="drop-area">
            Glissez-déposez un fichier .json ici<br><br>
            ou<br><br>
            <input type="file" name="jsonfile" accept=".json">
            <br><br>
            <button type="submit">Importer</button>
        </div>
    </form>

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
// Traitement après soumission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['jsonfile'])) {
    $file = $_FILES['jsonfile']['tmp_name'];
    $content = file_get_contents($file);
    $data = json_decode($content, true);

    if ($data && isset($data['nom']) && isset($data['email'])) {
        $handler = new FormHandler();

        if ($handler->emailExiste($data['email'])) {
            echo "<p style='color:orange'>⚠️ L'utilisateur avec l'email <strong>{$data['email']}</strong> existe déjà.</p>";
        } else {
            $handler->ajouterUtilisateur($data['nom'], $data['email']);
            $handler->saveAsJson($data['nom'], $data['email']);
            echo "<p style='color:green'>✅ Utilisateur importé avec succès !</p>";
        }
    } else {
        echo "<p style='color:red'>❌ Fichier JSON invalide. Il doit contenir les champs <code>nom</code> et <code>email</code>.</p>";
    }
}
?>
