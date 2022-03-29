<header>
    <div class="container div-header">
        <img class="logo" src="images/logo.png" alt="Logo site pokedex" class="logo">
        <nav>
            <ul class="display-row">
                <li>
                    <a href="index.php" title="Aller sur la page d'accueil">Accueil</a>
                </li>
                <li>
                    <a href="collection.php" title="Aller sur la page de collection">Collection</a>
                </li>
            
                <?php
                    if (isset($_SESSION['email'])){
                        echo '<li><a href="deconnexion.php" title="Se déconnecter">Déconnexion</a></li>';
                        echo '<li><a href="profile.php" title="Aller sur la page de profile">Mon Compte</a></li>';
                    } else {
                        echo '<li><a href="connexion.php" title="Connexion">Connexion</a></li>';
                    }

                ?>
            </ul>

        </nav>
    </div>

</header>
