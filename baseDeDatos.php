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
		$resultado = mysqli_fetch_array($result);
		// mysqli_close($link);
    	return $resultado;
    }

    function newUser($nombre, $apellido,$email,$user,$pass,$imagen,$tipo_imagen){
        $query = "INSERT INTO usuarios(apellido,nombre,email,nombreusuario,contrasenia,foto_contenido,foto_tipo) VALUES ('$apellido','$nombre','$email','$user','$pass','$imagen','tipo_imagen')";
        mysqli_query($this->link,$query) or die(mysqli_error($this->link));
        mysqli_close($link);
	}

	function editUser($datos, $user){
		$query = "UPDATE usuarios SET ";
		$i = 0;
		foreach ($datos as $key => $value) {
			$query = $query.$key." = '".$value."'";
			$i++;
			if ($i < sizeof($datos)) {
				$query = $query.", ";
			}
		}
		$query = $query." WHERE nombreusuario = '$user'";
		mysqli_query($this->link,$query) or die(mysqli_error($this->link));
        // mysqli_close($link);
	}
	
	function checkPassword($password, $user){
		$query = "SELECT contrasenia FROM usuarios WHERE nombreusuario='".$user."'";
		$result = mysqli_query($this->link,$query) or die(mysqli_error($this->link));
		if ($password == mysqli_fetch_array($result)[0]){
			// mysqli_close($link);
			return true;
		} else {
			mysqli_close($link);
			return false;
		}
	}

}

?>