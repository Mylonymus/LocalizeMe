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
	 
 	$sql = "SELECT usuarios.*,posiciones.latitud,posiciones.longitud FROM usuarios,grupos_usuarios,posiciones WHERE grupos_usuarios.id_grupo = $id_grupo AND usuarios.id = grupos_usuarios.id_usuario AND posiciones.id_grupo = grupos_usuarios.id_grupo GROUP BY usuarios.id";
	$query = $con->prepare($sql);
	
	$query->execute();
	$cuenta = $query->rowCount();
	$json = '{"usuariosGrupo": ['; 
	$aux = 0;
	while($resultadoG = $query->fetch()){
		if($aux > 0){
			$json .= ',';
		}
		$json.= '{"id":"'.$resultadoG['id'].'",';

		$json.= '"posicionActual":{"latitud":'.$resultadoG['latitud'].' , "longitud": '.$resultadoG['longitud'].'},';

		$json.= '"nombre":"'.$resultadoG['nombre'].'",';
		$json.= '"apellidos":"'.$resultadoG['apellidos'].'",';
		$json.= '"email":"'.$resultadoG['email'].'",';
		$json.= '"fecha_creacion":"'.$resultadoG['fecha_creacion'].'",';
		$json.= '"activado":"'.$resultadoG['activado'].'",';
		$json.= '"bloqueado":"'.$resultadoG['bloqueado'].'",';
		$json.= '"estado":"'.$resultadoG['estado'].'",';
		$json.= '"avatar":"'.$resultadoG['avatar'].'",'; 
		$json.= '"ultima_conexion":"'.$resultadoG['ultima_conexion'].'"}';
		$aux++;
		//array_push($json, $grupo);	
		
	}
	$json.='] }';
	die(json_encode($json, true));
	
	
	
} catch (Exception $e) {
	echo "Erro: ". $e->getMessage();
};

 

?>