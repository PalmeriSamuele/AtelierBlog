<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/app/session.php'); 
    require_once('../../app/fonctions.php');
    $articles = getArticles();


    if (isset($_GET['articleid'])) {
        pinneArticle($_GET['articleid']);
        header('Location: /php_simple/index.php');
    }
?>


<!doctype html>
<html lang="fr">
<head>
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/components/headers.php') ?>


    <title>Home blog</title>
</head>
<body>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/components/navigation.php') ?>

<main role="main">
    <?php echo realpath('app/session.php') ?>
    <div class="container">
        <div class="row">
            
            <?php foreach($articles as $article):  ?>
                <div class="col articles">
                    <div class="card mx-auto mb-3" style="width: 18rem;">
                
                        <div class="card-body">
                        <h2><?= $article->titre ?> </h2>
                        <a class="btn btn-primary" href="/php_simple/article.php?id=<?=$article->id?>">lire la suite</a>
                        <a href="articles.php?articleid=<?= $article->id ?>">Épingler l'article</a>
                    </div>
                </div>
            <?php endforeach; ?>
            
        </div>
    </div>
</main>

<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/components/footer.php') ?>

</body>
</html>
