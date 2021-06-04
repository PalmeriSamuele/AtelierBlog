<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/app/session.php'); 
    require('../../app/fonctions.php');        
    $users = getUsers();                                                                                                               
    $artPinned = getPinned();
    $userid = null;
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
    if (isset($_POST['modpassword'])) {
        $userid = getId($_SESSION['name']);
        updatePassword($userid,$_POST['modpassword']);
        header("Location: /php_simple/pages/users/logout.php?succes=Votre mot de passe a été changé en " . $_POST['modpassword']. ", veuillez vous reconnecter");
    }
    
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
            <p class="label-info-perso">pseudo  <?= $user->pseudo ?> </p> 
            <form class="label-info-perso" action="profil.php?userid=<?= getId( $_GET['userid'])?>" method="POST">
                <input type="text" name="modpseudo" id="modpseudo">
                <button type="submit">modifier</button>
            </form>
        </div>
        <div class="profil-perso-data">
            <p class="label-info-perso">password  <?= $user->password ?> </p> 
            <form action="profil.php?userid=<?= getId($_GET['userid'])?>" method="POST">
                <input type="text" name="modpassword" id="modpassword">
                <button type="submit">modifier</button>
            </form>
        </div>
    </div>
    <h2 class="profil-titre">Vos articles</h2>
    <?php 
    if (isset($articles)) {
        foreach($userarticles as $article): ?>
            <div class="card mx-auto mb-3" style="width: 18rem;">
                <div class="card-body">
                    <h2 class="card-title "><?= $article->titre ?> </h2>
                    <a class="btn btn-primary" href="/php_simple/pages/articles/article.php?id=<?=$article->id?>">lire la suite</a>
                </div>
            </div>
         <?php endforeach;  ?>
    <?php }
    else {
        echo "Vous n'avez pas encore d'articles !";
    } ?>
    
<?php if (checkPermission(getId($_SESSION['name']))->role == 1) { ?>
    <h2 class="profil-titre"> Utilisateurs </h2>
        <div class="container">
                <div class="row">
                    <div class="col col-sm">
                    <?php foreach($users as $user): ?>
                        <div class="user card profil-user mx-auto">
                            <div class="profil-user-info">
                                <p><?= $user->pseudo ?></p>
                                <a href="/php_simple/components/users/deleteUser.php?superid=<?=getId($_SESSION['name'])?>&userid=<?= $user->id?>" class="fas fa-trash-alt">  </a>
                            </div>
                            <form action="profil.php?userid=<?= getId($_SESSION['name'])?>&updateuser=<?= $user->id?>" method="POST">
                                <input type="radio" name="changerole" value="admin" id="admin">
                                <label for="admin">admin</label>
                                <input type="radio" name="changerole" value="auteur" id="auteur">
                                <label for="aurteur">auteur</label>
                                <input type="radio" name="changerole" value="visiteur" id="visiteur">
                                <label for="visiteur">visiteur</label>
                                <button type="submit">modifier</button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

<hr>
<h2 class="profil-titre" >Tous les articles </h2>
        <div class="container">
        <div class="row">
            <?php require('../../components/articles/orderBy.php');  ?>
            <?php foreach($articles as $article):  ?>
                <div class="col articles">
                    <div class="card mx-auto mb-3" style="width: 18rem;">
                        <div class="card-body">
                        <h2 class="article-titre"><?= $article->titre ?> </h2>
                        <a class="btn btn-primary" href="/php_simple/pages/articles/article.php?id=<?=$article->id?>">lire la suite</a>
                        <a href="profil.php?articleid=<?= $article->id ?>" class="far fa-star" id="pinneLink" onclick="changeClassDePinne()" > 
                        <?php

                            if ($artPinned) {
                                if ($artPinned->id == $article->id) {
                                    $valupdate = 0;
                                    echo 'dépingler';
        

                                }
                                else {
                                    $valupdate = 1;
                                    echo 'épingler';
                           
                                }
                            } 
                            else {
                                $valupdate = 1;
                                echo 'épingler';
                            }

                        ?>
                        </a>
            
                        <a href="/php_simple/components/articles/deleteArticle.php?userid=<?=getId($_SESSION['name']) ?>&articleid=<?= $article->id?>&authorid=<?= $article->authorid ?> " class="fas fa-trash-alt"></a>
                    </div>
                </div>
            <?php endforeach; ?>
            
        </div>
    </div>
    <?php } ?>


    
    

</body>
</html>