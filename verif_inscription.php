<?php 
    if(isset($_POST['register_username']))
    {
        setcookie('username', $_POST["register_username"], time() + 3600);
    }
    if(isset($_POST['register_email']))
    {
        setcookie('email', $_POST["register_email"], time() + 3600);
    }
    
    if (empty($_POST['register_username']) || empty($_POST['register_email']) || empty($_POST['register_password']))
    {
        header('location:connexion.php?message=Vous devez remplir les deux champs.');
        exit();
    }

    if (!filter_var($_POST['register_email'], FILTER_VALIDATE_EMAIL))
    {
        header('location:connexion.php?message=Email invalide.');
        exit();
    }
    
    // Store booleans for each password requirement
    $uppercase = preg_match('@[A-Z]@', $_POST['register_password']);
    $lowercase = preg_match('@[a-z]@', $_POST['register_password']);
    $number = preg_match('@[0-9]@', $_POST['register_password']);
    $specialChars = preg_match('@[^\w]@', $_POST['register_password']);
    $length = strlen($_POST['register_password']) > 8;

    if (!($uppercase && $lowercase && $number && $specialChars && $length))
    {
        header('location:connexion.php?message=Mot de passe invalide.');
        exit();
    }

    include('includes/config.php');

    $query = 'SELECT id FROM user WHERE email = ?';
    $prepared_query = $db->prepare($query);
    $prepared_query->execute([$_POST['register_email']]);
    $result = $prepared_query->fetchAll();

    if (count($result) != 0)
    {
        header('location:connexion.php?message=Adresse email déjà utilisée.');
        exit();
    }

    // Add profile picture to uploads folder
    if ($_FILES['image']['error'] != 4)
    {
        $maxSize = 2*1024*1024;
        $uploadsPath = 'uploads';
        $fileName = $_FILES['image']['name'];
        $fileTmpName = $_FILES['image']['tmp_name'];
        $fileSize = $_FILES['image']['size'];
        $fileError = $_FILES['image']['error'];
        $fileType = $_FILES['image']['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png', 'gif');

        if (in_array($fileActualExt, $allowed))
        {
            if ($fileError === 0)
            {
                if ($fileSize < $maxSize)
                {
                    $fileNameNew = uniqid('', true).".".$fileActualExt;
                    $fileDestination = $uploadsPath.'/'.$fileNameNew;

                    $salt = 'gaar5eg7896aerg7ae9r7gaerg7a9A7SgaF56rRgR7GaGrG9gG7G8G,;a:9:6:8!e$r$g$7$a$9$e"r#gaergaer8g7ae9r87gaer98ga9e5h8rae7rha96e8rh7a9er8h7';
                    $hashed_password = hash('sha512', $salt . $_POST['register_password']);


                    $query = 'INSERT INTO user (pseudo, email, password, image) VALUES (:username, :email, :password, :image)';
                    $prepared_query = $db->prepare($query);
                    $result = $prepared_query->execute
                    ([   
                        'username' => $_POST['register_username'],
                        'email' => $_POST['register_email'], 
                        'password' => $hashed_password,
                        'image' => $fileNameNew
                    ]);

                    if($result)
                    {
                        move_uploaded_file($fileTmpName, $fileDestination);
                        header('location:connexion.php?message=Compte créé avec succès !');
                        exit();
                    }
                }
                else
                {
                    header('location:connexion.php?message=Fichier image trop lourd (2 Mo max).');
                    exit();
                }
            }
            else
            {
                header('location:connexion.php?message=Erreur lors de l\'upload de l\'image.');
                exit();
            }
        }
        else
        {
            header('location:connexion.php?message=Veuillez utiliser une image au format jpeg, png ou gif.');
            exit();
        }
    }

    header('location:connexion.php?message=Erreur lors de l\'inscription. Veuillez réessayer ultérieurement.');
    exit();
?>
