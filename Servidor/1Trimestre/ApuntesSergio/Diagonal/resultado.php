<?php
    require_once 'suma.php';
    $dPrincipal = [];
    $dSecundaria = [];
    for ($i=$_POST['dim']-1; $i>=0; $i--) {
        /* $dPrincipal = $dPrincipal+ $m[$b][$b];
        $dSecundaria = $dSecundaria + $m[$b][3-$b]; */
        
        array_push($dPrincipal, $_POST[$i.$i]);
        
        array_push($dSecundaria, $_POST[$i.(($_POST['dim']-1)-$i)]);
    }

    
    echo "<h2>La diagonal principal es: </h2> <p>(";
    foreach ($dPrincipal as $principal) {
        echo $principal.", ";
        
    }
    echo ")</p><br>Suma: ".suma($dPrincipal);
    echo "<br><h2>La diagonal secundaria es: </h2><p>(";
    foreach ($dSecundaria as $secundaria) {
        echo $secundaria.", ";
        
    }
    echo ")</p>";
    echo "<br>Suma: ".suma($dSecundaria);

    

    
?>