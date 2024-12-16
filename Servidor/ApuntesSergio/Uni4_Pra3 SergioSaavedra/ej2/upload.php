<?php
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $fileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Comprobamos si es una imagen real o falsa
    $check = comprobar($target_file, $fileType);
    if(($check !== false) && move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
    echo "El fichero subido es correcto.";
    $uploadOk = 1;
    } else {
    
    $uploadOk = 0;
    }
    
    // Comprobamos si el fichero ya existe
    function existe($target_file) {
        if (file_exists($target_file)) {
            echo "El fichero ya existe.";
            return false;
        } else {
            return true;
        }
    }
    function tamano() {
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 300000) {
            echo "El fichero es demasiado grande.";
            return false;
        } else {
            return true;
        }
    }
    

    // Permitir solo determinados formatos
    function checkType($fileType) {
        if($fileType != "txt") {
            echo "No es un tipo valido, debe ser un fichero txt.";
            return false;
        } else {
            return true;
        }
    }

    function comprobar($target_file, $fileType) {
        if (existe($target_file) && checkType($fileType) && tamano()) {
            return true;
        } else  {
            return false;
        }
        
    }
?>