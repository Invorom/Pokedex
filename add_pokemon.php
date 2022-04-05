<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr" class="one-page">
  <?php
    $title="Accueil";
    include ('includes/head.php');
  ?>

  <body>
    <?php include ('includes/header.php'); ?>

    <main>
      <h1>Ajouter un Pokemon</h1>

      <?php include('includes/message.php'); ?>

      <form class="add-pokemon" action="verif_pokemon.php" method="POST" enctype="multipart/form-data">
        <input class="input-field" type="text" name="nom" placeholder="Nom">
        <input class="input-field" type="text" name="pv" placeholder="PV">
        <input class="input-field" type="text" name="attaque" placeholder="Attaque">
        <input class="input-field" type="text" name="défense" placeholder="Défense">
        <input class="input-field" type="text" name="vitesse" placeholder="Vitesse">
        <div>
            <label for="image">Image : </label>
            <input type="file" name="image" accept="image/gif, image/png, image/jpeg">
        </div>
        <input class="submit-btn" type="submit" value="Ajouter">
      </form>
    </main>

    <?php include ('includes/footer.php'); ?>
  </body>
</html>
