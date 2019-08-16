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
 	
 	$id_usuario = $_REQUEST['id_usuario'];
	$nombre = $_REQUEST['nombre']; 
	$avatar = $_REQUEST['avatar']; 
	$fecha_creacion = date("Y-m-d H:i:s"); 
	$json = array();
	if($con){
		

		$sql = "INSERT INTO grupos (nombre, avatar, estado, fecha_creacion, id_admin) VALUES ('$nombre','$avatar', 1, '$fecha_creacion', $id_usuario)";   
		$query = $con->prepare($sql);
		$query->execute();
		if(!$query){
			
			$error->error_code = 1;
			$error->msg = 'No se pudo crear el grupo, contacte con Bigpyx';
			array_push($json, $error);
			die(json_encode($json, true));
			
		}
 		$id_grupo = $con->lastInsertId();

		$sql = "INSERT INTO grupos_usuarios (id_usuario, id_grupo, estado, fecha_creacion) VALUES ($id_usuario,$id_grupo, 1, '$fecha_creacion')";   
		$query = $con->prepare($sql);
		$query->execute();

	
		if(!$query){
			
			$error->error_code = 1;
			$error->msg = 'No se pudo crear el grupo, contacte con Bigpyx';
			array_push($json, $error);
			die(json_encode($json, true));
			
		}else{
			$obj->error_code = 0;
			$obj->msg = 'El grupo se ha creado correctamente.';

			array_push($json, $obj);	
			die(json_encode($json,true));
		}

	}

	//$query = $con->prepare("INSERT * FROM usuarios as u WHERE u.email = '".$email."'");

	
	
	
	
} catch (Exception $e) {
	echo "Erro: ". $e->getMessage();
};

?>