<?php
/*
Genera una matriz de 4*4 de forma aleatoria con números enteros desordenados
mostrar en un renglón los elementos almacenados en la diagonal principal y en el
siguiente los de la diagonal secundaria
*/
$MatrizAleatoria = [];
$diagonalPrincipal = [];
$diagonalSecundaria = [];

for ($i = 0; $i < 4; $i++){
    for ($j = 0; $j < 4; $j++){
        $MatrizAleatoria[$i][$j] = rand(1, 100);
    }
} 

for ($i = 0; $i < 4; $i++){
    for ($j = 0; $j < 4; $j++){
        
        if($i == $j){
            $diagonalPrincipal[] = $MatrizAleatoria[$i][$j]; 
            $diagonalSecundaria[] = $MatrizAleatoria[$i][3-$i];
        }

    }
}
print_r ($diagonalPrincipal);
echo "<br>";
print_r ($diagonalSecundaria);
?>