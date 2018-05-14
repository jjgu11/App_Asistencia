<!DOCTYPE html>
<html>
<head>
	<title>REGISTRO DE ASISTENCIA</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</head>


<body>

<div class="container">

	<div class="col-sm-3"></div>

	<div class="col-sm-6">
			<h2 class="text-center">REGISTRO DE ASISTENCIA</h2>
			<br>

		  <div class="alert alert-danger text-center" id="responseDanger"></div>

			  <form class="form-horizontal" id="frm">
		    <div class="form-group">
		      <label class="control-label col-sm-2" for="email">Email:</label>
		      <div class="col-sm-10">
		        <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
		      </div>
		    </div>
		    <div class="form-group">
		      <label class="control-label col-sm-2" for="pwd">Password:</label>
		      <div class="col-sm-10">          
		        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
		      </div>
		    </div>
		    <div class="form-group">        
		      <div class="col-sm-offset-2 col-sm-10">
		        <button class="btn btn-primary btn-block" id="ing" data-toggle="modal" data-target="#jmodal">Ingreso</button>
		        <button class="btn btn-danger btn-block" id="sal" data-toggle="modal" data-target="#jmodal2">Salida</button>
		      </div>
			<br>
		       <div class="text-center"> <span id="liveclock"></span></div>

		    </div>

		  </form>
		  <div class="alert alert-success text-center" id="responseSuccess"></div>

	</div>

<div class="col-sm-3"></div>

</div>


<!-- Modal Ingreso -->
<div id="jmodal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Confirme su Ingreso</h4>
      </div>
      
      <div class="modal-footer">
      	 <button type="button" class="btn btn-success pull-left" id="yes" >Yes</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>

      </div>
    </div>
  </div>
</div>
<!-- Fin  Modal Ingreso -->



<!-- Modal Salida -->
<div id="jmodal2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Confirme su Salida</h4>
      </div>
      
      <div class="modal-footer">
      	 <button type="button" class="btn btn-success pull-left" id="yesSalida" >Yes</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>

      </div>
    </div>
  </div>
</div>
<!-- Fin  Modal Salida -->



<script>
$(document).ready(function(){

	$("#sal").hide();
	$("#responseSuccess").hide();
	$("#responseDanger").hide();

	$("#frm").on("click",function(e){
		e.preventDefault();
		//alert("ENVIANDO....");
		//sconsole.log("prueba");
		//console.log(data);
	});

	$("#yes").on("click",function(){
			var data = $("#frm").serialize();
			//console.log(data);

			var newdata = data+"&"+"type=I";
			console.log(newdata);

			$.ajax({
				url:"controller.php",
				type: "POST",
				data:newdata,
				success:function(response){

					$("#jmodal").modal("hide");

					console.log(response);

					switch (response) {

						case "A":
							$("#responseSuccess").show();
							$("#responseSuccess").text("Usuario Correcto!!");
						break;


						case "B":
							$("#responseDanger").show();
							$("#responseDanger").text("Usuario y/o clave incorrecto!!!");
							menssageAlert();
						break;


						case "C":
							$("#sal").show();
							$("#ing").hide();
							$("#responseDanger").show();
							$("#responseDanger").text("Usted ya Registro su Entrada Hoy!!");
							menssageAlert();
							break;

					} // ----fin switch

					var caracter = response.charAt(0);
					var caracterRemove = response.substring(1);

					console.log("nuew letra "+caracter);

					console.log("nuew letra "+caracterRemove);

					if (caracter =="D"){

						$("#responseSuccess").show();
						$("#responseSuccess").html("<strong>Fecha y Hora de Reg: </strong> "+caracterRemove);
						
					}

				}
			}) //------ Fin Ajax
	}); // ------ Fin Function Yes Ingreso


		
		$("#yesSalida").on("click",function(){
			console.log("-------------------- salida -----------------")
			var data = $("#frm").serialize();
			var newdata = data+"&"+"type=S";
			console.log(newdata);

			$.ajax({
				url:"controller.php",
				type: "POST",
				data:newdata,
				success:function(response){

					$("#jmodal2").modal("hide");

					console.log(response);

					switch (response) {

						case "A":
							$("#responseSuccess").show();
							$("#responseSuccess").text("Usuario Correcto!!").toggle("slow");
						break;


						case "B":
							$("#responseDanger").show();
							$("#responseDanger").text("Usuario y/o clave incorrecto!!!");
							menssageAlert();
						break;

					} // ----fin switch

					var caracter = response.charAt(0);
					var caracterRemove = response.substring(1);

					console.log("nuew letra "+caracter);

					console.log("nuew letra "+caracterRemove);

					if (caracter =="D"){

						$("#responseSuccess").show();
						$("#responseSuccess").html("<strong>Fecha y Hora de Salida: </strong> "+caracterRemove);
						
					}

				}
			}) //------ Fin Ajax*/
	}); // ------ Fin Function Yes Salida

	

	function menssageAlert(){

		// Mensages de Alerta Cerrar fadeTo(speed, opacity) / slideUp(slow - 400 milliseconds,fast)
	    $("#responseDanger").fadeTo(12000, 0.8).slideUp("slow", function(){
	        $("#responseDanger").slideUp("slow");
	    });
	}


})

    function show5(){

        if (!document.layers&&!document.all&&!document.getElementById)
        return

         var Digital=new Date()
         var hours=Digital.getHours()
         var minutes=Digital.getMinutes()
         var seconds=Digital.getSeconds()

        var dn="PM"
        if (hours<12)
        dn="AM"
        if (hours>12)
        hours=hours-12
        if (hours==0)
        hours=12

         if (minutes<=9)
         minutes="0"+minutes
         if (seconds<=9)
         seconds="0"+seconds
        //change font size here to your desire
        myclock="<font size='5' face='Arial' ><b><font size='1'>Hora actual:</font></br>"+hours+":"+minutes+":"
         +seconds+" "+dn+"</b></font>"
        if (document.layers){
        document.layers.liveclock.document.write(myclock)
        document.layers.liveclock.document.close()
        }
        else if (document.all)
        liveclock.innerHTML=myclock
        else if (document.getElementById)
        document.getElementById("liveclock").innerHTML=myclock
        setTimeout("show5()",1000)
         }


        window.onload=show5



</script>
</body>
</html>