<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
    
<?php
$title="Collection";
include ('includes/head.php');
?>

<body>
    <?php include ('includes/header.php'); ?>

    <main>
        <h1 class="center">TOUS LES POKEMONS</h1>
        <div class="display-pok">
        <?php

            include('includes/db.php');
            
            $q = 'SELECT nom,pv,attaque,defense,vitesse,image FROM pokemon;';
            $req = $bdd->prepare($q);
            $req->execute();
            $results = $req->fetchAll();
            $count = 0;

            //var_dump($results);
            echo '<div class="row">';
            foreach ($results as $key => $value){
                include('includes/pokemon_display.php');
                if($count%3 == 2){
                    echo '</div><div class="row">';
                }
                $count +=1;
            }
            echo '</div>';
        
        ?>
        </div>
    </main>

    <?php include ('includes/footer.php'); ?>
    
</body>
</html>
