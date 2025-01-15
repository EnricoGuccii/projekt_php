<?php
require_once(__DIR__ . '/../src/User.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $user = new User();
    $result = $user->register($username, $password, $email);
    echo $result;
}
?>
