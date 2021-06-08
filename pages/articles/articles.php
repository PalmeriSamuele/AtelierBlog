<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/app/session.php'); 
    require_once('../../app/fonctions.php');
    

    if (isset($_GET['orderby'])) {
        $orderby = $_GET['orderby'];
        if ($orderby === "ABC") {
            $articles = sortABC(getArticles("abc"));  
        }
        else {
            $articles = getArticles($orderby);
        }
    }
    else if (isset($_GET['theme'])) {
        $articles = getArticlesByTheme($_GET['theme']);
    }

?>


<!doctype html>
<html lang="fr">
<head>
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/components/headers.php') ?>


    <title>Home blog</title>
</head>
<body>
<?php if (isset($error))  { ?>
                <div class="alert alert-danger"> 
                    <?= $error ?>
                </div>
            <?php } ?>
<?php if (isset($succes))  { ?>
                <div class="alert alert-success"> 
                    <?= $succes ?>
                </div>
            <?php } ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/components/navigation.php') ?>

<main role="main">

    <div class="container">
        <div class="row ">
            <?php require('../../components/articles/orderBy.php');  ?>
            <?php foreach($articles as $article):  ?>

                <div class="card-article card mx-auto">
                <?php if (isset($article->imagePath)) {?>
                            <img class="card-img-top" src="<?= $article->imagePath ?>" alt="Card image cap">
                            <?php } ?>
                        <div class="card-body col-lg-5">
                            <h5 class="card-title"><?= $article->titre ?></h5>
                            <p class="card-text"><?=$article->résumé ?> </p>
                            <a href="/php_simple/pages/articles/article.php?id=<?=$article->id?>&vue= <?= $article->id?>" class="btn btn-primary">lire la suite</a>
                        </div>
                        
                </div>

    
            <?php endforeach; ?>
            
        </div>
    </div>
</main>

<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/components/footer.php') ?>

</body>
</html>
