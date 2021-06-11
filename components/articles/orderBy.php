 <?php 

    require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/components/headers.php'); 

    $themes = getThemes();

 ?> 

 <div class="dropdown">
    <button class="btn article-btn dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" data-bs-toggle="dropdown" aria-expanded="false">

      <?php  

      if (isset($_GET['orderby'])) {
          echo $_GET['orderby'];

      }
      else if(isset($_GET['theme'])) {
        echo $_GET['theme'];
      }
      else {
          echo 'Trier par';
      }

    ?> 


    </button> 
  <div class="dropdown-menu" > 
        <a class="dropdown-item" href="/php_simple/pages/articles/articles.php?orderby=<?= "le plus recent"?>">le plus recent</a>

        <a class="dropdown-item" href="/php_simple/pages/articles/articles.php?orderby=<?= "le moins recent"?>">le moins recent</a>

        <a class="dropdown-item" href="/php_simple/pages/articles/articles.php?orderby=<?= "plus de vues"?>">plus de vues</a>
        <a class="dropdown-item" href="/php_simple/pages/articles/articles.php?orderby=<?= "moins de vues"?>">moins de vues</a>
        <a class="dropdown-item" href="/php_simple/pages/articles/articles.php?orderby=<?= "ABC"?>">ABC</a>
        <hr />
        

                <?php 
                    foreach ($themes as $theme) 
                        $arrayTheme[] = $theme->theme;

                    foreach(array_unique($arrayTheme) as $theme_): ?>
                        <a class="dropdown-item" href="/php_simple/pages/articles/articles.php?theme=<?= $theme_ ?>"> <?= $theme_?> </a>
                <?php endforeach; ?>        
            
        
    </div>
</div> 





