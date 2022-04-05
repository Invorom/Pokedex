<?php
    if(isset($_GET['message']) && !empty($_GET['message'])){
        echo '<div><p>' .htmlspecialchars($_GET['message']). '</p></div>';
    }
?>
