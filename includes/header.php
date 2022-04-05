<header>
    <img class="logo" src="images/logo.png" alt="Logo site pokedex" class="logo">
    <nav>
        <ul>
            <li>
                <a href="index.php" title="Aller sur la page d'accueil">Accueil</a>
            </li>
            <li>
                <a href="collection.php" title="Aller sur la page de collection">Collection</a>
            </li>
        
            <?php
                if (isset($_SESSION['email']))
                {
                    echo '<li><a href="add_pokemon.php" title="Ajouter un Pokemon au Pokedex">Ajouter un Pokemon</a></li>';
                    echo '<li><a href="profile.php" title="Consulter mon profil">Mon Compte</a></li>';
                    echo '<li><a href="deconnexion.php" title="Se déconnecter">Déconnexion</a></li>';
                }
                else
                    echo '<li><a href="connexion.php" title="Connexion">Connexion</a></li>';
            ?>
        </ul>
    </nav>
</header>
