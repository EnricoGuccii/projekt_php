<?php
require_once(__DIR__ . '/../src/Database.php');
require_once(__DIR__ . '/../src/User.php');
require_once(__DIR__ . '/../src/Album.php');
require(__DIR__ . '/../templates/header.php');

$user = new User();
$currentUser = $user->getUserInfo();
$isAdmin = $user->isAdmin();

if (!isset($_GET['id'])) {
    echo "Brak albumu do edycji.";
    exit;
}

$albumId = $_GET['id'];
$album = new Album();

$albumData = $album->getAlbumById($albumId);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edycja albumu</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <br>
    <br>
    <br>
<?php

if (!$albumData) {
    echo "Album nie istnieje.";
    exit;
}

if ($isAdmin || $albumData['user_id'] == $currentUser['id']) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['delete'])) {
            $album->deleteAlbum($albumId, $currentUser['id']);
            echo "Album został usunięty.";
            exit; 
        }

        $name = $_POST['name'];
        $description = $_POST['description'];
        $imageUrl = $_POST['image_url'];
        $songList = $_POST['song_list']; 

        $album->updateAlbum($albumId, $currentUser['id'], $name, $description, $imageUrl, explode(",", $songList));
        echo "Album został zaktualizowany.";
    } else {
        ?>
        <form method="POST">
            <label for="name">Nazwa albumu:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($albumData['name']); ?>" required><br>

            <label for="description">Opis:</label>
            <textarea id="description" name="description" required><?php echo htmlspecialchars($albumData['description']); ?></textarea><br>

            <label for="image_url">Link do obrazka:</label>
            <input type="text" id="image_url" name="image_url" value="<?php echo htmlspecialchars($albumData['image_url']); ?>" required><br>

            <label for="song_list">Lista utworów (oddzielone przecinkiem):</label>
            <input type="text" id="song_list" name="song_list" value="<?php echo implode(",", json_decode($albumData['song_list'])); ?>" required><br>

            <input type="submit" value="Zapisz zmiany">
        </form>

        <form method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć ten album?');">
            <input type="hidden" name="delete" value="1">
            <input type="submit" value="Usuń album" style="background-color: red; color: white;">
        </form>
        <?php
    }
} else {
    echo "Brak uprawnień do edytowania tego albumu.";
}
?>

</body>
</html>

<?php
require(__DIR__ . '/../templates/footer.php');
?>