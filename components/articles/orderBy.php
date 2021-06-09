<!-- <?php 

    require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/components/headers.php'); 

    $themes = getThemes();

 ?> 

 <div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" >

      <?php  

      if (isset($_GET['orderby'])) {
          echo $_GET['orderby'];

      }
      else {
          echo 'Trier par';
      }

    ?> 
    </button> 
  <div class="dropdown-menu" > 
    <a class="dropdown-item" href="/php_simple/pages/articles/articles.php?orderby=<?= "desc"?>">Date desc</a>

    <a class="dropdown-item" href="/php_simple/pages/articles/articles.php?orderby=<?= "asc"?>">Date asc</a>

    <a class="dropdown-item" href="/php_simple/pages/articles/articles.php?orderby=<?= "moreVues"?>">plus de vues</a>
    <a class="dropdown-item" href="/php_simple/pages/articles/articles.php?orderby=<?= "lessVues"?>">moins de vues</a>
    <a class="dropdown-item" href="/php_simple/pages/articles/articles.php?orderby=<?= "ABC"?>">A...Z</a>
    <hr />
    <li><p>Par thème</p>
    <?php 
        foreach ($themes as $theme) 
            $arrayTheme[] = $theme->theme;

        foreach(array_unique($arrayTheme) as $theme_): ?>
            <a class="dropdown-item" href="/php_simple/pages/articles/articles.php?theme=<?= $theme_ ?>"> <?= $theme_?> </a>
    <?php endforeach;

?>
    </div>
</div> -->


<a class="dropdown-item" href="/php_simple/pages/articles/articles.php?orderby=<?= "desc"?>">Le plus récent</a>

    <a class="dropdown-item" href="/php_simple/pages/articles/articles.php?orderby=<?= "asc"?>">Le moins récent</a>

    <a class="dropdown-item" href="/php_simple/pages/articles/articles.php?orderby=<?= "moreVues"?>">plus de vues</a>
    <a class="dropdown-item" href="/php_simple/pages/articles/articles.php?orderby=<?= "lessVues"?>">moins de vues</a>
    <a class="dropdown-item" href="/php_simple/pages/articles/articles.php?orderby=<?= "ABC"?>">A...Z</a>
    <hr />
    <li><p>Par thème</p>
    <?php 
        foreach ($themes as $theme):
            $arrayTheme[] = $theme->theme;
        endforeach;
        foreach(array_unique($arrayTheme) as $theme_): ?>
            <a class="dropdown-item" href="/php_simple/pages/articles/articles.php?theme=<?= $theme_ ?>"> <?= $theme_?> </a>
    <?php endforeach;

?>



