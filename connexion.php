<!Doctype html>
<html>
    <?php
        $title = "Connexion";
        include('includes/head.php');
    ?>
    <body>
    <?php include('includes/header.php');?>
    <main>
        <form action="verification.php" method="POST">
             <h1>Connexion</h1>
             <input type="email" name="username" value="<?php echo isset($_COOKIE['cookie_username']) ? $_COOKIE['cookie_username'] : '';?>" placeholder="Username">
             <br>
             <input type="password" name="password" value="" placeholder="password">
             <input type="submit" name="connexion" value="Connexion">
        </form>
        <form action="verification_inscription.php" method="POST" enctype="multipart/form-data">
            <h1>Inscription</h1>
            <div class="mb-3">
                <label class="form-label">Votre email</label>
                <input class="form-control" type="email" name="register_username" value="<?php echo isset($_COOKIE['register_cookie']) ? $_COOKIE['register_cookie'] : '';?>" placeholder="Username" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Votre email</label>
                <input class="form-control" type="password" name="register_password" value="" placeholder="password" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Votre image de profile</label>
                <input class="form-control" type="file" name="image" accept="image/gif, image/png, image/jpeg">
            </div>
            <input class="btn btn-primary" name="register_connexion" value="S'inscrire">
        </form>
    </main>
    <?php include('includes/Footer.php');?>
    </body>
</html>
