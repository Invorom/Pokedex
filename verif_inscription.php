<?php 
    if(isset($_POST['register_username']))
    {
        setcookie('register_cookie', $_POST["register_username"], time() + 3600);
    }
    
    if(empty($_POST['register_username']) && empty($_POST['register_password']))
    {
        header('location:connexion.php?message=Vous devez remplir les deux champs');
        exit;
    }

    if(!filter_var($_POST['register_username'], FILTER_VALIDATE_EMAIL) || empty($_POST['register_username']))
    {
        header('location:connexion.php?message=Email invalide');
        exit;
    }
    
    if(strlen($_POST['register_password']) < 6 || strlen($_POST['register_password']) > 12)
    {
        header('location:connexion.php?message=Mot de passse incorrect');
        exit;
    }

    include('includes/db.php');

    $q = 'SELECT id FROM user WHERE email = ?';
    $req = $bdd->prepare($q);
    $req->execute([$_POST['register_username']]);
    $result = $req->fetchAll();

    if(count($result) != 0)
    {
        header('location:connexion.php?message= Email déjà utilisé');
        exit;
    }

    if($_FILES['image']['error'] != 4)
    {
        $acceptable = [
                        'image/jpeg',
                        'image/png',
                        'image/gif'
                        ];

        if(!in_array($_FILES['image']['type'], $acceptable)){
            header('location:connexion.php?message=Type de fichier incorrect');
            exit;
        }

        $maxSize = 2*1024*1024;
        if($_FILES['image']['size'] > $maxSize)
        {
            header('location:connexion.php?message=Fichier trop lourd (2Mo max)');
            exit;
        }

        $uploadsPath = 'uploads';

        if(!file_exists($uploadsPath))
        {
            mkdir($uploadsPath, 0777);
        }

        $filename = $_FILES['image']['name'];

        //Renommage pour éviter les doublons
        $array = explode('.', $filename);
        $ext = end($array);
        $filename = 'image-' . time() . '.' .$ext;

        $destination = $uploadsPath . '/' . $filename;
        move_uploaded_file($_FILES['image']['tmp_name'], $destination);
    }



    $salt = 'gaar5eg7896aerg7ae9r7gaerg7a9A7SgaF56rRgR7GaGrG9gG7G8G,;a:9:6:8!e$r$g$7$a$9$e"r#gaergaer8g7ae9r87gaer98ga9e5h8rae7rha96e8rh7a9er8h7';
    $empreinteSalee = hash('sha512', $salt . $_POST['register_password']);


    $q = 'INSERT INTO user (email, password, image) VALUES (:email, :password, :image)';
    $req = $bdd->prepare($q);
    $result = $req->execute([   'email' => $_POST['register_username'], 
                                'password' => $empreinteSalee,
                                'image' => isset($filename) ? $filename: ''
                            ]);

    
    if($result)
    {
        header('location:connexion.php?message= Compte créé avec succès !');
        exit;
    }
    else
    {
        header('location:connexion.php?message= Erreur lors de l\'inscription');
        exit;
    }
?>
