<?php
session_start();
$_SESSION['name'] = null;
session_unset();
// destroy the session
session_destroy();

header('Location: http://localhost/php_simple/index.php');
