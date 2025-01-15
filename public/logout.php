<?php
require_once(__DIR__ . '/../src/User.php');

$user = new User();
$user->logout();

header('Location: index.php'); 
exit();
?>
