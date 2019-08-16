<?php
include_once('conexion.php');


try {

	$con = new PDO($dns, $user, $pass);
	
	if(!$con){
		echo "No se puede conectar a la base de datos";
	}

	$query = $con->prepare("SET NAMES 'utf8'");
	$query->execute();
 	$login = $_REQUEST['login'];
	
	$query = $con->prepare("SELECT * FROM usuarios as u WHERE u.email = '".$login."'");
	$query->execute();
	
	if($resultado = $query->fetch()){
		$usuario->id = $resultado['id'];
	}


	$query = $con->prepare("SELECT * FROM `grupos_usuarios`,`grupos` WHERE id_usuario = $usuario->id AND id = id_grupo");
	
	$query->execute();
	$cuenta = $query->rowCount();
	$json = '{"grupos": ['; 
	$aux = 0;
	while($resultadoG = $query->fetch()){
		if($aux > 0){
			$json .= ',';
		}
		$json.= '{"avatar":"'.$resultadoG['avatar'].'",';
		$json.= '"estado":"'.$resultadoG['estado'].'",';
		$json.= '"id_grupo":"'.$resultadoG['id_grupo'].'",';
		$json.= '"id_admin":"'.$resultadoG['id_admin'].'",';
		$json.= '"restringido":"'.$resultadoG['restringido'].'",'; 
		$json.= '"fecha_suscripcion_grupo":"'.$resultadoG['fecha_creacion'].'",';
		$json.= '"nombre":"'.$resultadoG['nombre'].'"}';
		$aux++;
		//array_push($json, $grupo);	
		
	}
	$json.='] }';
	die(json_encode($json, true));
	
	
	
} catch (Exception $e) {
	echo "Erro: ". $e->getMessage();
};

 

?>