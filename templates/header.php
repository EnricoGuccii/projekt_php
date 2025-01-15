<?php
require_once(__DIR__ . '/../src/User.php');

$user = new User();
?>

<nav>
    <ul>
        <li><a href="index.php">Strona Główna</a></li>
        <li><a href="profile.php">Profil użytkownika</a></li>
        <li><a href="autoryzacja.php">Logowanie i rejestracja</a></li>
        <li><a href="logout.php">Wyloguj</a></li>
        <?php
        if ($user->isAdmin()) {
            echo '<li><a href="admin_panel.php">Panel administracyjny</a></li>';
        }
        ?>
    </ul>
</nav>
