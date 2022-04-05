<?php
    session_start();

    $name = $_POST['nom'];
    $pv = $_POST['pv'];
    $attack = $_POST['attaque'];
    $defense = $_POST['défense'];
    $speed = $_POST['vitesse'];

    // Check if all input fields are filled
    if (empty($name) || empty($pv) || empty($attack) || empty($defense) || empty($speed))
    {
        header('location:add_pokemon.php?message=Veuillez remplir tous les champs');
        exit();
    }

    include('includes/config.php');
    
    // Check if name is not already used
    $query = 'SELECT nom FROM pokemon WHERE nom=:name';
    $prepared_query = $db->prepare($query);
    $prepared_query->execute(["name" => $name]);
    $result = $prepared_query->fetchAll();

    if(count($result) != 0)
    {
        header('location:add_pokemon.php?message=Nom de Pokemon déjà utilisé.');
        exit();
    }

    // Check if pv is a number
    if (!is_numeric($pv))
    {
        header('location:add_pokemon.php?message=PV doit être un nombre.');
        exit();
    }

    // Check if attack is a number
    if (!is_numeric($attack))
    {
        header('location:add_pokemon.php?message=Attaque doit être un nombre.');
        exit();
    }

    // Check if defense is a number
    if (!is_numeric($defense))
    {
        header('location:add_pokemon.php?message=Défense doit être un nombre.');
        exit();
    }
    
    // Check if speed is a number
    if (!is_numeric($speed))
    {
        header('location:add_pokemon.php?message=Vitesse doit être un nombre.');
        exit();
    }

    // Check if image is valid
    if ($_FILES['image']['error'] != 4)
    {
        $acceptable = array('image/jpeg', 'image/png', 'image/gif');

        if (!in_array($_FILES['image']['type'], $acceptable)){
            header('location:add_pokemon.php?message=Veuillez utiliser une image au format jpeg, png ou gif.');
            exit();
        }

        $maxSize = 2*1024*1024;
        if ($_FILES['image']['size'] > $maxSize)
        {
            header('location:add_pokemon.php?message=Fichier image trop lourd (2 Mo max).');
            exit();
        }
    }

    // Add pokemon to database
    $query = 'INSERT INTO pokemon (nom, pv, attaque, defense, vitesse, image, id_user) VALUES (:name, :pv, :attack, :defense, :speed, :image, :id_user)';
    $prepared_query = $db->prepare($query);
    $result = $prepared_query->execute
    ([
        "name" => $name,
        "pv" => $pv,
        "attack" => $attack,
        "defense" => $defense,
        "speed" => $speed,
        "image" => $_FILES['image']['name'],
        "id_user" => $_SESSION['id']
    ]);

    if ($result)
    {
        // Add Pokemon image
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

        header('location:add_pokemon.php?message=Pokemon ajouté avec succès.');
        exit();
    }

    header('location:add_pokemon.php?message=Erreur lors de l\'ajout du Pokemon. Veuillez réessayer ultérieurement.');
    exit();
?>
