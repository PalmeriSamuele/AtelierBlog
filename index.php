<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/app/session.php'); 
    require('app/fonctions.php');
    $articles = getArticles();
    $users = getUsers();




?>



<!doctype html>
<html lang="fr">
<head>
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/components/headers.php') ?> 

	<script>
	
	</script>

    <title>Home blog</title>
</head>
<body>
<?php if (isset($_GET['succes']))  { ?>
        <div class="alert alert-success"> 
            <?= $_GET['succes'] ?>
        </div>
        <?php } ?>
    <?php if (isset($_GET['fail']))  { ?>
        <div class="alert alert-danger"> 
            <?= $_GET['fail'] ?>
        </div>
        <?php } ?>
<?php require_once('components/navigation.php') ?>

<main role="main">
    
    <div class="container">
        <div class="row">
            <div class="col pinned-articles articles">
                <?php $i=0;
                    $rep = false;
                    while($i < count($articles)):
                        if ($articles[$i]->isPinned == 1):
                            $rep = true; ?>
                            <div class="card mx-auto mb-3" style="width: 18rem;">
                                
                                <div class="card-body">
                                
                                    <h2><?= $articles[$i]->titre ?> </h2>
                                    <a class="btn btn-success" href="/php_simple/article.php?id=<?=$articles[$i]->id?>">lire la suite</a>
                                    
                                </div>
                            </div>
                            <hr />
                        <?php endif; ?>
                        <?php  $i++; 
                        endwhile; ?> 
                    
            </div>
        </div>
    </div>

    

    <?php 
    if (count($articles) >= 3) {
        $to = 3;
    }
    else {
        $to = count($articles);
    }
    for($i=0; $i<$to; $i++): ?>
        <div class="card mx-auto mb-3" style="width: 18rem;">
            
            <div class="card-body">
            
                <h2><?= $articles[$i]->titre ?> </h2>
                <a class="btn btn-primary" href="/php_simple/article.php?id=<?=$articles[$i]->id?>">lire la suite</a>
            </div>
        </div>
     <?php endfor;  ?>

     <div class="container " id='tohide'>
        <div class="row">
            <div class="col articles">
            <?php
                if (count($users) >= 3) {
                    $to = 3;
                }
                else {
                    $to = count($users);
                }
             for ($i=0; $i < $to; $i++ ):?>

                <div class="user card">
                    <p>nom <?= $users[$i]->pseudo ?></p>
                    <p> email  <?= $users[$i]->email ?></p>
                    <p><?= $users[$i]->nbArticles ?></p>
                    </div>
            <?php endfor; ?>
        </div>
    </div>

</main>
            </div>
        </div>
    </div>
    
    <script src="/php_simple/resources/js/login.js"></script>
</main>

<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/components/footer.php') ?>

</body>
</html>
