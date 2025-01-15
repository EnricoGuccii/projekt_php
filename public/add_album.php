<?php
require(__DIR__ . '/../templates/header.php');
require_once(__DIR__ . '/../src/Database.php');
require_once(__DIR__ . '/../src/User.php');
require_once(__DIR__ . '/../src/Album.php');

$user = new User();
$currentUser = $user->getUserInfo();
$isAdmin = $user->isAdmin();

if (!$currentUser) {
    echo "Musisz być zalogowany, aby dodać album.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $imageUrl = $_POST['image_url'];
    $songList = $_POST['song_list'];

    $album = new Album();
    $album->addAlbum($currentUser['id'], $name, $description, $imageUrl, explode(",", $songList));

    echo "Album został dodany!";
    //header("Location: profil.php");
    exit;
}

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

<h1>Dodaj nowy album</h1>

<form method="POST">
    <label for="name">Nazwa albumu:</label>
    <input type="text" id="name" name="name" required><br>

    <label for="description">Opis:</label>
    <textarea id="description" name="description" required></textarea><br>

    <label for="image_url">Link do obrazka:</label>
    <input type="text" id="image_url" name="image_url" required><br>

    <label for="song_list">Lista utworów (oddzielone przecinkiem):</label>
    <input type="text" id="song_list" name="song_list" required><br>

    <input type="submit" value="Dodaj album">
</form>
</body>
</html>

<?php
require(__DIR__ . '/../templates/footer.php');
?>
