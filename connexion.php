<!Doctype html>
<html>
    <?php
        $title = "Connexion";
        include('includes/head.php');
    ?>
    <body>
    <?php include('includes/header.php');?>
    <main>
        <h1 style="margin-bottom: 30px">Connexion</h1>
        <?php include('includes/message.php'); ?>
        <div class="connexion-forms">
            <form class="left connexion-form" action="verif_connexion.php" method="POST">
                <h2>Je possède un compte</h2>
                <input class="input-field" type="email" name="email" value="<?php echo isset($_COOKIE['email']) ? $_COOKIE['email'] : '';?>" placeholder="E-mail">
                <br>
                <input class="input-field" type="password" name="password" value="" placeholder="Mot de passe">
                <input class="submit-btn" type="submit" value="Connexion">
            </form>

            <form class="right connexion-form" action="verif_inscription.php" method="POST" enctype="multipart/form-data">
                <h2>Je crée un compte</h2>
                <input class="input-field" type="text" name="register_username" value="<?php echo isset($_COOKIE['username']) ? $_COOKIE['username'] : '';?>" placeholder="Pseudo" required>
                <input class="input-field" type="email" name="register_email" value="<?php echo isset($_COOKIE['email']) ? $_COOKIE['email'] : '';?>" placeholder="E-mail" required>
                <input class="input-field" type="password" name="register_password" value="" placeholder="Mot de passe" required>
                <div>
                    <label for="image">Image de profile : </label>
                    <input type="file" name="image" accept="image/gif, image/png, image/jpeg" required>
                </div>
                <input class="submit-btn" type="submit" value="S'inscrire">
            </form>
        <div>
    </main>
    <?php include('includes/footer.php');?>
    </body>
</html>
