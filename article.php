<?php 
    require($_SERVER['DOCUMENT_ROOT'].'/php_simple/app/session.php'); 
    require('app/fonctions.php');
    $id = $_GET['id'];
    $notconnected = 'Vous devez etre connecte';
    if (!isset($id) or !is_numeric($id)) {
        header('Location: http://127.0.0.1/');
    }
    else {
        
        if (isset($_POST['comment'])) {
            if (isset($_SESSION['name'])) 
                $comment = addComment($_POST['comment'], $id,$_SESSION['name']);
            unset($comment);
            if (!isset($_SESSION['name'])) { ?>
                <div class="alert alert-danger "> 
                   <?= $notconnected;
                    } ?>
                </div>
                <?php
        }

        
        $article = getArticle($id);
        $comments = getComments($id);
    }



?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf8"/>
        <?php require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/components/headers.php') ?> 
        <title><?= $article->titre ?> </title>
    </head>

    <body>
               
    <?php if (isset($_GET['message']))  { ?>
            <div class="alert alert-danger"> 
                <?= $_GET['message'] ?>
            </div>
            <?php } ?>
        <?php require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/components/navigation.php'); ?>
           

        <h1><?= $article->titre ?></h1>
        <time> <?= $article->date ?></time>
        <p> <?= $article->contenu ?> </p>
        <a href="/php_simple/components/articles/deleteArticle.php?userid=<?=getId($_SESSION['name']) ?>&articleid=<?= $article->id?>&authorid=<?= $article->authorid ?>">delete article</a>

        <hr />

        <form action="article.php?id=<?=$article->id?>" method="POST">
            <textarea name="comment" placeholder="Leave a comment here" id="comment"  cols="100" rows="5" required></textarea>
            <button type="submit" class="btn btn-primary mt-2"> Envoyer</button>
        </form> 

        <h2>Commentaires : </h2>
        <?php foreach($comments as $comment): ?>
            
            <h3><?= $comment->author ?></h3>
            <time> <?= $comment->date ?></time>
            <p><?= $comment->contenu ?></p>
            <a href="/php_simple/components/articles/deleteComment.php?id=<?= $comment->id ?>&articleid=<?= $id?>&authorid=<?=$comment->author?>"> delete  </a>

           

        <?php endforeach;  ?>
    
     
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/components/footer.php') ?>
    </body> 
</html>
