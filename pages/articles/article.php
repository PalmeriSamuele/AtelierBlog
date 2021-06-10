<?php 
    require($_SERVER['DOCUMENT_ROOT'].'/php_simple/app/session.php'); 
    require('../../app/fonctions.php');
    require_once('../../resources/JBBCode/Parser.php');
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
        $author = getUser($article->authorid);
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
                <time class="article-item time"> <?= $article->date ?></time>
                <p class=" article-item author">Par <?= $author->pseudo ?></p>
                
        
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
                <a class="article-like like" href="/php_simple/components/articles/updateLikes.php?articleid=<?=$article->id?>&userid=<?=getId($_SESSION['name'])?>&operationlike=<?=$operationlike?>" >

                <?php
                
                if (isset($_SESSION['name'])) {
                    if (hasLikesBy($article->id,getId($_SESSION['name']))) { ?>
                        <i class="far fa-thumbs-up red "></i>
                        <?php $operationlike = '0';
                        echo "J'aime pas";
                        
                    }
                    else { ?>
                        <i class="far fa-thumbs-up "></i>
                        <?php $operationlike = '1';
                        echo "J'aime";
                        
                    }
                }
                ?></a>
                <?php } ?>
            </div>
        </div>
        <div class="container article">
        <?php   $parser = new JBBCode\Parser();
                $parser->addCodeDefinitionSet(new JBBCode\DefaultCodeDefinitionSet());
                        
                $parser->parse($article->contenu);?>
             
                <p class=" article-content resume"> <?= $article->résumé ?></p>
            <?php if(isset($article->imagePath) && $article->imagePath != "/php_simple/resources/images/articles/no-img.png") { ?>
                <img class="article-img mx-auto justify-content-center" src="<?= $article->imagePath ?>" alt="image de l'article">
                <p class="article-content">  <?= $parser->getAsHtml() ?> </p>
            <?php } else { ?>

                    <p class="article-content article-item"><?= $parser->getAsHtml() ?> </p>

            <?php } ?>
        </div>

        <hr />

            <form action="article.php?id=<?=$article->id?>" method="POST" class="article-from-comment article-item mx-auto">
                <textarea name="comment" placeholder="Laisse un commentaire !"  cols="60" rows="5" required></textarea>
                <button type="submit" class="btn pinned-btn mt-2"> Envoyer</button>
            </form> 
            </div>

            <?php foreach(array_reverse($comments) as $comment): ?>
                <div class="comment-article container">
                    <div class="info-comment">
                        <h3><?= getName($comment->authorid)->pseudo ?></h3>
                        <a href="/php_simple/components/articles/deleteComment.php?id=<?= $comment->id ?>&articleid=<?= $id?>&authorid=<?=$comment->authorid?>" class="fas fa-trash-alt"></i> </a>
                    </div>  
                    <time class="info-comment"> <?= $comment->date ?></time>
                    <p class="comment-content"><?= $comment->contenu ?></p>
                    
                </div>
            <?php endforeach;  ?>
            
    </body> 
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/components/footer.php') ?>

</html>
