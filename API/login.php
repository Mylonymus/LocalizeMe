<?php
include_once('conexion.php');
try {
	$con = new PDO($dns, $user, $pass);
	if(!$con){
		echo "No se puede conectar a la base de datos";
	}		
	$query = $con->prepare("SET NAMES 'utf8'");
	$query->execute();

	$email = $_REQUEST['email'];
	$password = $_REQUEST['password'];
	
	$query = $con->prepare("SELECT * FROM usuarios as u WHERE u.email = '".$email."'");


	$query->execute();
	

	$registros = array();
	
	if($result = $query->fetch()){
		
		if($result['password'] != md5($password)){
			$json = array();
			$error->error_code = 2;
			$error->msg = 'Las credenciales no coinciden';
			array_push($json, $error);
			die(json_encode($json, true));
		}else{
			//$usuario = $result;
			$usuario->id = $result['id'];
			$usuario->nombre = $result['nombre'];
			$usuario->apellidos = $result['apellidos'];
			$usuario->email = $result['email'];
			$usuario->avatar = $result['avatar'];
			$usuario->login = $result['login']; 
			$usuario->bloqueado = $result['bloqueado'];
			$usuario->activado = $result['activado'];
			$usuario->estado = $result['estado'];
			$usuario->fecha_creacion = $result['fecha_creacion'];
			$usuario->ultima_conexion = $result['ultima_conexion'];


			array_push($registros, $usuario);	
			die(json_encode($registros,true));
		}
		

	}else{
		$json = array();

		$error->error_code = 1;
		$error->msg = 'El usuario no existe';
		array_push($json, $error);
		die(json_encode($json, true));

	}
	
	
	
} catch (Exception $e) {
	echo "Erro: ". $e->getMessage();
};

?>