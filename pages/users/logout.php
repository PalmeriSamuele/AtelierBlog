<?php
session_start();
$_SESSION['name'] = null;
session_unset();

session_destroy();
if (isset($_GET['succes']))
    header('Location: /php_simple/index.php?succes=' . $_GET['succes']);
else 
    header('Location: /php_simple/index.php');
