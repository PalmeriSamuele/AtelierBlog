<?php 
    //  if(isset($_COOKIE['theme'])) {
    //     require_once('simple_html_dom.php');

    //     $html = new simple_html_dom();
    //     $html->load_file("http://127.0.0.1");
    //     echo $html->find('#body2')->className;
    //     $html->find("body");
    //      $changetheme = $dom->getElementByID("body2");
    //      var_dump($dom);
    //      var_dump($dom->body);
    //  }

?>
<header>
    
    <nav class=" navbar pos-f-t navigation navbar-expand-lg navbar  mb-5">
        <div class="container-fluid navigation">
            <a class="navbar-brand" href="/">
                Handl
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/php_simple/pages/articles/articles.php">Articles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/php_simple/pages/articles/article_form.php?id=">Créer</a>
                    </li>

                    
                </ul>
                

                <!-- ---------------------------------------------barre de recherche----------------------------------------------->

                <ul class="navbar-nav mb-2 mb-lg-12 ms-auto">

                    <li class="nav-links">
                        <div id="dark-theme">
                            <label>
                                <input id="checkbox" type="checkbox" class="toggle" data-toggle="toggle" data-on="<i class='fas fa-moon red'></i>   " data-off="<i class='fas fa-lightbulb red'></i>   " data-onstyle="dark" data-offstyle="light" checked > 

                            </label>
                        </div>
                    </li>
                    <li class="nav-links">

                            <div class="container-fluid">
                                <form action="/php_simple/components/articles/searchArticles.php?search='<?= $_GET['search']?>" method="GET" class="d-flex">
                                    <input class="form-control me-2" type="search" name="search" id="search" placeholder="Search" aria-label="Search">
                                    <button class="btn search-btn" type="submit">Search</button>
                                </form>
                            </div>
                    </li>
                    <li class="nav-links">
                        <?php
                            require($_SERVER['DOCUMENT_ROOT'] . '/php_simple/components/users/login.php');
                        ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <script src="/php_simple/resources/js/login.js" type="text/javascript"></script>
    <script src="/php_simple/resources/js/theme.js" type="text/javascript"></script>
</header>
