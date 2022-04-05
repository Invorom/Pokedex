<?php 
    if(isset($_POST['username']))
    {
        setcookie('cookie_username', $_POST["username"], time() + 365*24*3600);
    }
    
    if(empty($_POST['username']) && empty($_POST['password']))
    {
        header('location:connexion.php?message=Vous devez remplir les deux champs');
        exit;
    }

    include('includes/db.php');
    include('includes/salt.php');
    $q = 'SELECT * FROM user WHERE email = :email AND password = :password';
    $req = $bdd->prepare($q);
    $req->execute
    ([
        'email' => $_POST['email'],
        'password' => $empreinteSalee
    ]);
    $result = $req->fetchAll();
    if(count($result) == 0)
    {
        header('location:connexion.php?message=Identifiants incorrects');
        exit;
    }
    
    session_start();
    $_SESSION['email'] = $_POST['email'];
    header('location:index.php');
    exit;
    
?>
