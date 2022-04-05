<div class="row cell">
    <div class="little-cell">
        <table>
            <?php 
                echo '<tr><th>' . htmlspecialchars($results[$key]['nom']) . '</th></tr>';
                echo '<tr><td>PV = ' . htmlspecialchars($results[$key]['pv']) . '</td></tr>';
                echo '<tr><td>Attaque = ' . htmlspecialchars($results[$key]['attaque']) . '</td></tr>';
                echo '<tr><td>Défense = ' . htmlspecialchars($results[$key]['defense']) . '</td></tr>';
                echo '<tr><td>Vitesse = ' . htmlspecialchars($results[$key]['vitesse']) . '</td></tr>';
            ?>
        </table>
    </div>
    <div class="little-cell">
        <?php 
            echo '<img class="image-size" src="uploads_pokemon/' . htmlspecialchars($results[$key]['image']) . '" alt="NOT FOUND">';
        ?>
    </div>

</div>
