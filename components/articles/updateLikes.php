<?php 
    require('../../app/fonctions.php');
    var_dump($_GET);
    $articleid = $_GET['articleid'];
    $userid = $_GET['userid'];
  if (isset($articleid) && isset($userid)) {
    if ($_GET['operationlike'] == '1') {
      addLike($articleid,$userid);
      updateNbLikes($articleid,'1');
    }
    else {
      deleteLike($articleid,$userid); 
      updateNbLikes($articleid,'0');
    }     

    header('Location: /php_simple/pages/articles/article.php?id=' . $_GET['articleid']);
  }
?>