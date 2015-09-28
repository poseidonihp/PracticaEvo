<?php 


// Mysql

class MySQL
{  
		private $conexion;  
	  	private $total_consultas;  
	 	
		//Conexion de BD
		public function MySQL()
		{  
	  		if(!isset($this->conexion))
			{  
	  			$this->conexion = mysqli_connect("localhost","root","123","practica");   
	  		}  
	  	}  
	 
	 	public function consulta($consulta)
		{  
	  		$this->total_consultas++;  
	  		$resultado = $this->conexion->query($consulta);  
	  			if(!$resultado)
				{  
	  				echo 'MySQL Error: ' . mysql_error();  
	  				exit;  
	  			}  
	  		return $resultado;   
	  	}  
	 
	 	public function fetch_array($consulta)
		{   
	  		return mysqli_fetch_row($consulta);  
	  	}  
		
	 	public function num_rows($consulta)
		{   
	  		return mysqli_num_rows($consulta);  
	  	}	 
	 
	 	public function getTotalConsultas()
		{  
	  		return $this->total_consultas;  
	  	}
		  
		public function closemysql()
		{
			mysql_close($this ->conexion);	
		}
}

/*

|--------------------------------------------------------------------------
| Base Site URL
|--------------------------------------------------------------------------
|
| URL. Typically this will be your base URL,
| WITH a trailing slash:
|
|	http://example.com/
|
|
*/
$config['base_url']	= $_SERVER['PHP_SELF'];

/*
|--------------------------------------------------------------------------
| Default Character Set
|--------------------------------------------------------------------------
|
| Esto determina qué conjunto de caracteres se utiliza por defecto en varios métodos
|que requieren un conjunto de caracteres que se preste.
|
*/
$config['charset'] = 'ISO-8859-1';

/*
|--------------------------------------------------------------------------
| Default Address footer
|--------------------------------------------------------------------------
| Determina el parametro de contexto en el pie de página
|
*/
$config['address_footer'] = 'Copyright';
?>