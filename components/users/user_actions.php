<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="php_simple/components/footer.php" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <?php
            echo $user['name'];
        ?>
    </a>
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarScrollingDropdown">
        <li><a class="dropdown-item" href="">Modifier son profil</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="http://localhost/php_simple/pages/users/logout.php">Déconnexion</a></li>
    </ul>
</li>



