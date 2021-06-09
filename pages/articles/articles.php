<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/app/session.php'); 
    require_once('../../app/fonctions.php');
    
    $artPinned = getPinned();
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
    <?php 
        require('../../components/articles/OrderBy.php');
        $_SESSION['articles'] = $articles;
        require_once("../../components/articles/articles_components.php"); ?>
</main>

<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/components/footer.php') ?>

</body>
</html>
