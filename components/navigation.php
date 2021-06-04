

<header>
    <nav class="navigation navbar-expand-lg navbar navbar-dark mb-5">
        <div class="container-fluid">
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
                <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
                    <li>
                        <nav class="navbar navbar-dark bg-dark">
                            <div class="container-fluid">
                                <form action="/php_simple/components/articles/searchArticles.php?search='<?= $_GET['search']?>" method="GET" class="d-flex">
                                    <input class="form-control me-2" type="search" name="search" id="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-outline-success" type="submit">Search</button>
                                </form>
                            </div>
                        </nav>
                    </li>
                    <li>
                        <?php
                            require($_SERVER['DOCUMENT_ROOT'] . '/php_simple/components/users/login.php');
                        ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <script src="/php_simple/resources/js/login.js" type="text/javascript"></script>
</header>
