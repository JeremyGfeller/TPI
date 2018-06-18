<?php $title = 'Créer un utilisateur'; ?>

<?php ob_start(); ?>

<form method='post'>
        <div class='col-lg-12 text-center'>
                Prénom <input type='text' name='firstname' style='margin-top: 10px;' required/><br>
                Nom <input type='text' name='lastname' style='margin-top: 10px;' required/><br>
                Login <input type='text' name='login' style='margin-top: 10px;' required/><br>
                Mot de passe <input type='text' name='password' style='margin-top: 10px;' required/>
        </div>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
