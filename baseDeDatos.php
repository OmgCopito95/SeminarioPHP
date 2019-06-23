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
			throw new Exception('Contraseña o usuario incorrectos.');
			return false;
		}
	}
	
	function search($buscar) {
		$query = "SELECT id, nombre, apellido, email, nombreusuario
				FROM usuarios WHERE (nombreusuario != '". $_SESSION["usuario"] ."') AND ((nombreusuario LIKE '%".$buscar."%')
				OR (nombre LIKE '%".$buscar."%') OR (apellido LIKE '%".$buscar."%'))";

		$result = mysqli_query($this->link,$query) or die(mysqli_error($this->link));
		//recupera todas las filas de resultados como un array de arrays
		$resultado = mysqli_fetch_all($result);
    	return $resultado;
	}

	function checkFollow($idOtroUsuario, $idMio) {
		$query = "SELECT count(*) FROM siguiendo WHERE usuarios_id = $idMio AND usuarioseguido_id = $idOtroUsuario";
		$result = mysqli_query($this->link,$query) or die(mysqli_error($this->link)); 
		$result = mysqli_fetch_array($result); 
		return $result[0];
	}

	function follow($idOtroUsuario, $idMio) {
		if (!$this->checkFollow($idOtroUsuario, $idMio)){
			$query = "INSERT INTO siguiendo (usuarios_id, usuarioseguido_id) VALUES ($idMio, $idOtroUsuario)";
			$result = mysqli_query($this->link,$query) or die(mysqli_error($this->link));
		}
		else {
			echo "Ya estas siguiendo a este usuario";
		}
	}

	function unfollow($idOtroUsuario, $idMio) {
		if ($this->checkFollow($idOtroUsuario, $idMio)){
			$query = "DELETE FROM siguiendo WHERE usuarios_id = $idMio AND usuarioseguido_id = $idOtroUsuario";
			$result = mysqli_query($this->link,$query) or die(mysqli_error($this->link));
		}
		else {
			echo "No sigues a este usuario";
		}
	}

	function publicarMensaje($mensaje, $userID, $imagen, $tipo_imagen){
        //$mysqltime = date("Y-m-d H:i:s");
        //echo $mysqltime;
        $date = date('Y-m-d H:i:s');
        $query = "INSERT INTO mensaje (texto,imagen_contenido,imagen_tipo,usuarios_id,fechayhora)VALUES('$mensaje', '$imagen','$tipo_imagen',$userID,'$date')";
        mysqli_query($this->link,$query) or die(mysqli_error($this->link));
    }

    function mostrarImagenUsuario($id){
    	$query = "SELECT foto_contenido, foto_tipo FROM usuarios WHERE id='".$id."'"; 
		$result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		$result = mysqli_fetch_array($result); 
		return $result;
    }

     function mostrarImagenMensaje($id){
    	$query = "SELECT imagen_contenido, imagen_tipo FROM mensaje WHERE id='".$id."'"; 
		$result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		$result = mysqli_fetch_array($result); 
		return $result;
    }

    /*function getMensajesSeguidos($id){ // devuelve los ultimos 10 mensajes publicados por los seguidores
    	$query = "SELECT msj.* from `siguiendo` as sig INNER join `mensaje` as msj on msj.usuarios_id = sig.usuarioseguido_id INNER JOIN `usuarios`as us on us.id=sig.usuarios_id WHERE us.id=$id ORDER by id desc limit 10";
		$result = mysqli_query($this->link,$query) or die(mysqli_error($this->link));
		$resultado = mysqli_fetch_all($result); // me guardo los mensajes con todas sus filas
    	return $resultado;
    }*/

    function cantidadMensajesSeguidos($id){ //cuenta la cantidad total de mensajes de los seguidos
    	$query = "SELECT count(*) from `siguiendo` as sig INNER join `mensaje` as msj on msj.usuarios_id = sig.usuarioseguido_id INNER JOIN `usuarios`as us on us.id=sig.usuarios_id WHERE us.id=$id";
    	$result = mysqli_query($this->link,$query) or die(mysqli_error($this->link));
    	$result = mysqli_fetch_array($result); 
    	return $result;
    }


    function cantidadMensajesPropios($id){
    	$query = "SELECT count(*) from mensaje as msj where msj.usuarios_id =$id";
    	$result = mysqli_query($this->link,$query) or die(mysqli_error($this->link));
    	$result = mysqli_fetch_array($result); 
    	return $result;
    }

    function getMensajesSeguidos($id, $limitStart){ // devuelve los ultimos 10 mensajes publicados por los seguidores
    	$cuantosVeo = 10;
    	$limitStart=$limitStart*$cuantosVeo;
    	$query = "SELECT msj.* from `siguiendo` as sig INNER join `mensaje` as msj on msj.usuarios_id = sig.usuarioseguido_id INNER JOIN `usuarios`as us on us.id=sig.usuarios_id WHERE us.id=$id ORDER by id desc limit $cuantosVeo OFFSET $limitStart";
		$result = mysqli_query($this->link,$query) or die(mysqli_error($this->link));
		$resultado = mysqli_fetch_all($result); // me guardo los mensajes con todas sus filas
    	return $resultado;
    }

    function getMensajesByID($id,$limitStart){ // devuelve los ultimos 10 mensajes publicados por el usuario
    	$cuantosVeo = 10;
    	$limitStart=$limitStart*$cuantosVeo;
    	$query = "SELECT * FROM mensaje WHERE usuarios_id=$id ORDER BY id DESC limit $cuantosVeo OFFSET $limitStart";
		$result = mysqli_query($this->link,$query) or die(mysqli_error($this->link));
		$resultado = mysqli_fetch_all($result); // me guardo los mensajes con todas sus filas
    	return $resultado;
    }

    function eliminarTodosMg($idUsuario, $idMensaje){
    	// borra todos los mg del mensaje 
    	echo "string";
    	$query = "DELETE me_gusta.* FROM me_gusta INNER JOIN mensaje on me_gusta.mensaje_id=mensaje.id WHERE me_gusta.mensaje_id=$idMensaje and mensaje.usuarios_id=$idUsuario";
		$result = mysqli_query($this->link,$query) or die(mysqli_error($this->link));	
		echo "string";
	
    }

    function eliminarMensaje($idUsuario, $idMensaje){
		// borra el mensaje
		echo "string";
    	$query = "DELETE FROM mensaje WHERE usuarios_id=$idUsuario AND id=$idMensaje";
		$result = mysqli_query($this->link,$query) or die(mysqli_error($this->link));	
		echo "string";
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

    function darMeGusta($id_user,$id_msj){
    	$query = "INSERT INTO me_gusta (usuarios_id, mensaje_id) VALUES ($id_user, $id_msj)";
    	$result = mysqli_query($this->link,$query) or die(mysqli_error($this->link));
    }

    function eliminarMeGusta($id_user,$id_msj){
    	$query = "DELETE FROM me_gusta WHERE usuarios_id=$id_user AND mensaje_id=$id_msj" ;
    	$result = mysqli_query($this->link,$query) or die(mysqli_error($this->link));
    }
}

?>