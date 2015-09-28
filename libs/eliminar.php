<?php	
	include("mysql.inc.php");
	$files=$_REQUEST['delete'];
	$dir="../temporaty/";
	$contador=0;
	
	//Verificamos si lo que hemos enviado es un array
	if (is_array($files)){
		
		for ($i=0; $i <count($files) ; $i++){
			//Creamos la estancia de conexion.
			$db = new MySQL();
			$mysqli = new mysqli("localhost", "root", "123", "practica");
			//Eliminamos el archivo antes de eliminar el registro
			$query = "SELECT nombre_image FROM tbl_temp_files WHERE id_files=".$files[$i];
			$result = $mysqli->query($query);
			$numrows = mysqli_num_rows($result); 
			
			//$row=$db ->consulta("SELECT nombre_image FROM tbl_temp_files WHERE id_files=".$files[$i]);
			$rows=$db->fetch_array($row);
			unlink($dir.$rows['nombre_image']);
			
			//Eliminamos el registro de la BD
			$query1 = "DELETE FROM tbl_temp_files WHERE id_files=".$files[$i];
			$rows = $mysqli->query($query1);
			$contador++;
		} 
		//echo "Se han eliminado los $contador registros de la BD";
		echo '<script>location.href="../";</script>';
	} else {
		//echo "No se enviaron segistros para eliminar";
		echo '<script>window.alert("No se enviaron segistros para eliminar");location.href="../";</script>';
	}
?>