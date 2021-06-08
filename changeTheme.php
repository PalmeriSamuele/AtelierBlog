<?php 
    require_once('../../index.php');
     if(isset($_COOKIE['theme'])) {
         $dom = new DOMDocument();
         $changetheme = $dom->getElementByID("body2");
         var_dump($changetheme);
         
     }
?>