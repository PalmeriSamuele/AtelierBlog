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
<body id="body2">
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
                                <h2 class="article-item main-titre "><i class="fas fa-star red"></i>Article mit en avant</h2>
                                <?php
                                $rep = true; ?>
                                <div class=" card mx-auto mb-3 pinned-article">
                                    
                                    <div class="card-body">
                                    
                                        <h2 class="pinned-article-titre"><?= $articles[$i]->titre ?> </h2>
                                        <a class="btn pinned-btn" href="/php_simple/pages/articles/article.php?id=<?=$articles[$i]->id?>">lire la suite</a>
                                    
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



        <?php for($i=0 ; $i < $to ;$i++):  ?>

            <div class="card-article card mx-auto ">
         
                <div class="card-body">
                        <img class="card-img-top" src="<?= $articles[$i]->imagePath ?>" alt="Card image cap">
                        <h5 class="card-title"><?= $articles[$i]->titre ?></h5>
                        <a href="/php_simple/pages/articles/article.php?id=<?=$articles[$i]->id?>&vue= <?= $articles[$i]->id?>" class="btn article-btn">lire la suite</a>
                        
                    </div>
                   
            </div>


        <?php endfor; ?>
       
        </div>

        <hr>
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
                    <div class=" card user-card firstuser " >
                    <?php  } else {?>
                        <div class="card user-card" >
                        <?php } ?>
                        <p class="top-users-pseudo" ><?= $users[$i]->pseudo ?></p>
                        <p class="top-user-nb">nombres d'articles écrient</p>
                        <p class="top-users-nbvue" ><?= $users[$i]->nbArticles ?></p>
                        </div>
                <?php endfor; ?>
            </div>
        </div>
    </div>

    
    
</main>

<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/components/footer.php') ?>

</body>
</html>
