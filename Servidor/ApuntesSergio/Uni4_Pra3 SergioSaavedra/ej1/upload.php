<?php
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Comprobamos si es una imagen real o falsa
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false  && move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
    echo "El fichero es una imagen - " . $check["mime"] . ".";
    $uploadOk = 1;
    } else {
    echo "El fichero no es una imagen.";
    $uploadOk = 0;
    }
    
    // Comprobamos si el fichero ya existe
    if (file_exists($target_file)) {
        echo "El fichero existe.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "El fichero es demasiado grande.";
        $uploadOk = 0;
    }

    // Permitir solo determinados formatos
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
?>