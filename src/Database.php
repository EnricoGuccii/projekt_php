<?php
class Database {
    private $host = 'db';      
    private $dbname = 'project_db';   
    private $username = 'user';       
    private $password = 'password';   
    private $pdo;                     
    public function __construct() {
        try {
            $dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=utf8";
            $this->pdo = new PDO($dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Błąd połączenia z bazą danych: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->pdo;
    }

    public function query($sql) {
        try {
            $stmt = $this->pdo->query($sql); 
            return $stmt; 
        } catch (PDOException $e) {
            die("Błąd zapytania SQL: " . $e->getMessage());
        }
    }

    public function execute($sql, $params = []) {
        try {
            $stmt = $this->pdo->prepare($sql); 
            return $stmt->execute($params);    
        } catch (PDOException $e) {
            die("Błąd wykonania zapytania SQL: " . $e->getMessage());
        }
    }
}

