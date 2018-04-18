<?php 

/* 
class Conexion
{
	public $host = "localhost";
	public $db   = "prueba";
	public $user = "root";
	public $pass = "";

	private $con = null;
	
	
	function __construct()
	{
		$this->con = conectar();
	}

	public function conectar(){
		$con = new PDO("mysql:host=localhost;dbname=$registro","root","");
		return $con;
	}
}
*/

class Conexion{
	public static function conectar(){
		$con = new PDO("mysql:host=localhost;dbname=asistencia","root","");
		return $con;
	}

}


 ?>