<?php
require(__DIR__ . '/../templates/header.php');
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie i rejestracja</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<br>
    <br>
    <br>

<div class="container">
    <div>
        <h1>Logowanie</h1>
        <form action="login.php" method="POST">
            <label for="username">Nazwa użytkownika:</label>
            <input type="text" name="username" id="username" required>

            <label for="password">Hasło:</label>
            <input type="password" name="password" id="password" required>

            <button type="submit">Zaloguj</button>
        </form>
    </div>
    <div>
        <h1>Rejestracja</h1>
        <form action="register.php" method="POST">
            <label for="username">Nazwa użytkownika:</label>
            <input type="text" name="username" id="username" required>

            <label for="password">Hasło:</label>
            <input type="password" name="password" id="password" required>

            <label for="email">Adres email:</label>
            <input type="email" name="email" id="email" required>

            <button type="submit">Zarejestruj</button>
        </form>
    </div>
</div>

</body>
</html>
