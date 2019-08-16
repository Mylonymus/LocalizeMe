<?php
include_once('conexion.php');
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/x-www-form-urlencoded");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

try {
	$con = new PDO($dns, $user, $pass);
	if(!$con){
		echo "No se puede conectar a la base de datos";
	}		
	$query = $con->prepare("SET NAMES 'utf8'");
	$query->execute();

	$email = $_REQUEST['email'];
	$nombre = $_REQUEST['nombre'];
	$apellidos = $_REQUEST['apellidos'];
	$login = $_REQUEST['email'];
	$password = md5($_REQUEST['password']);
	$idioma = 'es_ES';
	$fecha_creacion = date("Y-m-d H:i:s"); 

	if($con){
		

		$sql = "INSERT INTO usuarios (nombre, apellidos, email, login, password, fecha_creacion, activado, bloqueado, estado, idioma, avatar, ultima_conexion) VALUES ('$nombre','$apellidos','$email','$login','$password','$fecha_creacion', 1, 0, 1,'$idioma','','$fecha_creacion')";   
		$query = $con->prepare($sql);
		$query->execute();

		$json = array();
	
		if(!$query){
			
			$error->error_code = 1;
			$error->msg = 'El usuario no existe';
			array_push($json, $error);
			die(json_encode($json, true));
			
		}else{
			$obj->error_code = 0;
			$obj->msg = 'El registro se ha realizado correctamente.';

			array_push($json, $obj);	
			die(json_encode($json,true));
		}

	}

	//$query = $con->prepare("INSERT * FROM usuarios as u WHERE u.email = '".$email."'");

	
	
	
	
} catch (Exception $e) {
	echo "Erro: ". $e->getMessage();
};

?>