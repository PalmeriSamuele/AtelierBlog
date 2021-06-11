<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/app/session.php'); 
    require_once('../../app/fonctions.php');

    if (!isset($_GET['search'])) {
        $_GET['search'] = "";
    }
    $articlesSearch = searchArticles($_GET['search']);
    $artPinned = getPinned();
    if (is_string($articlesSearch)){
        $fail = $articlesSearch;
    }

?>

<!doctype html>
    <html lang="fr">
        <head>
            <?php require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/components/headers.php') ?>


            <title>Home blog</title>
        </head>
        <body>

        <?php require_once('../../components/navigation.php') ?>

        <main role="main">
            
            <?php 
            $_SESSION['articles'] = $articlesSearch;
            require_once("articles_components.php"); ?>
        </main>


        </body>
        <?php require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/components/footer.php') ?>

    </html>




    
