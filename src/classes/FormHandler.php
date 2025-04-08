<?php

class FormHandler {
    private $conn;

    public function __construct() {
        $host = getenv('DB_HOST') ?: 'db';
        $user = getenv('DB_USER') ?: 'root';
        $pass = getenv('DB_PASS') ?: 'root';
        $dbname = getenv('DB_NAME') ?: 'monapp';

        $this->conn = new mysqli($host, $user, $pass, $dbname);
        if ($this->conn->connect_error) {
            die("Erreur de connexion : " . $this->conn->connect_error);
        }
    }

    public function ajouterUtilisateur($nom, $email) {
        $nom = $this->conn->real_escape_string($nom);
        $email = $this->conn->real_escape_string($email);

        $sql = "INSERT INTO users (nom, email) VALUES ('$nom', '$email')";
        return $this->conn->query($sql);
    }

    public function saveAsJson($nom, $email) {
        $data = [
            'nom' => htmlspecialchars($nom),
            'email' => htmlspecialchars($email),
            'timestamp' => date('Y-m-d H:i:s')
        ];

        if (!is_dir('donnees')) {
            mkdir('donnees', 0755, true);
        }

        $filename = 'donnees/' . time() . '_data.json';
        file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));
    }

    public function tousLesUtilisateurs() {
        $result = $this->conn->query("SELECT * FROM users ORDER BY id DESC");
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function getUtilisateur($id) {
        $id = (int) $id;
        $result = $this->conn->query("SELECT * FROM users WHERE id = $id");
        return $result ? $result->fetch_assoc() : null;
    }

    public function modifierUtilisateur($id, $nom, $email) {
        $id = (int) $id;
        $nom = $this->conn->real_escape_string($nom);
        $email = $this->conn->real_escape_string($email);
        $sql = "UPDATE users SET nom = '$nom', email = '$email' WHERE id = $id";
        return $this->conn->query($sql);
    }

    public function supprimerUtilisateur($id) {
        $id = (int) $id;
        return $this->conn->query("DELETE FROM users WHERE id = $id");
    }

    public function emailExiste($email) {
        $email = $this->conn->real_escape_string($email);
        $result = $this->conn->query("SELECT id FROM users WHERE email = '$email' LIMIT 1");
        return $result && $result->num_rows > 0;
    }
    
}
