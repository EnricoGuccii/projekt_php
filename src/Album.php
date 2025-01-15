<?php
require_once 'Database.php';

class Album {
    private $pdo;

    public function __construct() {
        $this->pdo = (new Database())->getConnection();
    }

    public function addAlbum($userId, $name, $description, $imageUrl, $songList) {
        $stmt = $this->pdo->prepare("INSERT INTO albums (user_id, name, description, image_url, song_list) VALUES (:user_id, :name, :description, :image_url, :song_list)");
        $stmt->execute([
            ':user_id' => $userId,
            ':name' => $name,
            ':description' => $description,
            ':image_url' => $imageUrl,
            ':song_list' => json_encode($songList) 
        ]);
    }

    public function getAlbumById($albumId) {
        $stmt = $this->pdo->prepare("SELECT * FROM albums WHERE id = :id");
        $stmt->execute([':id' => $albumId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getAlbumsByUserId($userId) {
        if ($userId === null) {
            $stmt = $this->pdo->prepare("SELECT * FROM albums");
            $stmt->execute();
        } else {
            $stmt = $this->pdo->prepare("SELECT * FROM albums WHERE user_id = :user_id");
            $stmt->execute([':user_id' => $userId]);
        }
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function updateAlbum($albumId, $userId, $name, $description, $imageUrl, $songList) {
        $stmt = $this->pdo->prepare("UPDATE albums SET name = :name, description = :description, image_url = :image_url, song_list = :song_list WHERE id = :id AND user_id = :user_id");
        $stmt->execute([
            ':id' => $albumId,
            ':user_id' => $userId,
            ':name' => $name,
            ':description' => $description,
            ':image_url' => $imageUrl,
            ':song_list' => json_encode($songList)
        ]);
    }

    public function deleteAlbum($albumId, $userId) {
        $stmt = $this->pdo->prepare("DELETE FROM albums WHERE id = :id AND user_id = :user_id");
        $stmt->execute([
            ':id' => $albumId,
            ':user_id' => $userId
        ]);
    }

}
?>
