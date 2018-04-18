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

		  <div class="alert alert-danger" id="responseMarco"></div>

			  <form class="form-horizontal" id="frm">
		    <div class="form-group">
		      <label class="control-label col-sm-2" for="email">Email:</label>
		      <div class="col-sm-10">
		        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
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
		        <button class="btn btn-primary" id="ing" data-toggle="modal" data-target="#jmodal">Ingreso</button>
		        <button class="btn btn-danger" id="sal" data-toggle="modal">Salida</button>
		      </div>
		    </div>

		  </form>
		  <div class="alert alert-success" id="response"></div>
	</div>

<div class="col-sm-3"></div>

</div>


<!-- Modal -->
<div id="jmodal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Desea Rgistrar su Asistencia</h4>
      </div>
      
      <div class="modal-footer">
      	 <button type="button" class="btn btn-success pull-left" id="yes" >Yes</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>

      </div>
    </div>

  </div>
</div>



<script>
$(document).ready(function(){

	$("#sal").hide();
	$("#response").hide();
	$("#responseMarco").hide();

	$("#frm").on("click",function(e){
		e.preventDefault();
		//alert("ENVIANDO....");
		//sconsole.log("prueba");
		//console.log(data);
	});

	$("#yes").on("click",function(){
			var data = $("#frm").serialize();
			console.log(data);

			$.ajax({
				url:"controller.php",
				type: "POST",
				data:data,
				success:function(response){

					$("#jmodal").modal("hide");

					if(response == "ya marco"){
						$("#sal").show();
						$("#ing").hide();
						//alert("hola");

						$("#responseMarco").show();

						$("#responseMarco").text(response);
					}else{

						//console.log(JSON.stringify(response));
						console.log(response);

						$("#response").show();
						$("#response").text(response);
					}
				}
			})
	});

	function salida(){
		//completar
	}


})

</script>
</body>
</html>