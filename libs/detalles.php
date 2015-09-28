<?php
	//include("mysql.inc.php");
	//$db = new MySQL();
		$mysqli = new mysqli("localhost", "root", "123", "practica");
	
	
	if (mysqli_connect_errno()) {
    printf("Falló la conexión failed: %s\n", $mysqli->connect_error);
    exit();
}
	
	
	$details = $_POST['id'];
	
	if ($details) {
		$query = "SELECT * FROM tbl_temp_files WHERE id_files=".$details;
		$result = $mysqli->query($query);
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
		
			echo "<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"table_details\" width=\"400\">";
				echo "<tr>";
					echo "<td align=\"right\"><strong>Nombre:</strong></td>";
					echo "<td width=\"10\">&nbsp;</td>";
					echo "<td>".$row['nombre']."</td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td align=\"right\"><strong>Tipo:</strong></td>";
					echo "<td width=\"10\">&nbsp;</td>";
					echo "<td>".$row['tipo']."</td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td align=\"right\"><strong>url:</strong></td>";
					echo "<td width=\"10\">&nbsp;</td>";
					echo "<td>http://localhost/uploadify/temporaty/".$row['nombre_image']."</td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td>&nbsp;</td>";
					echo "<td>&nbsp;</td>";
					echo "<td>&nbsp;</td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td colspan=\"3\" align=\"center\"><a target=\"_blank\" href=\"temporaty/".$row['nombre_image']."\" class=\"a_demo_two\">Descargar</a></td>";
				echo "</tr>";
			echo "</table>";
			echo "<br /><br />";
			
	} 
	}else {
		echo "No hay informacion";
	}
	
	

?>