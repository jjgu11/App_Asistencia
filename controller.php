<?php 


require("model.php");

/**
* 
*/
class Registro 
{
	//valida usuario 
	public function validaUsuarioController($param){

		$rpt = Crud::validaUsuario($param);	

		return 	$rpt;
	}

	//valida ingreso
	public function asistenciaHoyController($param){

		$rpt = Crud::verificaAsistenciaHoy($param);	

		return 	$rpt;
	}

	//registra ingreso
	public function registroAsistenciaController($param){
		$rpt = Crud::registroAsistencia($param);
		return $rpt;
	}

	//lista asistencia
	public function listaAsistenciaController($param){

		$rpt = Crud::listaAsistencia($param);
		return $rpt;
	}

}


class Salida 
{
	//valida usuario 
	public function validaUsuarioController($param){

		$rpt = Crud::validaUsuario($param);	

		return 	$rpt;
	}

	//valida ingreso
	public function asistenciaHoyController($param){
		$rpt = Crud::verificaAsistenciaHoy($param);	
		return 	$rpt;
	}

	//registra salida
	public function registroAsistenciaController($param){
		$rpt = Crud::registroAsistencia($param);
		return $rpt;
	}

	//lista asistencia
	public function listaAsistenciaController($param){

		$rpt = Crud::listaAsistencia($param);
		return $rpt;
	}

}

/****************************************************/

/****************************************************/

/*

envio de datos desde ajax

-user
-pass
-tipo : I o S

valido el tipo : I o S
	- hago 2 clases (ingreso, salida) php.
	- depende del tipo, instancio las clases php
	- acceso al obj y paso como parametros la data


*/




$user = $_POST["email"];
$pass = $_POST["pwd"];
$type = $_POST["type"];


if($type == "I"){

	//INGRESO

	$data = [
	"usuario" => $user,
	"password" => $pass
	];


	$obj = new Registro();


	if($obj->validaUsuarioController($data) == "A"){

		//echo "A";
		if($obj->asistenciaHoyController($data) == "D"){

			//echo "D";
			$obj->registroAsistenciaController($data);
			//echo "insertado";
			
			$obj->listaAsistenciaController($data);

			
		}else{
			echo "C"; // marco hoy
		}

	}else{

		echo "B"; //Usuario y/o clave incorrecto
	}


}else {

	//SALIDA

	$data = [
	"usuario" => $user,
	"password" => $pass
	];


	$obj = new Salida();


	if($obj->validaUsuarioController($data) == "A"){

		//echo "A";
		if($obj->asistenciaHoyController($data) == "C"){

			//echo "C";
			$obj->registroAsistenciaController($data);
			//echo "insertado";
			
			$obj->listaAsistenciaController($data);

			
		}else{
			echo "D"; // No marco hoy
		}

	}else{

		echo "B"; //Usuario y/o clave incorrecto
	}


}







// $user = $_POST["email"];
// $pass = $_POST["pwd"];
// $type = $_POST["type"];

// echo $type;
// exit();


// $obj = new Registro();

// $data = [
// 	"usuario" => $user,
// 	"password" => $pass
// ];





//validacion 

// if($obj->validaUsuarioController($data) == "A"){

// 	//echo "A";
// 	if($obj->asistenciaHoyController($data) == "D"){

// 		//echo "D";
// 		$obj->registroAsistenciaController($data);
// 		//echo "insertado";
		
// 		$obj->listaAsistenciaController($data);

		
// 	}else{
// 		echo "C"; // marco hoy
// 	}

// }else{

// 	echo "B";
// }



/*****

------------------------------
PASOS VALIDACIONES 			 :
------------------------------

1 : Verificar Usuarios Existe en la BD.
2 : Verificar Si Registro Hoy su Asistencia (Fecha) 
	| + I : aparece Btn Salida. | ó | + I & S : aparece Msg Registro Completo. 

3 : Insert de Registro (Fecha y Usuario)
4 : Select de Registro Insertado (Fecha y Hora Hoy Reg.)

-----

Validando la salida:

 - ya no validar si el registro existe
 - insertar el nuevo registro | new campo  S
 - Traer los Datos de la Salida y Entrada


------------------------------------------------------------------------

*****/



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