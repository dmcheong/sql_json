<?php

class FormHandlerYML {
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

    public function emailExiste($email) {
        $email = $this->conn->real_escape_string($email);
        $result = $this->conn->query("SELECT id FROM users WHERE email = '$email' LIMIT 1");
        return $result && $result->num_rows > 0;
    }

    public function saveAsYml($nom, $email) {
        $data = [
            'nom' => $nom,
            'email' => $email,
            'timestamp' => date('Y-m-d H:i:s')
        ];

        $yml = "";
        foreach ($data as $key => $value) {
            $yml .= "$key: \"$value\"\n";
        }

        if (!is_dir('donnees')) {
            mkdir('donnees', 0755, true);
        }

        $filename = 'donnees/user_' . time() . '.yml';
        file_put_contents($filename, $yml);
    }
}
