<?php
require_once(__DIR__ . '/../templates/header.php');
require_once(__DIR__ . '/../src/User.php');
require_once(__DIR__ . '/../src/Album.php');

$user = new User();
$album = new Album();

$currentUser = $user->getUserInfo(); 
$isAdmin = $user->isAdmin(); 

function displayAlbumsEditable($albums, $isAdmin, $currentUserId = null) {
    if (empty($albums)) {
        echo "<p>Nie masz jeszcze żadnych albumów.</p>";
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

        if ($isAdmin || $album['user_id'] == $currentUserId) {
            echo "<a href='edit_album.php?id=" . $album['id'] . "' class='edit-link'>Edytuj</a>";
        }
        echo "</div>";
        echo "</div>";
    }
    echo "</div>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <br><br><br>
    <h1>Twoje albumy</h1>

<?php
if ($currentUser) {

    echo "<a href='add_album.php' class='btn btn-primary'>Dodaj album</a>";

    if ($isAdmin) {
        $albums = $album->getAlbumsByUserId(null); 
    } else {
        $albums = $album->getAlbumsByUserId($currentUser['id']); 
    }
    displayAlbumsEditable($albums, $isAdmin, $currentUser['id']);
} else {
    echo "<p>Proszę się zalogować, aby zobaczyć swoje albumy.</p>";
}
?>

</body>
</html>

<?php
require(__DIR__ . '/../templates/footer.php');
?>
