<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr" class="one-page">
  <?php
    $title="Accueil";
    include ('includes/head.php');
  ?>

  <body>
    <?php include ('includes/header.php'); ?>

    <main class="profile">
      <h1>Mon compte</h1>

      <div>
      <h2>Mes infos</h2>
        <?php 
                include('includes/config.php');
                $query = "SELECT * FROM user WHERE id = :id";
                $prepared_query = $db->prepare($query);
                $prepared_query->execute(array('id' => $_SESSION['id']));
                $results = $prepared_query->fetchAll();

                foreach ($results as $key => $value)
                {
                    echo '<p>Pseudo : '.$value['pseudo'].'</p>';
                    echo '<p>Email : '.$value['email'].'</p><br>';
                    echo 'Image de profil : <img src="uploads/'.$value['image'].'" alt="image de profil">';
                }
        ?>
      </div>

      <hr>
      
      <h2>Mes Pokemons</h2>
      <?php 
            $query = "SELECT * FROM pokemon WHERE id_user = :id";
            $prepared_query = $db->prepare($query);
            $prepared_query->execute(array('id' => $_SESSION['id']));
            $results = $prepared_query->fetchAll();
            $count = 0;

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

    </main>

    <?php include ('includes/footer.php'); ?>
  </body>
</html>
