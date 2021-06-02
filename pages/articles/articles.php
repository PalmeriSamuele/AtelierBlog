<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/app/session.php'); 
    require_once('../../app/fonctions.php');
    $articles = getArticles();



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
        <div class="row">
            <?php require('../../components/articles/orderBy.php');  ?>
            <?php foreach($articles as $article):  ?>
                <div class="col articles">
                    <div class="card mx-auto mb-3" style="width: 18rem;">
                        <div class="card-body">
                        <h2><?= $article->titre ?> </h2>
                        <a class="btn btn-primary" href="/php_simple/pages/articles/article.php?id=<?=$article->id?>">lire la suite</a>
       
                    </div>
                </div>
            <?php endforeach; ?>
            
        </div>
    </div>
</main>

<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/components/footer.php') ?>

</body>
</html>
