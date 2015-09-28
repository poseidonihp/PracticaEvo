<?php
	//include("mysql.inc.php");
	
	//$db = new MySQL();
	//$listar= $db ->consulta("SELECT * FROM tbl_temp_files");
		$mysqli = new mysqli("localhost", "root", "123", "practica");
	
	
	if (mysqli_connect_errno()) {
    printf("Falló la conexión failed: %s\n", $mysqli->connect_error);
    exit();
}

$query = "SELECT * FROM tbl_temp_files";
$result = $mysqli->query($query);
 $numrows = mysqli_num_rows($result); 

if($numrows >0){
	echo "<form method='POST' action='libs/eliminar.php'>";
	echo '<div align="right" style="color:#FFF;font-family:Arial; margin-bottom:10px">Eliminar elementos seleccionados <input class="button" type="submit" name"borrar" value="Borrar"></div>';
	echo '<div class="CSSTableGenerator"><table cellpadding="0" cellspacing="0" border="0">';
			echo '<tr>';
				echo '<td width="10">Estado</td>
				<td>Nombre</td>
				<td>Descripcion</td>
				<td width="70">Vista</td>
				<td width="70">Opciones</td>';
				while($row = $result->fetch_array(MYSQLI_ASSOC)){
					echo '<tr class="odd gradeA">';					echo '<tr class="odd gradeA">';
						if ($row['status']==1) {
							echo "<td><img src='images/001_18.png' width='20'></td>";
						} else {
							echo "<td><img src='images/001_19.png' width='20'></td>";
						}
						echo"<td>".$row['nombre']."</td>";
						echo"<td>".$row['descripcion']."</td>";
						switch ($row['tipo']) {
						case 'pdf':
								echo"<td><img src='images/pdf.png' width='70' height='70'></td>";
							break;
						case 'docx':
								echo"<td><img src='images/doc.png' width='70' height='70'></td>";
							break;
						case 'xlsx':
								echo"<td><img src='images/xls.png' width='70' height='70'></td>";
							break;
						case 'html':
								echo"<td><img src='images/html.png' width='70' height='70'></td>";
							break;
						case 'txt':
								echo"<td><img src='images/txt.png' width='70' height='70'></td>";
							break;
						case 'zip':
								echo"<td><img src='images/zip.png' width='70' height='70'></td>";
							break;
								
						default:
								echo"<td><img border=\"0\" src=\"temporaty/".$row['nombre_image']."\" width='70' height='70'></a></td>";
							break;
						}
						echo "<td>&nbsp;&nbsp;<input style=\"width: 13px;height: 13px;\" type='checkbox' name='delete[]' id='delete' value='".$row['id_files']."'><ul class=\"tinybox\"><li onclick=\"TINY.box.show({url:'libs/detalles.php',post:'id=".$row['id_files']."',width:500,height:200,opacity:20,topsplit:3})\"><img  title=\"Ver detalles\" src=\"images/detailed.png\"></li></ul></td>";
					echo '</tr>';
				}	
	echo '</table></div>';	
	echo "</form>";
}else{
	echo"<div id='mensajevacio' align=\"center\">No hay archivos por el momento</div>";
}
?>