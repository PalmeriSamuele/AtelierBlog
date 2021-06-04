<?php 
    require($_SERVER['DOCUMENT_ROOT'].'/php_simple/app/session.php'); 
    require('../../app/fonctions.php');
    $notconnected = 'Vous devez être connecté !';
    $comment = null;
    if(isset($_GET['vue'])) 
        addVues($_GET['vue']);
    if (isset($_GET['id'])) {
        $id = $_GET['id'];  
        if (isset($_POST['comment'])) {
            if (isset($_SESSION['name'])) {

                $comment = addComment($_POST['comment'], $id, getId($_SESSION['name']));
                
            }
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
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/components/navigation.php'); ?>
    <?php if (isset($_GET['message']))  { ?>
            <div class="alert alert-danger"> 
                <?= $_GET['message'] ?>
            </div>
            <?php } ?>
        
        <div class="info-article">
            <div class="container-fluid">
                <h1 class="theme"><?= $article->theme ?></h1>
                <h2 class="article-item titre"> <?= $article->titre ?></h2>
                <h4 class="article-item resume"> <?= $article->résumé ?></h4>
                <time class="article-item time"> <?= $article->date ?></time>
                
        
            </div>
            <?php if (isset($_SESSION['name'])) { ?>
            <div class="like-container">
            <p class="article-item article-like"> <?= $article->nbLikes?></p>
                <?php 
                if (isset($_SESSION['name'])) {
                    if (hasLikesBy($article->id,getId($_SESSION['name']))) { 
                        $operationlike = '0';
                    } 
                    else {
                        $operationlike = '1';
                    }
                }
                ?>
                <a class="article-like far fa-thumbs-up" href="/php_simple/components/articles/updateLikes.php?articleid=<?=$article->id?>&userid=<?=getId($_SESSION['name'])?>&operationlike=<?=$operationlike?>" >
                <?php
                if (isset($_SESSION['name'])) {
                    if (hasLikesBy($article->id,getId($_SESSION['name']))) {
                        $operationlike = '0';
                        echo "J'aime pas";
                        
                    }
                    else {
                        $operationlike = '1';
                        echo "J'aime";
                        
                    }
                }
                ?></a>
                <?php } ?>
            </div>
        </div>
        <div class="container">
        <?php if(isset($article->imagePath)) { ?>
            <p class="article-content">  <img class="article-img justify-content-center"src="<?=$article->imagePath?>" alt=""> <?= $article->contenu ?> </p>
            <?php } else { ?>
                    <p class="article-content"><?= $article->contenu ?> </p>

            <?php } ?>
        </div>

        <hr />

            <form action="article.php?id=<?=$article->id?>" method="POST" class="article-from-comment article-item mx-auto">
                <textarea name="comment" placeholder="Laisse un commentaire !"  cols="60" rows="5" required></textarea>
                <button type="submit" class="btn btn-primary mt-2"> Envoyer</button>
            </form> 
            </div>

            <?php foreach(array_reverse($comments) as $comment): ?>
                <div class="comment-article container">
                    <div class="info_comment">
                        <h3><?= getName($comment->authorid)->pseudo ?></h3>
                        <a href="/php_simple/components/articles/deleteComment.php?id=<?= $comment->id ?>&articleid=<?= $id?>&authorid=<?=$comment->authorid?>" class="fas fa-trash-alt"></i> </a>
                    </div>  
                    <time> <?= $comment->date ?></time>
                    <p class="comment-content"><?= $comment->contenu ?></p>
                    
                </div>
            <?php endforeach;  ?>
  
        <?php require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/components/footer.php') ?>
    </body> 
    
</html>
