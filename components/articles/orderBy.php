<?php 


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
    <li><a class="dropdown-item" href="">Date desc</a> </li>
    <li><a class="dropdown-item" href="#">Date asc</a></li>
    <li><a class="dropdown-item" href="#">plus de vues</a></li>
    <li><a class="dropdown-item" href="#">moins de vues</a></li>
    <li><a class="dropdown-item" href="#">A...Z</a></li>
  </ul>
</div>