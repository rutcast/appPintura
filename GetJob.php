<?php


$conn = pg_connect("host= funesh-db.cml6c4rzjcyk.us-east-1.rds.amazonaws.com dbname= drive_app port = 5432 user = gil password =funesTestPassword") or die ("Error de Conexión".pg_last_error());

if(isset($_POST['id'])){
$id =$_POST['id'];

$sql ="";

   // echo "<script>alert('$id');</script>";
	
if(!empty($id)){
$sql = "SELECT distinct st.\"code\" ID, trim(ST.name) nombre, 
jb.before1, jb.before2, jb.before3, 
jb.after1, jb.after2, jb.after3, 
jb.accepted, case when jb.name = 'TRUE' then 'SI' else 'NO' end NombreP,
case when jb.picture1 = 'TRUE' then 'SI' else 'NO' end Rot1,case when jb.picture2 = 'TRUE' then 'SI' else 'NO' end Rot4,
case when jb.picture3 = 'TRUE' then 'SI' else 'NO' end Rot2,case when jb.picture4 = 'TRUE' then 'SI' else 'NO' end Rot5,
case when jb.picture5 = 'TRUE' then 'SI' else 'NO' end Rot3,case when jb.picture6 = 'TRUE' then 'SI' else 'NO'end Rot6,
COALESCE(jb.comments,'Sin Comentarios'), jb.active, jb.completed, jb.reescheduled, 
to_timestamp(CAST(\"created\" as bigint)/1000) fec_llegada, date(jb.\"createdAt\") fec_cierre, jb.\"updatedAt\" fec_confirma, 
jb.\"ScheduleId\", jb.\"StoreId\" ,st.client NomCliente, st.phone TelCliente, round(mts.mtsp,2)
	FROM drive_app.\"Jobs\" jb 
	join drive_app.\"Stores\" st on jb.\"StoreId\" = st.id
	join drive_app.\"VwMtsPintados\" mts on mts.id = jb.id
where jb.completed = 'TRUE' and jb.accepted is not null
AND st.\"code\" = '".$id."'" ;
}
//echo $sql;


 //   echo "<script>alert('$id');</script>";
	

$result = pg_query($conn, $sql);


if ($result) {
    $jsonStores = array();
//	foreach (pg_fetch_row($result) as $row) {
while ($row = pg_fetch_row($result)) {
       /* $jsonStores[] = array(
            'CODIGO' ->> $row["CODIGO"],
            'NOMBRE'->> $row["NOMBRE"],
            'DPTO'-> $row["DPTO"],
			'MUN' -> $row["MUN"],
            'SCH'-> $row["SCH"],
            'COMP'-> $row["COMP"]			
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