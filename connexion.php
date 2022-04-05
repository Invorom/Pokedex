<!Doctype html>
<html>
    <?php
        $title = "Connexion";
        include('includes/head.php');
    ?>
    <body>
    <?php include('includes/header.php');?>
    <main>
        <?php include('includes/message.php'); ?>
        <form action="verif_connexion.php" method="POST">
             <h1>Connexion</h1>
             <input type="email" name="email" value="<?php echo isset($_COOKIE['email']) ? $_COOKIE['email'] : '';?>" placeholder="E-mail">
             <br>
             <input type="password" name="password" value="" placeholder="Mot de passe">
             <input type="submit" value="Connexion">
        </form>

        <form action="verif_inscription.php" method="POST" enctype="multipart/form-data">
            <h1>Inscription</h1>
            <input type="text" name="register_username" value="<?php echo isset($_COOKIE['username']) ? $_COOKIE['username'] : '';?>" placeholder="Pseudo" required>
            <input type="email" name="register_email" value="<?php echo isset($_COOKIE['email']) ? $_COOKIE['email'] : '';?>" placeholder="E-mail" required>
            <input type="password" name="register_password" value="" placeholder="Mot de passe" required>
            <input type="file" name="image" accept="image/gif, image/png, image/jpeg" required>
            <input type="submit" value="S'inscrire">
        </form>
    </main>
    <?php include('includes/footer.php');?>
    </body>
</html>
