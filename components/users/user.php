
<?php 
    require('../../app/fonctions.php');
    $users = getUsers();

    
?>
<div class="container">
        <div class="row">
            <div class="col articles">
            <?php foreach($users as $user): ?>
                <div class="user card">
                    <p>nom <?= $user->pseudo ?></p>
                    <p> email  <?= $user->email ?></p>
                    <a href="/php_simple/components/users/deleteUser.php?superid=<?=getId($_SESSION['name'])?>&userid=<?= $user->id?>"> delete </a>
                    </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>