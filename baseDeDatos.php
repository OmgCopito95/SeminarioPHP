<?php
//phpinfo();

class BaseDeDatos {
	
	var $link;

    function __construct($conn){
    	$this->link = $conn;
    }

    function getUser($user){
    	$query = "SELECT * FROM usuarios WHERE nombreusuario='".$user."'";
		$result = mysqli_query($this->link,$query) or die(mysqli_error($this->link));
		//recupera una fila de resultado como un array
    	return mysqli_fetch_array($result);
    }

    function newUser($nombre, $apellido,$email,$user,$pass){
        $query = "INSERT INTO usuarios(apellido,nombre,email,nombreusuario,contrasenia,foto_contenido,foto_tipo) VALUES ('$apellido','$nombre','$email','$user','$pass','','')";
        mysqli_query($this->link,$query) or die(mysqli_error($this->link));
	}
	
	function checkPassword($password, $user){
		$query = "SELECT contrasenia FROM usuarios WHERE nombreusuario='".$user."'";
		$result = mysqli_query($this->link,$query) or die(mysqli_error($this->link));
		if ($password == mysqli_fetch_array($result)[0]){
			return true;
		} else {
			return false;
		}
	}

}

?>