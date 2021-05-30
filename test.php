<?php
    $i=0;
    $rep = false;
    while ($i < count($artilces) or !$rep) { 
        if ($articles[$i]->isPinned === 1) { 
            $rep = true; ?>
            <h2><?= $articles[$i]->titre ?> </h2>
            <a class="btn btn-primary" href="/php_simple/article.php?id=<?=$articles[$i]->id?>">lire la suite</a>
        }
        <?php $i++; 
    } 
    
?> 