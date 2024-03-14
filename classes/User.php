<?php
require_once 'Database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function register($login, $password) {
        // Vérifier si l'utilisateur existe déjà
        $sql = "SELECT COUNT(*) AS count FROM users WHERE login = :login";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':login', $login);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result['count'] > 0) {
            // L'utilisateur existe déjà, renvoyer false pour indiquer l'échec de l'inscription
            return false;
        }

        // Insérer le nouvel utilisateur dans la base de données
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (login, password) VALUES (:login, :password)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':password', $hashedPassword);
        return $stmt->execute();
    }

    public function login($login, $password) {
        $sql = "SELECT * FROM users WHERE login = :login";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':login', $login);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            if (password_verify($password, $row['password'])) {
                return $row;
            }
        }
        return false;
    }
}
?>
