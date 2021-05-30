<?php
   
   
    $errors = null;
    $success = null;

    if (isset($_POST['login'])) {
        header('Location: /php_simple/index.php');
        $name = $_POST['email'];
        $mdp = $_POST['password'];
        if (!isset($name) or empty($name)) {
            $errors = "Met un pseudo";
            $_SESSION['name'] = null;
        
            
        }
        if (empty($mdp)) { 
            $errors = "Met un mot de passe";
            $_SESSION['name'] = null;
         
       
        }
        if (!empty($name) && !empty($mdp)) {
    
     
            if (checkIfExist($name, $mdp)) {
                $_SESSION['name'] = $name;
                $success = 'vous etes connecte, bienvenue ';
            }
            else {
                $errors = 'Email ou mot de passe incorect';
                $_SESSION['name'] = null;
                
     
            }
                
        }



    }

    if (isset($_POST['signup']))
        header('Location: /php_simple/components/users/createAccount.php');
    
   

    


    
    
/*
    require_once($_SERVER['DOCUMENT_ROOT'] . '/php_simple/app/form_utils.php');
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = test_input($_POST["email"]);
        $password = test_input($_POST["password"]);

        if (is_null($email) || $email == '') {
            $errors  = 'email requis.';
        }

        if (is_null($password) || $password == '') {
            $errors  = 'email requis.';
        }
        
        if (empty($errors) && isset($bdd)) {
            try {
                $sql = "SELECT * from user where email = :email LIMIT 1";

                $stmt = $bdd->prepare($sql);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->execute();
                $user = $stmt->fetch();

                if (!$user) {
                    $user = null;
                } else {

                    if(password_verify($password, $user['password'])) {
                        echo 'succes';
                        $_SESSION['user'] = $user;
                        header('Location: http://localhost/php_simple/index.php');
                    } else {
                        $user = null;
                    }
                }

                $bdd = null;
            } catch (Exception $exception) {
                echo $exception;
            }
        }
    }
    */



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
   
        <a  class=" connect btn btn-secondary dropdown-toggle me-5" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">

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
                    <div class="help-block text-right"><a href="">Mot de passe oublié ?</a></div>
                </div>
                <!--                        <div class="form-group mt-2">-->
                <!--                            <label>-->
                <!--                                <input type="checkbox"> keep me logged-in-->
                <!--                            </label>-->
                <!--                        </div>-->
                <div class="form-group mt-2">
                    <button action="login.php" type="submit" name="login" class="btn btn-primary btn-block">Se connecter</button>
                    <button action="login.php" type="submit" name="signup" class="btn btn-success btn-block">S'inscrire</button>
                </div>
            </form>
        </li>

        <li id="connected">        
            <li><a class="dropdown-item" href="">Modifier son profil</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/php_simple/pages/users/logout.php">Déconnexion</a></li>
        </li>

   </ul>
    </div>
    
