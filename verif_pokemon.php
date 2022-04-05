<?php
    $name = $_POST['nom'];
    $pv = $_POST['pv'];
    $attack = $_POST['attaque'];
    $defense = $_POST['défense'];
    $speed = $_POST['vitesse'];

    if (empty($name) || empty($pv) || empty($attack) || empty($defense) || empty($speed)) {
        header('Location: add_pokemon.php?message=Veuillez remplir tous les champs');
        exit();
    }

    // Image processing
    if($_FILES['image']['error'] != 4)
    {
        $acceptable = ['image/jpeg', 'image/png', 'image/gif'];

        if(!in_array($_FILES['image']['type'], $acceptable)){
            header('location:connexion.php?message=Veuillez utiliser une image au format jpeg, png ou gif.');
            exit();
        }

        $maxSize = 2*1024*1024;
        if($_FILES['image']['size'] > $maxSize)
        {
            header('location:connexion.php?message=Fichier image trop lourd (2 Mo max).');
            exit();
        }

        $uploadsPath = 'uploads_pokemon';

        if(!file_exists($uploadsPath))
        {
            mkdir($uploadsPath, 0777);
        }

        $filename = $_FILES['image']['name'];

        // Renommage pour éviter les doublons
        $array = explode('.', $filename);
        $ext = end($array);
        $filename = 'image-' . time() . '.' .$ext;

        $destination = $uploadsPath . '/' . $filename;
        move_uploaded_file($_FILES['image']['tmp_name'], $destination);
    }
?>
