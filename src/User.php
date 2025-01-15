<?php
require_once 'Database.php';

class User {
    private $pdo;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();  
        }

        $this->pdo = (new Database())->getConnection();
    }

    public function register($username, $password, $email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute([':username' => $username]);

        if ($stmt->rowCount() > 0) {
            return "Użytkownik o takim loginie już istnieje.";
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->pdo->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");
        $stmt->execute([
            ':username' => $username,
            ':password' => $hashedPassword,
            ':email' => $email
        ]);
        return "Rejestracja zakończona sukcesem!";
    }

    public function login($username, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute([':username' => $username]);
        if ($stmt->rowCount() == 0) {
            return "Nieprawidłowy login.";
        }

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            return "Zalogowano pomyślnie!";
        } else {
            return "Nieprawidłowe hasło.";
        }
    }

    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    public function getUserId() {
        return $_SESSION['user_id'];
    }

    public function logout() {
        session_unset(); 
        session_destroy(); 
    }

    public function getUserInfo() {
        if ($this->isLoggedIn()) {
            return [
                'id' => $_SESSION['user_id'],
                'username' => $_SESSION['username']
            ];
        }
        return null;
    }

    public function isAdmin() {
        if ($this->isLoggedIn()) {
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id AND role = 'admin'");
            $stmt->execute([':id' => $_SESSION['user_id']]);
            return $stmt->rowCount() > 0;
        }
        return false;
    }

    public function updateUser($userId, $username = null, $password = null, $email = null) {
        $updates = [];
        $params = [':id' => $userId];

        if ($username !== null) {
            $updates[] = "username = :username";
            $params[':username'] = $username;
        }
        if ($password !== null) {
            $updates[] = "password = :password";
            $params[':password'] = password_hash($password, PASSWORD_DEFAULT);
        }
        if ($email !== null) {
            $updates[] = "email = :email";
            $params[':email'] = $email;
        }

        if (empty($updates)) {
            return "Brak danych do aktualizacji.";
        }

        $query = "UPDATE users SET " . implode(", ", $updates) . " WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);

        return "Dane użytkownika zostały zaktualizowane.";
    }

    public function deleteUser($userId) {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = :id");
        $stmt->execute([':id' => $userId]);

        return "Użytkownik został usunięty.";
    }

    public function getAllUsers() {
        $stmt = $this->pdo->query("SELECT id, username, email, role FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>
