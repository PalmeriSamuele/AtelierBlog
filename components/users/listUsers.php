<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/app/session.php');
    require('../../app/fonctions.php');
    $users = getUsers();

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
    <?php if (isset($_GET['succes'])) { ?>
        <div class="alert alert-success "> 
        <?= $_GET['succes'];
            } ?>
        </div>  
    <?php if (isset($_GET['fail'])) { ?>
        <div class="alert alert-danger "> 
        <?= $_GET['fail'];
            } ?>
        </div>  
<?php require('user.php'); ?>

</main>

<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php_simple/components/footer.php') ?>

</body>
</html>