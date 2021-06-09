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
            <div class="profil-articles-box">
                    <?php 
                    if (isset($articles)) {
                        foreach($articles as $article): ?>
                            <div class="card mx-auto mb-3 ">
                                <div class="card-body">
                                    <h2 class="card-title "><?= $article->titre ?> </h2>
                                    <a class="btn btn-primary card-link" href="/php_simple/pages/articles/article.php?id=<?=$article->id?>">lire la suite</a>
                                </div>
                            </div>
                        <?php endforeach;  ?>
                    <?php }
                    else {
                        echo "Vous n'avez pas encore d'articles !";
                    } ?>
            </div>
            
        </div>
    </div>
</main>

<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/components/footer.php') ?>

</body>
</html>
