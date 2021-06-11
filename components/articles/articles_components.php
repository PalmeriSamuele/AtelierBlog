<?php 

if (isset($_SESSION['articles'])){
    $articles = $_SESSION['articles'];
}


?>


<div class="container">
        <div class="profil-articles-box">
            <?php 
            if (isset($articles) && !is_string($articles)) { 
                foreach($articles as $article): ?>
                    <div class="card mx-auto card-article ">
                        <div class="card-body">
                            <img class=" card-img-top" src="<?= $article->imagePath ?>" alt="Card image cap">
                            <div class="info-bottom">
                                <h2 class="card-title main-article-title"><?= $article->titre ?> </h2>
                                <a class="btn article-btn card-link card-body-item " href="/php_simple/pages/articles/article.php?id=<?=$article->id?>">lire la suite</a>
                                <?php  
                                if (isset($_SESSION['name'])) {
                                    if (checkPermission(getId($_SESSION['name']))->role == 1) { ?>
                                        <a href="../users/profil.php?articleid=<?= $article->id ?>" class="btn article-pinne-btn" id="pinneLink"  > 
                                   
                                            <?php
                                            
                                                    if ($artPinned) {
                                                        if ($artPinned->id == $article->id) {
                                                            $valupdate = 0;
                                                            ?> <i class="fas fa-star red"></i> <?php
                                                           
                                

                                                        }
                                                        else {
                                                            ?> <i class="far fa-star "></i> <?php
                                                            $valupdate = 1;
                                                           
                                                
                                                        }
                                                    } 
                                                    else {
                                                        ?> <i class="far fa-star "></i> <?php
                                                        $valupdate = 1;
                                                
                                                    }
                                                
                                            ?>
                                        </a>
                                
                                        <a href="/php_simple/components/articles/deleteArticle.php?userid=<?=getId($_SESSION['name']) ?>&articleid=<?= $article->id?>&authorid=<?= $article->authorid ?> " class="articles-link"> <i class="fas fa-trash-alt"></i></a>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach;  
                }  ?>

        </div>
</div>
