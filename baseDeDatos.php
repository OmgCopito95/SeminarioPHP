<?php
//phpinfo();

class BaseDeDatos {
	
	var $link;

    function __construct($conn){
    	$this->link = $conn;
    }

    function getUser($user){ // recibe el nombre de usuario
    	$query = "SELECT * FROM usuarios WHERE nombreusuario='".$user."'";
		$result = mysqli_query($this->link,$query) or die(mysqli_error($this->link));
		//recupera una fila de resultado como un array
		$resultado = mysqli_fetch_array($result);
		// mysqli_close($link);
    	return $resultado;
    }

     function getUserByID($id){ // recibe el id de usuario
    	$query = "SELECT * FROM usuarios WHERE id='".$id."'";
		$result = mysqli_query($this->link,$query) or die(mysqli_error($this->link));
		//recupera una fila de resultado como un array
		$resultado = mysqli_fetch_array($result);
		// mysqli_close($link);
    	return $resultado;
    }

    function newUser($nombre, $apellido,$email,$user,$pass,$imagen,$tipo_imagen){
        $query = "INSERT INTO usuarios(apellido,nombre,email,nombreusuario,contrasenia,foto_contenido,foto_tipo) VALUES ('$apellido','$nombre','$email','$user','$pass','$imagen','$tipo_imagen')";
        mysqli_query($this->link,$query) or die(mysqli_error($this->link));
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
	
	function search($buscar) {
		$query = "SELECT id, nombre, apellido, email, nombreusuario
				FROM usuarios WHERE (nombreusuario LIKE '%".$buscar."%')
				OR (nombre LIKE '%".$buscar."%') OR (apellido LIKE '%".$buscar."%')";

		$result = mysqli_query($this->link,$query) or die(mysqli_error($this->link));
		//recupera todas las filas de resultados como un array de arrays
		$resultado = mysqli_fetch_all($result);
		// mysqli_close($link);
		// for ($i=0; $i < sizeof($resultado) ; $i++) { 
		// 	for ($j=0; $j < sizeof($resultado[$i]); $j++) { 
		// 		echo $resultado[$i][$j]." - ";
		// 	}
		// 	echo " /////// ";
		// }
    	return $resultado;
	}

	function publicarMensaje($mensaje, $userID, $imagen, $tipo_imagen){
        //$mysqltime = date("Y-m-d H:i:s");
        //echo $mysqltime;
        $query = "INSERT INTO mensaje (texto,imagen_contenido,imagen_tipo,usuarios_id,fechayhora)VALUES('$mensaje', '$imagen','$tipo_imagen',$userID,'')";
        mysqli_query($this->link,$query) or die(mysqli_error($this->link));
    }

    function mostrarImagen($id){
    	$query = "SELECT foto_contenido, foto_tipo FROM usuarios WHERE id='".$id."'"; 

		$result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		$result = mysqli_fetch_array($result); 
		return $result;
    }

    function getMensajesSeguidores($id){ // devuelve los ultimos 10 mensajes publicados por los seguidores
    	$query = "SELECT msj.* from `siguiendo` as sig INNER join `mensaje` as msj on msj.usuarios_id = sig.usuarioseguido_id INNER JOIN `usuarios`as us on us.id=sig.usuarios_id WHERE us.id=$id ORDER by id desc limit 10";


		$result = mysqli_query($this->link,$query) or die(mysqli_error($this->link));
		$resultado = mysqli_fetch_all($result); // me guardo los mensajes con todas sus filas
    	return $resultado;
    }

    function getMensajesByID($id){ // devuelve los ultimos 10 mensajes publicados por el usuario
    	$query = "SELECT * FROM mensaje WHERE usuarios_id=$id ORDER BY id DESC limit 10";
		$result = mysqli_query($this->link,$query) or die(mysqli_error($this->link));
		$resultado = mysqli_fetch_all($result); // me guardo los mensajes con todas sus filas
    	return $resultado;
    }

    function eliminarMensaje($idUsuario, $idMensaje){
    	$query = "DELETE FROM mensaje WHERE usuarios_id=$idUsuario AND id=$idMensaje";
		$result = mysqli_query($this->link,$query) or die(mysqli_error($this->link));		
    }

    function getSeguidos($id){
    	$query = "SELECT us.* from  `usuarios` as us INNER JOIN  `siguiendo` as sig on us.id = sig.usuarioseguido_id where sig.usuarios_id = $id";
		$result = mysqli_query($this->link,$query) or die(mysqli_error($this->link));
		$resultado = mysqli_fetch_all($result); // me guardo los datos de los usuarios con todas sus filas
    	return $resultado;
    }

    function getCantidadMGxMensaje($idMensaje){
    	$query = "SELECT count(mensaje_id) from me_gusta where mensaje_id=$idMensaje";
    	$result = mysqli_query($this->link,$query) or die(mysqli_error($this->link)); 
    	$result = mysqli_fetch_array($result); 
		return $result;
    }

    function diMg($idMensaje,$idUsuario){
    	$query = "SELECT count(*) FROM `me_gusta` WHERE usuarios_id=$idUsuario and mensaje_id=$idMensaje";
    	$result = mysqli_query($this->link,$query) or die(mysqli_error($this->link)); 
    	$result = mysqli_fetch_array($result); 
		return $result;
    }
}

?>