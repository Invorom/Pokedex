<?php 
    if(isset($_POST['email']))
    {
        setcookie('email', $_POST["email"], time() + 365*24*3600);
    }
    
    if(empty($_POST['email']) || empty($_POST['password']))
    {
        header('location:connexion.php?message=Veuillez remplir les deux champs.');
        exit;
    }

    include('includes/config.php');
    $salt = 'gaar5eg7896aerg7ae9r7gaerg7a9A7SgaF56rRgR7GaGrG9gG7G8G,;a:9:6:8!e$r$g$7$a$9$e"r#gaergaer8g7ae9r87gaer98ga9e5h8rae7rha96e8rh7a9er8h7';
    $hashed_password = hash('sha512', $salt . $_POST['password']);

    $query = 'SELECT * FROM user WHERE email = :email AND password = :password';
    $prepared_query = $db->prepare($query);
    $prepared_query->execute
    ([
        'email' => $_POST['email'],
        'password' => $hashed_password
    ]);
    $result = $prepared_query->fetchAll();

    if(count($result) == 0)
    {
        header('location:connexion.php?message=Identifiants incorrects.');
        exit;
    }
    
    session_start();
    $_SESSION['email'] = $_POST['email'];
    header('location:index.php');
    exit;
?>
