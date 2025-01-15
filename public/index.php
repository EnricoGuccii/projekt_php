<?php
require_once(__DIR__ . '/../templates/header.php');
require_once(__DIR__ . '/../src/User.php');
require_once(__DIR__ . '/../src/Album.php');

$user = new User();
$album = new Album();

$albums = $album->getAlbumsByUserId(null); 

function displayAlbumsPublic($albums) {
    if (empty($albums)) {
        echo "<p>Brak dostępnych albumów.</p>";
        return;
    }

    echo "<div class='album-container'>";
    foreach ($albums as $album) {
        echo "<div class='album'>";
        echo "<img src='" . htmlspecialchars($album['image_url']) . "' alt='" . htmlspecialchars($album['name']) . "'>";
        echo "<div class='album-content'>";
        echo "<h2>" . htmlspecialchars($album['name']) . "</h2>";
        echo "<p>" . htmlspecialchars($album['description']) . "</p>";

        $songs = json_decode($album['song_list'], true);
        if (!empty($songs)) {
            echo "<ul>";
            foreach ($songs as $song) {
                echo "<li>" . htmlspecialchars($song) . "</li>";
            }
            echo "</ul>";
        }
        echo "</div>";
        echo "</div>";
    }
    echo "</div>";
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona główna</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<br>
    <br>
    <br>

<?php
displayAlbumsPublic($albums);
?>

</body>
</html>

<?php
require(__DIR__ . '/../templates/footer.php');
?>



