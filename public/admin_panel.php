<?php
require(__DIR__ . '/../templates/header.php');
require_once(__DIR__ . '/../src/User.php');

$user = new User();

if (!$user->isAdmin()) {
    http_response_code(403);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update'])) {
        $result = $user->updateUser($_POST['id'], $_POST['username'], $_POST['password'], $_POST['email']);
        echo $result;
    } elseif (isset($_POST['delete'])) {
        $result = $user->deleteUser($_POST['id']);
        echo $result;
    }
}

$users = $user->getAllUsers();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Panel Administratora</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1>Panel Administratora</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nick</th>
                <th>Email</th>
                <th>Rola</th>
                <th>Akcje</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user['id']) ?></td>
                <td><?= htmlspecialchars($user['username']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
                <td><?= htmlspecialchars($user['role']) ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?= $user['id'] ?>">
                        <input type="text" name="username" placeholder="Nowy nick">
                        <input type="text" name="email" placeholder="Nowy email">
                        <input type="password" name="password" placeholder="Nowe hasło">
                        <button type="submit" name="update">Zaktualizuj</button>
                        <button type="submit" name="delete">Usuń</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

<?php
require(__DIR__ . '/../templates/footer.php');
?>