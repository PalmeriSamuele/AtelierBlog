<?=
    require($_SERVER['DOCUMENT_ROOT'].'/php_simple/app/session.php'); 
    require('../../app/fonctions.php');
    if (isset($_GET['superid']) && isset($_GET['userid'])) {
        $superid = $_GET['superid'];
        $userid = $_GET['userid'];
        $message = null;
        if (checkPermission($superid)->role == 1) {
            deleteUser($userid);
            $succes = "Utilisateur suprrimé avec succes";
            header('Location: /php_simple/components/users/listUsers.php?succes='.$succes);
        }
        else {
            $fail = "Vous n'avez pas les droits pour cette action";
            header('Location: /php_simple/components/users/listUsers.php?fail='.$fail);
            
        }
    }

?> 