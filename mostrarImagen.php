<?php
    //session_start();  

    include ("BD.php");
    include ("baseDeDatos.php");

        $id = $_GET['id']; 
        $view = $_GET['view'];
        // se recupera la información de la imagen

        $bd = new BaseDeDatos($conn);

        if ($view == '0') {
            $result = $bd ->mostrarImagenMensaje($id); 
        }else{
            $result = $bd ->mostrarImagenUsuario($id); 
        }
        

        //print_r ($result);

        // se imprime la imagen y se le avisa al navegador que lo que se está 
        // enviando no es texto, sino que es una imagen de un tipo en particular
        header("Content-Type: image/" . $result[1]); 
        //header("Content-Type: image/jpg"); 
        
        echo $result[0]; 
    ?>