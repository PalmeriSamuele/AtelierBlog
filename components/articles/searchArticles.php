<?php 
    require_once('../../app/fonctions.php');
    $articlesSearch = searchArticles($_GET['search']);

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
            <div class="container">
                <div class="row">
                    
                    <?php
                    for ($i = 0; $i < count($articlesSearch); $i++) {  ?>
                
                        <div class="col articles">
                            <div class="card mx-auto mb-3" style="width: 18rem;">
                        
                                <div class="card-body">
                                <h2><?= $articlesSearch[$i]->titre ?> </h2>
                                <a class="btn btn-primary" href="/php_simple/article.php?id=<?=$articlesSearch[$i]->id?>">lire la suite</a>
                                <a href="articles.php?articleid=<?= $articlesSearch[$i]->id ?>">Épingler l'article</a>
                            </div>
                        </div>
                    <?php } ?>
                    
                </div>
            </div>
        </main>

        <?php require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/components/footer.php') ?>

        </body>
    </html>
