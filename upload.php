<?php

$uploaddir = 'temporaty/';

// Los datos publicados, para referencia de la imagen.
$file = $_POST['value'];
$name = $_POST['name'];

/*Datos del formulario
*
*	Aqui pondremos todas los campos que desemos agregar en nuestro formulario de envio.
*/
$nombre= $_POST['nombre'];
$descrip= $_POST['descripcion'];
$prioridad= $_POST['prioridad'];



// Optenemos la extension del archivo que estamos cargando.
$getMime = explode('.', $name);
$mime = end($getMime);

// Separar los datos
$data = explode(',', $file);

// Codificar correctamente
$encodedData = str_replace(' ','+',$data[1]);
$decodedData = base64_decode($encodedData);

// Puede usar el nombre de pila, o crear un nombre aleatorio.
// Vamos a crear un nombre al azar!

$randomName = substr_replace(sha1(microtime(true)), '', 12).'.'.$mime;

	//Aqui modificamos el Query para insertar los datos a la BD.
	//include('libs/mysql.inc.php');
	//$db = new MySQL();
    $mysqli = new mysqli("localhost", "root", "123", "practica");
	$query = "INSERT INTO `tbl_temp_files` VALUES('NULL','$nombre','$descrip','$randomName','$mime','1','$prioridad')";
	$insert = $mysqli->query($query);
	?>