<?php 

$nbArticleVue  = 4;
if (isset($_SESSION['articles'])){
    $articles = $_SESSION['articles'];
}


?>


<div class="container">
        <div class="profil-articles-box">
            <?php 
            if (isset($articles)) { 
                foreach($articles as $article): ?>
                    <div class="card mx-auto mb-3 card-article ">
                        <div class="card-body">
                            <img class="card-body-item card-img-top" src="<?= $article->imagePath ?>" alt="Card image cap">
                            <h2 class="card-body-item card-title main-article-title"><?= $article->titre ?> </h2>
                            <a class="btn btn-primary card-link card-body-item " href="/php_simple/pages/articles/article.php?id=<?=$article->id?>">lire la suite</a>
                            <?php  
                            if (isset($_SESSION['name'])) {
                                if (checkPermission(getId($_SESSION['name']))->role == 1) { ?>
                                    <a href="profil.php?articleid=<?= $article->id ?>" class="far fa-star" id="pinneLink" onclick="changeClassDePinne()" > 
                                        <?php
                                        
                                                if ($artPinned) {
                                                    if ($artPinned->id == $article->id) {
                                                        $valupdate = 0;
                                                        echo 'dépingler';
                            

                                                    }
                                                    else {
                                                        $valupdate = 1;
                                                        echo 'épingler';
                                            
                                                    }
                                                } 
                                                else {
                                                    $valupdate = 1;
                                                    echo 'épingler';
                                                }
                                            
                                        ?>
                                    </a>
                            
                                    <a href="/php_simple/components/articles/deleteArticle.php?userid=<?=getId($_SESSION['name']) ?>&articleid=<?= $article->id?>&authorid=<?= $article->authorid ?> " class="fas fa-trash-alt"></a>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                <?php endforeach;  
                } 
                else {
                echo "il n'y a pas d'articles !";
            } ?>
        </div>
</div>
<!-- <?php if (count($articles) > $nbArticleVue) { ?>
   <a href="articles_components.php">Affricher plus</a>

<?php } ?> -->