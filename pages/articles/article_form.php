<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/app/session.php'); 
    require('../../app/fonctions.php');
    $msuccess = null;
    $merror = null ;
    $notconnected = 'Vous devez etre connecte';
    if (!empty($_POST)) {
        $id = getId($_SESSION['name']);
        if (isset($_POST['titre']) and isset($_POST['contenu']) and isset($_SESSION['name']) and checkPermission($id)->role !== null) {
            addArticle($_POST['titre'],$_POST['contenu'],$id);
            updateNbArticles($id,"");   // on update le nb articles dans la bdd +1
            $msuccess = "Article enregistré";
        }
        else { 
            $merror = "Vous n'avez pas les droits pour cette action";
        }
    }




?>

<!doctype html>
<html lang="fr">
<head>
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/components/headers.php') ?>

    <script>

    </script>

    <title>Home blog</title>
</head>
<body>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/components/navigation.php') ?>

<main role="main">
    <?php if (!isset($_SESSION['name'])) { ?>
        <div class="alert alert-danger "> 
           <?= $notconnected;
            } ?>
        </div>  
    <?php if (isset($merror)) { ?>
        <div class="alert alert-danger "> 
           <?= $merror;
            } ?>
        </div>  
    <?php if (isset($msuccess)) { ?>
        <div class="alert alert-success "> 
           <?= $msuccess;
            } ?>
        </div>  

    <div class="container">
        <div class="row">
            <div class="col">
                <form role="form" method="POST" accept-charset="UTF-8" action="article_form.php" novalidate>
                    <input type="text" name="id" value="{{uuid}}" class="d-none" />
                    <input type="text" name="version" value="{{version_iso}}" class="d-none" />
                    <input type="text" name="image_extension" value="{{image_extension}}" class="d-none" />
                    <div class="form-group">
                        <label for="title">Titre*</label>
                        <input type="text" name="titre" minlength="3" maxlength="100" value="" class="form-control <?php echo (isset($errors['title']) ? 'is-invalid' : '') ?>" id="title" placeholder="Titre" aria-describedby="validation-title"  required>
                        <div id="validation-title" class="invalid-feedback">
                            <?php echo (isset($errors['title']) ? $errors['title'] : '') ?>
                        </div>
                    </div>
                    <!--
                    <div class="form-group mt-3">
                        <label for="excerpt">Résumé de l'article</label>
                        <input type="text" name="excerpt" value="" class="form-control" id="excerpt" placeholder="Résumé" aria-describedby="validation-excerpt">
                        <div id="validation-excerpt" class="invalid-feedback"></div>
                    </div>
                     <div class="form-group mt-3">
                        <label for="excerpt">Image de l'article</label>
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <input type="file" id="image" name="image" class="form-control" accept="image/png, image/jpeg, image/jpg, image/gif" aria-describedby="validation-image">
                                <div id="validation-image" class="invalid-feedback"></div>
                            </div>
                            <div class="mt-1 pr-1 flex-grow-1 d-flex justify-content-end">
                                <div>
                                    <img src="" class="card-img-top d-none article-image preview" alt="article-image">
                                    <div><i>Image actuelle</i></div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="form-group mt-3">
                        <label for="body">Contenu*</label>
                        <textarea class="form-control" id="body" name="contenu" rows="3" aria-describedby="validation-body" required></textarea>
                        <div id="validation-body" class="invalid-feedback"></div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Publier</button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/components/footer.php') ?>

</body>
</html>

