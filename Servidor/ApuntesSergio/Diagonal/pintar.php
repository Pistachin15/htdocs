<?php
    
    echo "<form action='resultado.php' method='post'>";
    for ($i=0; $i<$_POST['dim']; $i++) {
        
        for ($j=0; $j<$_POST['dim']; $j++) {
            
            echo "<label for='$i$j'>($i,$j)</label>  <input type='number' name='$i$j'  required>";
        }
        echo "<br><br>";
    }
    $dim = $_POST['dim'];
    echo "<input type='submit' value='Enviar'> <input type='hidden' id='dim' name='dim' value='$dim'>";
    echo "</form>";
?>