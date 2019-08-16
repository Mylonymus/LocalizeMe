<?php
include_once('conexion.php');


try {

	$con = new PDO($dns, $user, $pass);
	
	if(!$con){
		echo "No se puede conectar a la base de datos";
	}

	$query = $con->prepare("SET NAMES 'utf8'");
	$query->execute();
 	$idGrupo = $_REQUEST['id_grupo'];
	
	$query = $con->prepare("SELECT * FROM grupos as g WHERE g.id = '".$idGrupo."'");
	$query->execute();
	$json = array();
	if($resultado = $query->fetch()){
		$grupo->estado = $resultado['estado'];
		array_push($json, $grupo);
	}
	
	die(json_encode($json, true));
	
	
	
} catch (Exception $e) {
	echo "Erro: ". $e->getMessage();
};

 

?>