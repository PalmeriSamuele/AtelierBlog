<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/app/session.php'); 
    require('../../app/fonctions.php');        
    $users = getUsers();                                                                                                               
    $artPinned = getPinned();
    $userid = null;
    $nbArticleVue  = 4;
    if (isset($_GET['userid'])) {
        $userid = $_GET['userid'];
        $user = getUser($userid);
    }                                                                                                                                                                            

    $userarticles = getArticlesById($userid);
    $articles = getArticles("");

    if (isset($_GET['articleid'])) {
        if (checkPermission(getId($_SESSION['name']))->role == 1) {
            if ($artPinned) {
                if ($artPinned->id == $_GET['articleid']) {
                    pinneArticle($_GET['articleid'],0);
                    $succes = "Article dépingler !";
                    header('Location: /php_simple/index.php?succes=' . $succes);
                }
                else {
                    pinneArticle($_GET['articleid'],1);
                    $succes = "Article épingler !";
                    header('Location: /php_simple/index.php?succes=' . $succes);
                }
            } 
            else {
                pinneArticle($_GET['articleid'],1);
                $succes = "Article épingler !";
                header('Location: /php_simple/index.php?succes=' . $succes);
            }
        }
        else {
            $error = "Vous n'avez pas les droits pour cette action";
            header('Location: /php_simple/index.php?succes=' . $fail);
        }
        
    }


    if (isset($_POST['modpseudo'])) {
        $userid = getId($_SESSION['name']);
        updatePseudo($userid,$_POST['modpseudo']);
        header("Location: /php_simple/pages/users/logout.php?succes=Votre pseudo a été changé en " . $_POST['modpseudo'] . ", veuillez vous reconnecter");
        
    }
    // if (isset($_POST['modpassword'])) {
    //     $userid = getId($_SESSION['name']);
    //     updatePassword($userid,$_POST['modpassword']);
    //     header("Location: /php_simple/pages/users/logout.php?succes=Votre mot de passe a été changé en " . $_POST['modpassword']. ", veuillez vous reconnecter");
    // }
    
    if (isset($_GET['updateuser'])) {
        $updateuser = $_GET['updateuser'];
        if(isset($_POST['changerole'])) {
            $changerole = $_POST['changerole'];
            if ($changerole === "admin") {
                updateRole($updateuser ,1);
                $succes = "Le role de " . getName($updateuser)->pseudo . " a été modifié en admin";
            }
            if ($changerole === "auteur") {
                updateRole($updateuser ,0);
                $succes =  "Le role de " . getName($updateuser)->pseudo . " a été modifié en auteur";
            }
            if ($changerole === "visiteur") {
                updateRole($updateuser ,null);
                $succes =  "Le role de " . getName($updateuser)->pseudo . " a été modifié en visiteur";
            }

        }
    }   

    if(isset($_POST['searchuser'])) {
        $users = getSearchtUser($_POST['searchuser']);
    }
?>



<!DOCTYPE html>
<html lang="fr">
    <head>
        <?php require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/components/headers.php') ?>       

        <title>Profile de <?php $_SESSION['name']?></title>
    </head>
    <body>
            <?php if (isset($succes)) { ?>
                <div class="alert alert-success"> 
                    <?= $succes ?>
                </div>
            <?php } ?>
            <?php if (isset($fail))  {?>
                <div class="alert alert-danger"> 
                    <?= $fail ?>
                </div>
            <?php } ?>
        <?php require_once('../../components/navigation.php') ?>
        <h2 class="profil-titre">Vos données </h2>
        <div class="mx-auto">
            <div class="profil-perso-data">
                <p class="label-info-perso">  <?= $user->pseudo ?> </p> 
                <form class="label-info-perso" action="profil.php?userid=<?= getId( $_GET['userid'])?>" method="POST">
                    <input type="text" name="modpseudo" id="modpseudo">
                    <button type="submit">modifier</button>
                </form>
            </div>
            <!-- <div class="profil-perso-data">
                <p class="label-info-perso">password</?= $user->password ?> </p> 
                <form action="profil.php?userid=<//?= getId($_GET['userid'])?>" method="POST">
                    <input type="text" name="modpassword" id="modpassword">
                    <button type="submit">modifier</button>
                </form>
            </div> -->
        </div>

        <hr>
        <h2 class="profil-titre">Vos articles</h2>
        
        <?php 
            $_SESSION['articles'] = $userarticles;
            require("../../components/articles/articles_components.php"); 
        ?>

        
        <hr>
    <?php if (checkPermission(getId($_SESSION['name']))->role == 1) { ?>
        <h2 class="profil-titre"> Utilisateurs </h2>

        <nav class="navbar navbar-dark bg-dark">
            <div class="container-fluid">
                <form action="/php_simple/pages/users/profil.php?userid=<?= getId($_SESSION['name'])?>" method="POST" class="d-flex">
                    <input class="form-control me-2" type="search" name="searchuser" id="searchuser" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </nav>

            <div class="container list-users">
                <?php
                if (!is_string($users)) {
                    for($i=0 ; $i < count($users); $i++): ?>
                        <div class="user card profil-user mx-auto">
                            <div class="profil-user-info">
                                <p><?= $users[$i]->pseudo ?></p>
                                <a href="/php_simple/components/users/deleteUser.php?superid=<?=getId($_SESSION['name'])?>&userid=<?= $users[$i]->id?>" class="fas fa-trash-alt">  </a>
                            </div>
                            <form action="profil.php?userid=<?= getId($_SESSION['name'])?>&updateuser=<?= $users[$i]->id?>" method="POST">
                                <input type="radio" name="changerole" value="admin" id="admin" class="changemode">
                                <label for="admin">admin</label>
                                <input type="radio" name="changerole" value="auteur" id="auteur" class="changemode">
                                <label for="aurteur">auteur</label>
                                <input type="radio" name="changerole" value="visiteur" id="visiteur" class="changemode">
                                <label for="visiteur">visiteur</label>
                                <button type="submit">modifier</button>
                            </form>
                        </div>
                    <?php endfor; 
                }  
                else { ?>
                        <div class="alert alert-danger"> 
                            <?= $users ?>
                        </div>
                <?php } ?>
            
            </div>
        


        <hr>

        <h2 class="profil-titre">Tous les articles</h2>

        <?php 
            require('../../components/articles/OrderBy.php');
            $_SESSION['articles'] = $articles;
            require("../../components/articles/articles_components.php"); 
        
        ?>
    <?php } ?>
    </body>
</html>