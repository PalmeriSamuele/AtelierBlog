<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/app/session.php'); 
    require('../../app/fonctions.php');

    if (isset($_POST['signup'])) {
        signUp($_POST['pseudo'], $_POST['email'], $_POST['password']);
        header('Location: /php_simple/index.php');
    }
    

    
 ?>

 <!DOCTYPE html>
 <html lang="fr">
 <head>
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/components/headers.php') ?> 
     <title>Sign Up</title>
 </head>
 <body>
 <?php require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/components/navigation.php') ?>
    <main>
        <form class="container form user-login-form" role="form" method="POST" accept-charset="UTF-8" action="<?php echo $_SERVER["PHP_SELF"];?>" style="width: 18rem;">
            <div class="form-group mt-2">

                <label class="sr-only" for="pseudo">Email address</label>
                <input type="text" class="form-control" id="pseudo" placeholder="pseudo" name="pseudo" required>
            </div>
            <div class="form-group mt-2">

                <label class="sr-only" for="email">Email address</label>
                <input class="form-control" type="text"  id="email-signup" placeholder="Email" name="email" required>
            </div>
            
            <div class="form-group mt-2">
                <label class="sr-only" for="password">Password</label>
                <input type="password" class="form-control" id="password-signup" name="password" placeholder="Mot de passe" aria-labellebddy="validation-user-password" required>
            </div>
    <!--                        <div class="form-group mt-2">-->
    <!--                            <label>-->
    <!--                                <input type="checkbox"> keep me logged-in-->
    <!--                            </label>-->
    <!--                        </div>-->
            <div class="form-group mt-3">
                <button action="createAccount.php" type="submit" name="signup" class="btn btn-success btn-block">S'inscrire</button>
            </div>
        </form>

        
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/components/footer.php') ?>

    </main>

 </body>
 </html>
 