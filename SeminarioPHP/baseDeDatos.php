<?php
//phpinfo();

class BaseDeDatos {
	
	var $link;

    function __construct($conn){
    	$this->link = $conn;
        echo "--base de datos creada--";
    }

    function getUser($user){
    	//$query = sprintf("SELECT * FROM usuarios WHERE nombreusuario='%s'",$user); //NO FUNCIONA
    	$query = "SELECT * FROM seminarioPHP.usuarios WHERE nombreusuario='".$user."'"; // FUNCIONA
    	//$query = "SELECT * FROM seminarioPHP.usuarios WHERE nombre='Julieta'"; //FUNCIONA
    	$result = mysqli_query($this->link,$query) or die(mysqli_error($this->link));
    	//echo mysqli_num_rows($result);
    	return mysqli_fetch_array($result); //recupera una fila de resultado como un array

    	/*
    	if (mysqli_num_rows($result) > 0) {
		    // output data of each row
		    while($row = mysqli_fetch_assoc($result)) {
		        echo "id: " . $row["id"]. " - Name: " . $row["nombre"]. " " . $row["apellido"]. "<br>";
		    }
		} else {
		    echo "0 results";
		}

		*/    
    }

    function newUser($nombre, $apellido,$email,$user,$pass){
        $query = "INSERT INTO seminarioPHP.usuarios(apellido,nombre,email,nombreusuario,contrasenia,foto_contenido,foto_tipo)VALUES ('$apellido','$nombre','$email','$user','$pass','','')";
        mysqli_query($this->link,$query) or die(mysqli_error($this->link));
    }

}

?>

