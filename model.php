<?php 


require("conexion.php");


class Crud extends Conexion
{
		

		public static function validaUsuario($param){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM  empleados WHERE email = :user and dni = :dni");	
		 	$stmt->bindParam(":user",$param["usuario"],PDO::PARAM_STR);
		 	$stmt->bindParam(":dni",$param["password"],PDO::PARAM_STR);

		 	$stmt->execute();
		 	$rpt = $stmt->rowCount();

		 	if($rpt){
		 		return "A";

		 	}else{

		 		return "B";
		 	}
		 	
		}


		 public static function registroAsistencia($data){

		 	$stmt = Conexion::conectar()->prepare("INSERT INTO registro (user, fecha_ing) VALUES (:u,now())");	
		 	$stmt->bindParam(":u",$data["usuario"],PDO::PARAM_STR);
		 	//$stmt->bindParam(":f",date("Y-m-d H:i:s", strtotime($data["fecha"])),PDO::PARAM_ST);
		 	
		 	if($stmt->execute()){
		 		//echo "insertado";
		 	}else{
		 		//echo "error insertado";
		 	}

		 	//$stmt->close();

		 }

		  public  static function listaAsistencia($data){
		  								
		 	$stmt = Conexion::conectar()->prepare("SELECT fecha_ing FROM  registro WHERE user = :user");	
		 	$stmt->bindParam(":user",$data["usuario"],PDO::PARAM_STR);
		 	$stmt->execute();
		 	$row =  $stmt->fetch();
		 	echo "D".$row["fecha_ing"];
		 	//return $stmt->fetch();
		 }


		 public  static function verificaAsistenciaHoy($data){

		 	date_default_timezone_set('America/Lima');


		 	$hoy = date("Y-m-d");   // 2001-03-10 17:16:18
		 	$newHoy = $hoy."%"; 
							
		 	$stmt = Conexion::conectar()->prepare("SELECT fecha_ing FROM  registro WHERE user = :user and fecha_ing LIKE '$newHoy'");	
		 	$stmt->bindParam(":user",$data["usuario"],PDO::PARAM_STR);
		 	$stmt->execute();
		 	$row =  $stmt->fetch();

		 	//var_dump($row); exit();

		 	$fecha_ing = substr($row["fecha_ing"],0,10);

		 	//echo $hoy;
		 	//echo $fecha_ing;
		 	//exit();

		 	if ( $fecha_ing == $hoy ){

		 		return "C";

		 	}else{
		 		return "D";
		 	}
		 }

}




/****
--------------------
CODIGOS DE ERRORES:
--------------------

 A : Usuario y/o clave Correcto 
 B : Usuario y/o clave incorrecto

 C : Marco Hoy
 D : No Marco Hoy (INSERTA Y SELECCIONA)

 E : Inserta Reg. Asis.
 F : No Inserto Reg. Asis.

 G : Select Reg. Asis.
 H : No select Reg. Asis

 *****/














 ?>