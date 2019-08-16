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
 	$id_grupo = $_REQUEST['id_grupo']; 

	$json = array();
	if($con){
		
		//Eres administrador del grupo que quieres borrar?
		$sql = "SELECT * FROM grupos  WHERE id = $id_grupo AND id_admin = $id_usuario ";
		$query = $con->prepare($sql);
		$query->execute();
	  	if(!$query){
			
			$error->error_code = 1;
			$error->msg = 'No puedes borrar el grupo, ésta tarea sólo puede hacer el administrador del grupo.';
			array_push($json, $error);
			die(json_encode($json, true));
			
		}
		if($resultadoAdminGrupo = $query->fetch()){
		 	$grupo = intval($resultadoAdminGrupo['id']);
			
		}else{

			$error->error_code = 1;
			$error->msg = 'No puedes borrar el grupo, ésta tarea sólo puede hacer el administrador del grupo.';
			array_push($json, $error);
			die(json_encode($json, true));
		}
		
		//Borrar relaciones de grupo
		
		$sql = "DELETE FROM grupos_usuarios WHERE id_grupo = $grupo";
		$query = $con->prepare($sql);
		$query->execute();
		if(!$query){
			
			$error->error_code = 1;
			$error->msg = 'Ha habido un error al intentar desvincular a los usuarios, del grupo que actualmente se desea borrar.';
			array_push($json, $error);
			die(json_encode($json, true));
			
		}
		//Borrar el grupo

		$sql = "DELETE FROM grupos WHERE id = $grupo";
		$query = $con->prepare($sql);
		$query->execute();
		if(!$query){
			
			$error->error_code = 1;
			$error->msg = 'Ha habido un error al intentar borrar el grupo.';
			array_push($json, $error);
			die(json_encode($json, true));
			
		}else{
			$obj->error_code = 0;
			$obj->msg = 'El grupo se ha eliminado correctamente.';

			array_push($json, $obj);	
			die(json_encode($json,true));
		}

	}
	
	
} catch (Exception $e) {
	echo "Erro: ". $e->getMessage();
};

?>