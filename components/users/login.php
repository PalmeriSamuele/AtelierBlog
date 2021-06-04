<?php

   
    $errors = null;
    $success = null;

    if (isset($_POST['login'])) {
        header('Location: /php_simple/index.php');
        $name = $_POST['email'];
        $mdp = $_POST['password'];
        if (!isset($name) or empty($name)) {
            $errors = "Veuillez insérer un pseudo/email!";
            $_SESSION['name'] = null;
            header('Location: /php_simple/index.php?fail=' . $errors);
        
            
        }
        if (empty($mdp)) { 
            $errors = "Veuillez insérer un mot de passe !";
            $_SESSION['name'] = null;
            header('Location: /php_simple/index.php?fail=' . $errors);
         
       
        }
        if (!empty($name) && !empty($mdp)) {
    
     
            if (checkIfExist($name, $mdp)) {
                $_SESSION['name'] = $name;
                $success = 'Vous etes connecté, bienvenue ';
                header('Location: /php_simple/index.php?succes=' . $success);
            }
            else {
                $errors = 'Email ou mot de passe incorect';
                $_SESSION['name'] = null;
                header('Location: /php_simple/index.php?fail=' . $errors);
     
            }
                
        }
    }

    if (isset($_POST['signup']))
        header('Location: /php_simple/components/users/createAccount.php');

?>



<li>

    
    <?php if (isset($errors))  { ?>
        <div class="alert alert-danger" > 
            <?= $errors; ?>
        </div>   
    <?php } ?>
    <?php if (isset($success))  { ?>
        <div class="alert alert-success"> 
            <?= $success . $name; ?>
        </div>  
    <?php } ?>

    <div class="dropdown">
   
        <a  class="connect btn btn-secondary dropdown-toggle me-5" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">

                         <?php  

                        if (isset($_SESSION['name'])) {
                            echo $_SESSION['name'];

                        }
                        else {
                            echo 'se connecter';
                        }

                        ?>
        </a>
    
    <ul class="dropdown-menu " aria-labelledby="dropdownMenuLink">

        <li id="notconnected"> 
            <form class="form user-login-form" role="form" method="POST" accept-charset="UTF-8" action="<?php echo $_SERVER["PHP_SELF"];?>">

                <div class="form-group">

                    <label class="sr-only" for="email">Email address</label>
                    <input type="text" class="form-control <?php echo (isset($errors['email']) ? 'is-invalid' : '') ?>" id="email" placeholder="Email" name="email" aria-labellebddy="validation-user-email" >
                    <div id="validation-user-email" class="invalid-feebddack">
                        <?php echo (isset($errors['email']) ? $errors['email'] : '') ?>
                    </div>
                </div>
                <div class="form-group mt-2">
                    <label class="sr-only" for="password">Password</label>
                    <input type="password" class="form-control <?php echo (isset($errors['password']) ? 'is-invalid' : '') ?>" id="password" name="password" placeholder="Mot de passe" aria-labellebddy="validation-user-password" >
                    <div id="validation-user-password" class="invalid-feebddack">
                        <?php echo (isset($errors['password']) ? $errors['password'] : '') ?>
                    </div>

                <div class="form-group mt-2">
                    <button action="login.php" type="submit" name="login" class="btn btn-primary btn-block">Se connecter</button>
                    <button action="login.php" type="submit" name="signup" class="btn btn-success btn-block">S'inscrire</button>
                </div>
            </form>
        </li>

        <li id="connected">        
            <li><a class="dropdown-item" href="/php_simple/pages/users/profil.php?userid=<?=getId($_SESSION['name'])?>">Mon profil</a></li>
            <li><hr class="dropdown-divider" ></li>
            <li><a class="dropdown-item" href="/php_simple/pages/users/logout.php">Déconnexion</a></li>
        </li>

    </ul>
</div>
    
