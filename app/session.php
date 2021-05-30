<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();

$user = null;

if(isset($_SESSION['user'])) {
    $user = [];

    $user['email'] = $_SESSION['user']['email'];
    $user['name'] = $_SESSION['user']['name'];
    $user['id'] = $_SESSION['user']['id'];
}

?>
