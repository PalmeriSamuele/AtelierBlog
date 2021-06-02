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
    $articles = getArticles();

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
        updatePseudo(getId($_SESSION['name']),$_POST['modpseudo']);
        header('Location: /php_simple/pages/users/profil.php?user=' . $_GET['user'] );
        
    }
    if (isset($_POST['modpassword'])) {
        updatePassword(getId($_SESSION['name']),$_POST['modpassword']);
        header('Location: /php_simple/pages/users/profil.php?user=' . $_GET['user'] );
    }
    
    if (isset($_GET['updateuser'])) {
        $updateuser = $_GET['updateuser'];
        if(isset($_POST['changerole'])) {
            $changerole = $_POST['changerole'];
            if ($changerole === "admin") {
                updateRole($updateuser ,1);
                $succes = "Le role de " . getName($updateuser) . " a été modifié en admin";
            }
            if ($changerole === "auteur") {
                updateRole($updateuser ,0);
                $succes =  "Le role de " . getName($updateuser) . " a été modifié en auteur";
            }
            if ($changerole === "visiteur") {
                updateRole($updateuser ,null);
                $succes =  "Le role de " . getName($updateuser) . " a été modifié en visiteur";
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
    <h2>Vos données :</h2>
    <div>
        <p>pseudo : <?= $user->pseudo ?> </p> 
        <form action="profil.php?user=<?= $_GET['user']?>" method="POST">
            <input type="text" name="modpseudo" id="modpseudo">
            <button type="submit">modifier</button>
        </form>
    </div>
    <div>
        <p>password : <?= $user->password ?> </p> 
        <form action="profil.php?user=<?= $_GET['user']?>" method="POST">
            <input type="text" name="modpassword" id="modpassword">
            <button type="submit">modifier</button>
        </form>
    </div>
    <h2>Vos articles :</h2>
    <?php 
    if (isset($articles)) {
        foreach($userarticles as $article): ?>
            <div class="card mx-auto mb-3" style="width: 18rem;">
                <div class="card-body">
                    <h2><?= $article->titre ?> </h2>
                    <a class="btn btn-primary" href="/php_simple/pages/articles/article.php?id=<?=$article->id?>">lire la suite</a>
                </div>
            </div>
         <?php endforeach;  ?>
    <?php }
    else {
        echo "Vous n'avez pas encore d'articles !";
    } ?>
    
<?php if (checkPermission(getId($_SESSION['name']))->role == 1) { ?>
    <h2> Utilisateurs :</h2>
        <div class="container">
                <div class="row">
                    <div class="col articles">
                    <?php foreach($users as $user): ?>
                        <div class="user card">
                            <p>nom <?= $user->pseudo ?></p>
                            <p> email  <?= $user->email ?></p>
                            <a href="/php_simple/components/users/deleteUser.php?superid=<?=getId($_SESSION['name'])?>&userid=<?= $user->id?>"> delete </a>
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
<h2>Tous les articles :</h2>
        <div class="container">
        <div class="row">
            <?php require('../../components/articles/orderBy.php');  ?>
            <?php foreach($articles as $article):  ?>
                <div class="col articles">
                    <div class="card mx-auto mb-3" style="width: 18rem;">
                        <div class="card-body">
                        <h2><?= $article->titre ?> </h2>
                        <a class="btn btn-primary" href="/php_simple/pages/articles/article.php?id=<?=$article->id?>">lire la suite</a>
                        <a href="profil.php?articleid=<?= $article->id ?>"> 
                        <?php

                            if ($artPinned) {
                                if ($artPinned->id == $article->id) {
                                    $valupdate = 0;
                                    echo "Dépingler l'article";
                                }
                                else {
                                    $valupdate = 1;
                                    echo "Épingler l'article";
                                }
                            } 
                            else {
                                $valupdate = 1;
                                echo "Épingler l'article";
                            }

                        ?>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
            
        </div>
    </div>
    <?php } ?>


    
    

</body>
</html>