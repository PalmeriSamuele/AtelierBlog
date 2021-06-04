<?php
require($_SERVER['DOCUMENT_ROOT'].'/php_simple/app/session.php'); 
require('../../app/fonctions.php');
    $name = getName($_GET['authorid'])->pseudo;
    $email = getName($_GET['authorid'])->email;
    if ($name == $_SESSION['name'] || $email ==  $_SESSION['name']) 
        deleteComment($_GET['id']);
    header('Location: /php_simple/pages/articles/article.php?id=' . $_GET['articleid']);
    
?> 