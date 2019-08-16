<?php
include_once('conexion.php');
try {
	$con = new PDO($dns, $user, $pass);
	if(!$con){
		echo "No se puede conectar a la base de datos";
	}		
	$query = $con->prepare("SET NAMES 'utf8'");
	$query->execute();
	
	$query = $con->prepare("SELECT * FROM configuracion_global WHERE id_app = 1");

	$query->execute();
	
	$registros = array();
	
	if($result = $query->fetch()){
		
		$usuario->id_app = intval($result['id_app']);
		$usuario->nombre = $result['nombre'];
		$usuario->fase_beta = intval($result['fase_beta']);
		$usuario->numero_maximo_usuarios = intval($result['numero_maximo_usuarios']);
		$usuario->registro_usuarios = intval($result['registro_usuarios']);
		$usuario->creacion_grupos = intval($result['creacion_grupos']);

		array_push($registros, $usuario);	
		die(json_encode($registros,true));
		
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