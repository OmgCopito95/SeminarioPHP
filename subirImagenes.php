<?php
$directorio = "imagenes/"; //directorio donde se va a guardar la imagen
$archivo = $directorio . basename($_FILES["pic"]["name"]); //nombre del archivo
$ok = 1;
$tipo_imagen = strtolower(pathinfo($archivo,PATHINFO_EXTENSION)); //se guarda la extension

// Verifica si realmente es una imagen la que se esta subiendo
if(isset($_POST["pic"])) {
    $check = getimagesize($_FILES["archivo"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $ok = 1;
    } else {
        echo "File is not an image.";
        $ok = 0;
    }
}

// Verifica que se suban formatos correctos
if($tipo_imagen != "jpg" && $tipo_imagen != "png" && $tipo_imagen != "jpeg"
&& $tipo_imagen != "gif" ) {
    echo "Solo archivos JPG, JPEG, PNG & GIF están permitidos.";
    $ok = 0;
}

// si la variable ok=0, hubo un error y no se puede cargar la imagen
if ($ok == 0) {
    echo "Su imagen no puede subirse.";
} else {
    if (move_uploaded_file($_FILES["pic"]["tmp_name"], $archivo)) { // guardo archivo en el directorio
    	$imagenSubida = 1;
        //$contents = file_get_contents($archivo);
        $contents = addslashes(file_get_contents($archivo)); // guarda la imagen a subir
        //echo "El arhivo ". basename( $_FILES["pic"]["name"]). "fue subido correctamente.";
        unlink($archivo);
    } else {
        echo "Hubo un problema subiendo la imagen.";
    }
}

?>