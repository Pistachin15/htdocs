<?php
// Asegurarse de que se haya enviado el formulario
if (isset($_POST['submit']) && isset($_FILES['filesToUpload'])) {
    // Obtener las imágenes subidas
    $files = $_FILES['filesToUpload'];

    // Verificar que haya 10 imágenes
    if (count($files['name']) != 10) {
        echo "Por favor selecciona exactamente 10 imágenes.";
        exit;
    }

    // Crear un arreglo para almacenar las rutas de las imágenes subidas
    $uploadedImages = [];

    // Procesar cada imagen
    for ($i = 0; $i < 10; $i++) {
        $target_dir = "uploads/";  // Directorio donde se guardarán las imágenes
        $target_file = $target_dir . basename($files['name'][$i]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Verificar si el archivo es una imagen válida
        $check = getimagesize($files["tmp_name"][$i]);
        if ($check === false) {
            echo "El archivo " . basename($files['name'][$i]) . " no es una imagen válida.";
            exit;
        }

        // Subir la imagen
        if (move_uploaded_file($files["tmp_name"][$i], $target_file)) {
            $uploadedImages[] = $target_file;
        } else {
            echo "Hubo un error al subir la imagen " . basename($files['name'][$i]);
            exit;
        }
    }

    // Organizar las imágenes para crear la pirámide simétrica
    $levels = [
        // El primer nivel tiene una imagen en el centro
        [$uploadedImages[0]],
        // El segundo nivel tiene dos imágenes (izquierda y derecha)
        [$uploadedImages[1], $uploadedImages[2]],
        // El tercer nivel tiene tres imágenes
        [$uploadedImages[3], $uploadedImages[4], $uploadedImages[5]],
        // El cuarto nivel tiene cuatro imágenes
        [$uploadedImages[6], $uploadedImages[7], $uploadedImages[8], $uploadedImages[9]],
    ];

    // Crear el árbol navideño simétrico
    echo "<div style='text-align:center;'>";

    foreach ($levels as $level) {
        // Agregar cada nivel de la pirámide
        echo "<div style='display: flex; justify-content: center;'>";
        // El número de imágenes en cada nivel será diferente
        foreach ($level as $index) {
            echo "<img src='" . $index . "' style='width: 100px; margin: 0 10px;'>";
        }
        echo "</div>";
    }

    // Agregar un tronco al árbol
    echo "<div style='display: flex; justify-content: center;'>";
    echo "<div style='width: 40px; height: 50px; background-color: brown; margin-top: 20px;'></div>";
    echo "</div>";

    echo "</div>";
} else {
    echo "Por favor selecciona 10 imágenes y envíalas.";
}
?>
