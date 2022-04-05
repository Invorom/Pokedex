<?php
    $salt = 'gaar5eg7896aerg7ae9r7gaerg7a9A7SgaF56rRgR7GaGrG9gG7G8G,;a:9:6:8!e$r$g$7$a$9$e"r#gaergaer8g7ae9r87gaer98ga9e5h8rae7rha96e8rh7a9er8h7';
    $empreinteSalee = hash('sha512', $salt . $_POST['password']);
?>
