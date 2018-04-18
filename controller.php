<?php 


require("conexion.php");


class Crud extends Conexion
{
		

		public function validaUsuario($param){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM  empleados WHERE email = :user and dni = :dni");	
		 	$stmt->bindParam(":user",$param["usuario"],PDO::PARAM_STR);
		 	$stmt->bindParam(":dni",$param["password"],PDO::PARAM_STR);

		 	$stmt->execute();
		 	$rpt = $stmt->rowCount();

		 	if($rpt){
		 		return TRUE;

		 	}else{
		 		return FALSE;
		 	}
		 	
		}


		 public  function registroAsistencia($data){

		 	$stmt = Conexion::conectar()->prepare("INSERT INTO registro (user, fecha_ing) VALUES (:u,now())");	
		 	$stmt->bindParam(":u",$data["usuario"],PDO::PARAM_STR);
		 	//$stmt->bindParam(":f",date("Y-m-d H:i:s", strtotime($data["fecha"])),PDO::PARAM_ST);
		 	
		 	if($stmt->execute()){
		 		echo "insertado";
		 	}else{
		 		echo "error insertado";
		 	}

		 	//$stmt->close();

		 }

		  public  function listaAsistencia($data){
		  								
		 	$stmt = Conexion::conectar()->prepare("SELECT fecha_ing FROM  registro WHERE user = :user");	
		 	$stmt->bindParam(":user",$data["usuario"],PDO::PARAM_STR);
		 	$stmt->execute();
		 	$row =  $stmt->fetch();
		 	echo $row["fecha_ing"];
		 	//return $stmt->fetch();
		 }


		 public  function verificaAsistenciaHoy($data){

		 	$hoy = date("Y-m-d");   // 2001-03-10 17:16:18 
							
		 	$stmt = Conexion::conectar()->prepare("SELECT fecha_ing FROM  registro WHERE user = :user ");	
		 	$stmt->bindParam(":user",$data["usuario"],PDO::PARAM_STR);
		 	$stmt->execute();
		 	$row =  $stmt->fetch();

		 	$fecha_ing = substr($row["fecha_ing"],0,10);

		 	if ( $fecha_ing == $hoy ){

		 		echo "ya marco";

		 	}else{
		 		echo "no marco";
		 	}
		 }

}



/****************************************************/

$user = $_POST["email"];
$pass = $_POST["pwd"];


$obj = new Crud();

$data = [
	"usuario" => $user,
	"password" => $pass
];


$rpt = $obj->validaUsuario($data);

 if($rpt){

 	$obj->verificaAsistenciaHoy($data);

	//echo $obj->registroAsistencia($data);
	//echo $obj->listaAsistencia($data);


 }else{
 	echo "Usuario y/o clave incorrecto 2";
 }


 ?>