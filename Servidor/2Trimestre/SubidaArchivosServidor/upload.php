<?php
$target_dir = "uploads/"; // Indica el directorio donde se coloca el archivo
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]); // Especifica la ruta del archivo cargado
$uploadOk = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION); // Convierte la extensión a minúsculas

// Comprobamos que el archivo es un fichero txt
echo "<br>";
if ($imageFileType != "txt") {
    echo "Lo sentimos, solo se permiten archivos con extensión TXT.";
    $uploadOk = 0;
}

// Comprobamos el tamaño del archivo en bytes (300 KB como límite)
if ($_FILES["fileToUpload"]["size"] > 300000) {
    echo "<br>El archivo es demasiado grande. El límite es 300 KB.";
    $uploadOk = 0;
}

echo "<br>";

// Comprobamos si el fichero ya existe
if (file_exists($target_file)) {
    echo "El archivo ya existe. Cambia el nombre del archivo y vuelve a intentarlo.";
    $uploadOk = 0;
}

// Si todo está bien, intentamos subir el archivo
if ($uploadOk == 0) {
    echo "<br>El archivo no se ha subido debido a los errores anteriores.";
} else {
    // Subimos el archivo al directorio 'uploads'
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "<br>El archivo " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " ha sido subido correctamente.";
    } else {
        echo "<br>Hubo un error al intentar subir el archivo.";
    }
}
?>
