<?php
include_once('conexion.php');
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

try {
	$con = new PDO($dns, $user, $pass);
	if(!$con){
		echo "No se puede conectar a la base de datos";
	}		
	$query = $con->prepare("SET NAMES 'utf8'");
	$query->execute();

	$idUsuario = $_REQUEST['id_usuario'];
	$idGrupo = $_REQUEST['id_grupo'];
	$latitud = floatval($_REQUEST['latitud']);
	$longitud = floatval($_REQUEST['longitud']);
	$fecha_posicion = date("Y-m-d H:i:s"); 
	
	if($con){
		$sql = "SELECT * FROM posiciones WHERE id_usuario = $idUsuario AND id_grupo = $idGrupo";
		$query = $con->prepare($sql);
		$query->execute();
		$cuentaPosiciones = $query->rowCount();
		$tipoOperacion = 'I';
		if($cuentaPosiciones == 0){
			$sql = "INSERT INTO posiciones (id_usuario, id_grupo, latitud, longitud, fecha_posicion) VALUES ($idUsuario,$idGrupo,$latitud,$longitud,'$fecha_posicion')";   
			
			$query = $con->prepare($sql);
			$query->execute();
			
		}else{
			$sql = "UPDATE posiciones SET latitud = $latitud, longitud = $longitud, fecha_posicion = '$fecha_posicion' WHERE id_usuario = $idUsuario AND id_grupo = $idGrupo ";
			
			$query = $con->prepare($sql);
			$query->execute();
			$tipoOperacion = 'U';
		}
		$json = array();
		if(!$query){
			
			$error->error_code = 1;
			$error->msg = 'El usuario no existe';
			array_push($json, $error);
			die(json_encode($json, true));
			
		}else{
			$obj->error_code = 0;
			if($tipoOperacion == 'I'){
				$obj->msg = 'La posición se ha registrado correctamente.';	
			}else if($tipoOperacion == 'U'){
				$obj->msg = 'La posición ha sido actualizada correctamente.';	
			}
			

			array_push($json, $obj);	
			die(json_encode($json,true));
		}

	}  
} catch (Exception $e) {
	echo "Erro: ". $e->getMessage();
};

?>