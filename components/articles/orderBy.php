<?php 

 require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/components/headers.php'); 
//  var_dump($_POST);
//   if (isset($_POST['orderby'])) {
//     if ($_POST['orderby'] == "desc") {
//       header('Location: /php_simple/pages/articles/articles.php?orderby=desc');
//     }
//     if ($_POST['orderby'] == "asc") {
//       header('Location: /php_simple/pages/articles/articles.php?orderby=asc');
//     }
//     if ($_POST['orderby'] == "moreVues") {
//       header('Location: /php_simple/pages/articles/articles.php?orderby=moreVues');
//     }
//     if ($_POST['orderby'] == "lessVues") {
//       header('Location: /php_simple/pages/articles/articles.php?orderby=lessVues');
//     }
//     if ($_POST['orderby'] == " ") {
//       header('Location: /php_simple/pages/articles/articles.php?orderby= ');
//     }
//   }
 ?> 

 <div class="dropdown">
    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
     <?php  

      if (isset($_GET['orderby'])) {
          echo $_GET['orderby'];

      }
      else {
          echo 'Trier par';
      }

    ?> 
    </a> 
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink"> 
      <a class="dropdown-item" href="/php_simple/pages/articles/articles.php?orderby=<?= "desc"?>">Date desc</a> 

      <a class="dropdown-item" href="/php_simple/pages/articles/articles.php?orderby=<?= "asc"?>">Date asc</a>

      <a class="dropdown-item" href="/php_simple/pages/articles/articles.php?orderby=<?= "moreVues"?>">plus de vues</a>
      <a class="dropdown-item" href="/php_simple/pages/articles/articles.php?orderby=<?= "lessVues"?>">moins de vues</a>
      <a class="dropdown-item" href="/php_simple/pages/articles/articles.php?orderby=<?= "ABC"?>">A...Z</a>
 </ul>
</div>

<!-- 
<form method="POST" action="orderBy.php">
   
    <select name="orderby" id="orderby">
        <option value="desc">Date desc</option>
        <option value="asc">Date asc</option>
        <option value="moreVues">plus de vues</option>
        <option value="lessVues">moins de vues</option>
        <option value=" " >A...Z</option>
    </select>
    <button type="submit"> trier par</button>
</form>  -->