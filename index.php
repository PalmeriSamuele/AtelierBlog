<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/app/session.php'); 
    require('app/fonctions.php');
    
    $succes = null;
    $fail = null;
    if (isset($_GET['fail']))  {
        $fail = $_GET['fail'];
    }
    if (isset($_GET['succes']))  {
        $succes = $_GET['succes'];
    }

?>



<!doctype html>
<html lang="fr">
<head>
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/components/headers.php') ?> 


    <title>Home blog</title>
</head>
<body>
        <?php if (isset($succes)) { ?>
        <div class="alert alert-success"> 
            <?= $succes ?>
        </div>
        <?php } ?>
        <?php if (isset($fail))  {?>
        <div class="alert alert-danger"> 
            <?= $fail ?>
        </div>
        <?php } ?>
<?php require_once('components/navigation.php') ?>

<main role="main ">
    <div class="main-container mx-auto">
    
            <div class="row">
                
                <div class="pinned-articles">
                    
                    <?php $i=0;
                        $rep = false;
                        while($i < count($articles)):
                            if ($articles[$i]->isPinned == 1): ?>
                                <h2 class="fas fa-star article-item main-titre ">Article mit en avant</h2>
                                <?php
                                $rep = true; ?>
                                <div class="mx-auto mb-3 pinned-article">
                                    
                                    <div class="card-body">
                                    
                                        <h2><?= $articles[$i]->titre ?> </h2>
                                        <a class="btn btn-success" href="/php_simple/pages/articles/article.php?id=<?=$articles[$i]->id?>">lire la suite</a>
                                    
                                    </div>
                                </div>
                                <hr />
                            <?php endif; ?>
                            <?php  $i++; 
                            endwhile; ?> 
                
                </div>
            </div>
        
    
        

        <?php 
        if (count($articles) >= 3) {
            $to = 3;
        }
        else {
            $to = count($articles);
        }?>
        <h2 class="article-item main-titre col col-lg-12 col-md-10 col-sm-9 col-9" >Articles récents</h2>
        <div class=" main-bloc  col col-lg-12 col-md-9 col-sm-12 col-12 ">



        <?php foreach($articles as $article):  ?>

            <div class="card-article card mx-auto ">
            <?php if (isset($article->imagePath)) {?>
                        <img class="card-img-top" src="<?= $article->imagePath ?>" alt="Card image cap">
                        <?php } ?>
                    <div class="card-body">
                        <h5 class="card-title"><?= $article->titre ?></h5>
                        <p class="card-text"><?=$article->résumé ?> </p>
                        <a href="/php_simple/pages/articles/article.php?id=<?=$article->id?>&vue= <?= $article->id?>" class="btn btn-primary">lire la suite</a>
                    </div>
                    
            </div>


        <?php endforeach; ?>
        
        </div>
        <h2 class="article-item main-titre  col col-lg-12 col-md-9 col-sm-5 col-5">Top Utilisateurs</h2>
            <div class="top-users col mt-4">
                
                <?php
                    if (count($users) >= 3) {
                        $to = 3;
                    }
                    else {
                        $to = count($users);
                    }
                for ($i=0; $i < $to; $i++ ):
                    if ($i === 0) {?>
                    <div class="user-card firstuser ">
                    <?php  } else {?>
                        <div class="user-card col-lg-3 col-md-12 col-sm-12">
                        <?php } ?>
                        <p><?= $users[$i]->pseudo ?></p>
                        <p class="top-user-nb">nombres d'articles écrient</p>
                        <p><?= $users[$i]->nbArticles ?></p>
                        </div>
                <?php endfor; ?>
            </div>
        </div>
    </div>

    
    
</main>

<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/components/footer.php') ?>

</body>
</html>
