<?php
include_once('conexion.php');


try {

	$con = new PDO($dns, $user, $pass);
	
	if(!$con){
		echo "No se puede conectar a la base de datos";
	}

	$query = $con->prepare("SET NAMES 'utf8'");
	$query->execute();
 	
	$id_grupo = $_REQUEST['id_grupo'];
	$sql = "SELECT * FROM posiciones WHERE id_grupo = $id_grupo";
	$query = $con->prepare($sql);
	$query->execute();

	$cuenta = $query->rowCount();
	$json = '{"posicionesGrupo": ['; 
	$aux = 0;
	while($resultadoP = $query->fetch()){
		if($aux > 0){
			$json .= ',';
		}
		$json.= '{"id_usuario":"'.$resultadoP['id_usuario'].'",';
		$json.= '"id_grupo":"'.$resultadoP['id_grupo'].'",';
		$json.= '"lat":"'.$resultadoP['latitud'].'",';
		$json.= '"lng":"'.$resultadoP['longitud'].'",';
		$json.= '"fecha_posicion":"'.$resultadoP['fecha_posicion'].'"}';
		$aux++;
		//array_push($json, $grupo);	
		
	}
	$json.='] }';
	die(json_encode($json, true));
	
	
	
} catch (Exception $e) {
	echo "Erro: ". $e->getMessage();
};

 

?>