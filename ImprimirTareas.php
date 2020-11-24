	<?php

	try{
		
	$conn = pg_connect("host= funesh-db.cml6c4rzjcyk.us-east-1.rds.amazonaws.com dbname= drive_app port = 5432 user = gil password =funesTestPassword") or die ("Error de Conexión".pg_last_error());

	$sql = "select  id, st.\"code\", st.\"name\" ,dp.\"name\" dpto, mn.\"name\" mun, 
	st.\"scheduled\", st.\"complete\" 
	from drive_app.\"Stores\" st join drive_app.\"Sectors\" dp
	on st.\"department\" = dp.\"code\"
	join drive_app.\"Sectors\" mn on st.\"sector\" = mn.\"code\"  
	limit 5" ;

	$result = pg_query($conn, $sql);


	?>
	<html>
	<head>
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
	<!-- Google Fonts -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
	<!-- Bootstrap core CSS -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
	<!-- Material Design Bootstrap -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
	<link href="css/addons/datatables.min.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.1.1.min.js">

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

<script src="js/bootstrap-datepicker.min.js" charset="utf-8"></script>

<link rel="stylesheet" href = "css/bootstrap-datepicker.css">

<!--
	<script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
-->
	


	<script type ="text/javascript" src="appILC.js"></script>
	<!-- <script type ='text/javascript" src="js/addons/datatables.min.js"></script> -->
	</head>
	<nav class="navbar navbar-expand-lg navbar-dark"  Style="background-color:#ea6224; font-family: inherit;">

	  <!-- Navbar brand -->
	  <Strong><a class="navbar-brand" href="#">Funes Hartmann</a></Strong>

	  <!-- Collapse button -->
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
	    aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <!-- Collapsible content -->
	  <div class="collapse navbar-collapse" id="basicExampleNav">

	    <!-- Links -->
	    <ul class="navbar-nav mr-auto">
	      
	    </ul>

	    <form method="post" action="getStore.php">
			
<!--
			<div  class="sm-form sm-outline input-with-post-icon datepicker">
				<input placeholder="Desde" type="text" id="desde" class="form-control">
				<i id="startDate" class="fas fa-calendar input-prefix" tabindex=0></i>
			</div> &nbsp;&nbsp;
-->
	<!--		<div class="form-group">
				<div class="input group">
				<input placeholder="Desde" type="text" class="form-control" id="startDate">
			</div>&nbsp;&nbsp;&nbsp;&nbsp;
			</div>



			<div class="form-group">
				<div class="input group">
				<input placeholder="Hasta" type="text" class="form-control" id="endDate">
			</div>
			</div>
	-->		
			
			<div class="md-form my-0">
					<input class="form-control mr-sm-2" type="search" id="search" placeholder="Búsqueda" aria-label="Codigo">
			</div>
			
	    </form>&nbsp;&nbsp;&nbsp;
	    <form method="post" action="DwnBase.php">
	    	<input type="submit" class="btn btn-primary" name="btnDwl" value="Descargar Base">
	    </form>
	  </div>
	  <!-- Collapsible content -->

	</nav>
	<!--/.Navbar-->

	<div class="input-group flex-nowrap">
	  <h2>Proyecto Avalancha</h2>
	</div>

	<!-- DATAGRID---->

	<div class="container my-4">


	<table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
	      <thead>
	        <tr>
	          <th class="th-sm">IdTienda
	          </th>
	          <th class="th-sm">Tienda
	          </th>
	          <th class="th-sm">Municipio
	          </th>
	          <th class="th-sm">Departamento
	          </th>
	        </tr>
	      </thead>
	        <tbody id="container"></tbody>
	</table>      



	  </div>
	  
	<div class="container-fluid">
	  <div class="row">
	    <div class="col-2">
	    	<h4>
	    	<span class="badge badge-primary">Información Tienda </span>
	    	</h4>
	      <div class="row"><strong><label>Código:</label></strong></div>
		  <div class="row"><label id="lblCodTienda"></label></div>
		  <div class="row"><strong><label>Tienda:</label></strong></div>
		  <div class="row"><label id="lblNomTienda"></label></div>

	      <div class="row"><strong><label>Nombre Cliente:</label></strong></div>
		  <div class="row"><label id="lblCliente"></label></div>
		  <div class="row"><strong><label>Telefono Cliente:</label></strong></div>
		  <div class="row"><label id="lblTelCliente"></label></div>
    </div>
	    <div class="col-2">
	    	<h4>
	    	<span class="badge badge-primary">Información Tarea </span>
	    	</h4>

	    	<div class="row">
	    		<strong>

	    		<div class="row"><label>Fecha de visita: </label><label id="lblDate"></label></div>
	    		<div class="row"><label>Nombre Pintado: </label><label id="lblNomP"></label></div>
				<div class="row"><label>Marco Exterior: </label><label id="lblBanner"></div>
				<div class="row"><label>Porta Afiche: </label><label id="lblPorta"></div>
				<div class="row"><label>Afiche: </label><label id="lblAfi"></label></div>
				<div class="row"><label>Marco Lego: </label><label id="lblLego"></label></div>
				<div class="row"><label>Glorificador: </label><label id="lblGlori"></label></div>
				<div class="row"><label>Banderola: </label><label id="lblBande"></label></div>
				<div class="row"><label>Metros Pintados: </label><label id="lblMts2"></label></div>

				<div class="row"><label>Comentarios: </label></div>
				</strong>
				<div class="row">
  <textarea id = "txtCom" class="form-control rounded-0" id="exampleFormControlTextarea1" rows="10"></textarea>
</div>
	    	</div>
	    
	    </div>

	    <div class="col-8">
	    	<h4>
	    	<span class="badge badge-primary">Imágenes Tarea </span>
		</h4>
		<div class="row"> 
		<div class="col">
			<img id = "BF01" alt="thumbnail" class="img-thumbnail img-fluid " src ="IMG/images.png">
		</div>
		<div class="col">
			<img id = "BF02" alt="thumbnail" class="img-thumbnail img-fluid " src ="IMG/images.png">
		</div>
		<!--<div class="col">
			<img id = "BF03" alt="thumbnail" class="img-thumbnail img-fluid ">
		</div>-->
		
		</div>
		<div class="row">
		<div class="col">
			<img id = "AF01" alt="thumbnail" class="img-thumbnail img-fluid "src ="IMG/images.png">
		</div>
		<div class="col">
			<img id = "AF02" alt="thumbnail" class="img-thumbnail img-fluid "src ="IMG/images.png">
		</div>
		<!--<div class="col">
			<img id = "AF03" alt="thumbnail" class="img-thumbnail img-fluid ">
		</div>-->
		</div>
		<div class="row">
		<div class="col">
			<img id = "ACEPT" alt="thumbnail" class="img-thumbnail img-fluid "src ="IMG/images.png">
		</div>
		</div>
		
		</div>
	</div>

	  </div>


	</html>




	<?php


	}catch(PDOException $e){
		echo $e->getMessage();
	}

	?>
			