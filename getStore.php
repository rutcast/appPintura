<?php


$conn = pg_connect("host= funesh-db.cml6c4rzjcyk.us-east-1.rds.amazonaws.com dbname= drive_app port = 5432 user = gil password =funesTestPassword") or die ("Error de Conexión".pg_last_error());




if(isset($_POST['search'])){
$search =$_POST['search'];

if(!empty($search)){
$sql = "select  id, st.\"code\" AS CODIGO , st.\"name\" AS NOMBRE ,dp.\"name\" AS DPTO, mn.\"name\" MUN
from drive_app.\"Stores\" st join drive_app.\"Sectors\" dp
on st.\"department\" = dp.\"code\"
join drive_app.\"Sectors\" mn on st.\"sector\" = mn.\"code\" 
where (upper(st.\"name\") like upper('%" .$search . "%') or upper(st.\"code\") like upper('%" .$search . "%') )

and st.complete = 'true'  and id in (select distinct \"StoreId\" from drive_app.\"Jobs\" where accepted is not null)  limit 5" ;
} else {
$sql = "select  id, st.\"code\" , st.\"name\" AS NOMBRE,dp.\"name\" DPTO, mn.\"name\" MUN, 
st.\"scheduled\" SCH, st.\"complete\" COMP
from drive_app.\"Stores\" st join drive_app.\"Sectors\" dp
on st.\"department\" = dp.\"code\"
join drive_app.\"Sectors\" mn on st.\"sector\" = mn.\"code\"
where st.complete = 'true' and id in (select distinct \"StoreId\" from drive_app.\"Jobs\" where accepted is not null) 
limit 5" ;
}
//echo $sql;


$result = pg_query($conn, $sql);


if ($result) {
    $jsonStores = array();
//	foreach (pg_fetch_row($result) as $row) {
while ($row = pg_fetch_row($result)) {
       /* $jsonStores[] = array(
            'CODIGO' ->> $row["CODIGO"],
            'NOMBRE'->> $row["NOMBRE"],
            'DPTO'-> $row["DPTO"],
			'MUN' -> $row["MUN"]		
        );  
*/
  $jsonStores[] = $row;
		
    }
    

}
//echo $jsonStores;
$jsonStCli = json_encode($jsonStores);
echo $jsonStCli;
}

?>