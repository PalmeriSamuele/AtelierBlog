<?=
require($_SERVER['DOCUMENT_ROOT'].'/php_simple/app/session.php'); 
require('../../app/fonctions.php');
    if ($_GET['authorid'] == $_SESSION['name'])
        deleteComment($_GET['id']);
        header('Location: /php_simple/article.php?id=' . $_GET['articleid']);
?> 