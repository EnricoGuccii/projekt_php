<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once(__DIR__ . '/../src/User.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = new User();
    $result = $user->login($username, $password);

    if (strpos($result, "Zalogowano") !== false) {
        header('Location: index.php');
        exit();
        
    } else {
        echo $result;
    }
}
?>
