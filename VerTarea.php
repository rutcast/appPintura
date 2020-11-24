<?php

try{
	
$conn = pg_connect("host= funesh-db.cml6c4rzjcyk.us-east-1.rds.amazonaws.com dbname= drive_app port = 5432 user = gil password =funesTestPassword") or die ("Error de Conexión".pg_last_error());

$sql = "select  id, st.\"code\", st.\"name\" ,dp.\"name\" dpto, mn.\"name\" mun, 
st.\"scheduled\", st.\"complete\" 
from drive_app.\"Stores\" st join drive_app.\"Sectors\" dp
on st.\"department\" = dp.\"code\"
join drive_app.\"Sectors\" mn on st.\"sector\" = mn.\"code\"  
where st.\"complete\" = 'TRUE' limit 5" ;

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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type ="text/javascript" src="appILC.js"></script>
<!-- <script type ='text/javascript" src="js/addons/datatables.min.js"></script> -->
</head>

<nav class="navbar navbar-dark default-color justify-content-between">
  <a class="navbar-brand" href="#">Funes Hartman</a>
  <form class="form-inline my-1">
    <div class="md-form form-sm my-0">
      <input class="form-control form-control-sm mr-sm-2 mb-0" type="text" placeholder="Search"
        aria-label="Search">
    </div>
    <button class="btn btn-outline-white btn-sm my-0" type="submit">Search</button>
  </form>
</nav>


<body>
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
		  <th class="th-sm">Agendada
          </th>
          <th class="th-sm">Completada
          </th>
        </tr>
      </thead>
        <tbody>
		
		<?php 
		if($result) {
			while ($row = pg_fetch_row($result)) {
		echo '<tr>';
		echo '<td>'.$row[1].'</td>'. '<td>'.$row[2].'</td>'.'<td>'.$row[3].'</td>'.'<td>'.$row[4].'</td>'.'<td>'.$row[5].'</td>'.'<td>'.$row[6].'</td>';
	    echo '</tr>';
		}
		}
		
		?>
		</tbody>
</table>      


</body>

</html>


<?php


}catch(PDOException $e){
	echo $e->getMessage();
}

?>


