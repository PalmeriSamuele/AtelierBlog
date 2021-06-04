<?=
require($_SERVER['DOCUMENT_ROOT'].'/php_simple/app/session.php'); 
require('../../app/fonctions.php');
var_dump($_GET);

if (isset($_GET['articleid']) && isset($_GET['userid']) && isset($_GET['authorid'])) {

    $articleid =  $_GET['articleid'];

    $userid = $_GET['userid'];
    $authorid = $_GET['authorid']; 
    if (checkPermission($userid)->role == 1) {
        $succes = "Article supprimé !";
        deleteArticle($articleid);
        updateNbArticles($authorid,'-');
        header('Location: /php_simple/index.php?succes=' . $succes);
        
    }
    else {
        $fail = "Vous n'avez pas les droits pour cette action";
        header('Location: /php_simple/index.php?fail=' . $fail);
        
    }
}
?> 