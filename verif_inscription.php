<?php 
    if(isset($_POST['register_username']))
    {
        setcookie('register_cookie', $_POST["register_username"], time() + 3600);
    }
    
    if (empty($_POST['register_username']) && empty($_POST['register_password']))
    {
        header('location:connexion.php?message=Vous devez remplir les deux champs.');
        exit;
    }

    if (!filter_var($_POST['register_username'], FILTER_VALIDATE_EMAIL))
    {
        header('location:connexion.php?message=Email invalide.');
        exit;
    }
    
    if(strlen($_POST['register_password']) < 6)
    {
        header('location:connexion.php?message=Votre mot de passe doit faire au moins 6 caractères.');
        exit;
    }

    include('includes/config.php');

    $query = 'SELECT id FROM user WHERE email = ?';
    $prepared_query = $db->prepare($query);
    $prepared_query->execute([$_POST['register_username']]);
    $result = $prepared_query->fetchAll();

    if(count($result) != 0)
    {
        header('location:connexion.php?message=Adresse email déjà utilisée.');
        exit;
    }

    if($_FILES['image']['error'] != 4)
    {
        $acceptable = ['image/jpeg', 'image/png', 'image/gif'];

        if(!in_array($_FILES['image']['type'], $acceptable)){
            header('location:connexion.php?message=Veuillez utiliser une image au format jpeg, png ou gif.');
            exit;
        }

        $maxSize = 2*1024*1024;
        if($_FILES['image']['size'] > $maxSize)
        {
            header('location:connexion.php?message=Fichier image trop lourd (2 Mo max).');
            exit;
        }

        $uploadsPath = 'uploads';

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



    $salt = 'gaar5eg7896aerg7ae9r7gaerg7a9A7SgaF56rRgR7GaGrG9gG7G8G,;a:9:6:8!e$r$g$7$a$9$e"r#gaergaer8g7ae9r87gaer98ga9e5h8rae7rha96e8rh7a9er8h7';
    $hashed_password = hash('sha512', $salt . $_POST['register_password']);


    $query = 'INSERT INTO user (email, password, image) VALUES (:email, :password, :image)';
    $prepared_query = $db->prepare($query);
    $result = $prepared_query->execute
    ([   
        'email' => $_POST['register_username'], 
        'password' => $hashed_password,
        'image' => isset($filename) ? $filename: ''
    ]);

    
    if($result)
    {
        header('location:connexion.php?message=Compte créé avec succès !');
        exit;
    }

    header('location:connexion.php?message=Erreur lors de l\'inscription');
    exit;
?>
