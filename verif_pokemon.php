<?php
    if (empty($_POST['register_username']) && empty($_POST['register_password']))
    {
        header('location:connexion.php?message=Vous devez remplir les deux champs.');
        exit;
    }
?>
