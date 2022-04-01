<?php
    try
    {
        $bdd = new PDO('mysql:host=localhost:8889;dbname=pokedex', 'root', 'root', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    }
    catch(Exception $e)
    {  
        die('Erreur : ' . $e->getMessage());
    }
?>
