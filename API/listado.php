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

	$query = $con->prepare("SELECT * FROM usuarios as u WHERE u.email = '".$email."'");
	
	$query->execute();
	$json = array();
	if($result = $query->fetch()){
		

		$usuario->nombre = $result['nombre'];
		$usuario->apellidos = $result['apellidos'];
		$usuario->email = $result['email'];
		$usuario->login = $result['login'];
		$usuario->idioma = $result['idioma'];
		$usuario->avatar = $result['avatar'];
		$usuario->ultima_conexion = $result['ultima_conexion'];

		array_push($json, $usuario);	
		die(json_encode($json,true));
	}else{
		
		$error->error_code = 1;
		$error->msg = 'El usuario no existe';
		array_push($json, $error);
		die(json_encode($json, true));
	}
	
	
} catch (Exception $e) {
	echo "Erro: ". $e->getMessage();
};

?>