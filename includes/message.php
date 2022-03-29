<?php
    if(isset($_GET['message']) && !empty($_GET['message'])){
        echo '<div' .htmlspecialchars($_GET['message']). '</div>';
    }

?>
