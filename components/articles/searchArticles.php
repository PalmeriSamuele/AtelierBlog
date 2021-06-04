<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/app/session.php'); 
    require_once('../../app/fonctions.php');
    $articlesSearch = searchArticles($_GET['search']);
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
        <?php if (isset($fail)) { ?>
            <div class="alert alert-danger"> 
                <?= $fail ?>
            </div>
        <?php } ?>
        <main role="main">
            <div class="container">
            <?php require('../../components/articles/OrderBy.php');  ?>
                <div class="row">
                    
                    <?php
                    if (!is_string($articlesSearch)) {
                        foreach ($articlesSearch as $article): ?>
                
                            <div class="col articles">
                                <div class="card mx-auto mb-3" style="width: 18rem;">
                            
                                    <div class="card-body">
                                    <h2 class="card-title"><?= $article->titre ?> </h2>
                                    <a class="btn btn-primary" href="/php_simple/pages/articles/article.php?id=<?=$article->id?>">lire la suite</a>
                                </div>
                            </div>
                        <?php endforeach; ?> 
                    <?php } ?>

                    
                </div>
            </div>
        </main>

        <?php require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/components/footer.php') ?>

        </body>
    </html>
