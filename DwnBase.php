<?php

$conn = pg_connect("host= funesh-db.cml6c4rzjcyk.us-east-1.rds.amazonaws.com dbname= drive_app port = 5432 user = gil password =funesTestPassword") or die ("Error de Conexión".pg_last_error());


//Query our MySQL table
$sql = "SELECT distinct date(jb.\"createdAt\") Fecha, st.\"code\" as \"Código Tienda\", trim(ST.name) as \"Nombre Tienda\",
st.client NomCliente, st.phone TelCliente, 
case when jb.name = 'TRUE' then 'SI' else 'NO' end as \"Nombre Pintado\",
case when jb.picture1 = 'TRUE' then 'SI' else 'NO' end as \"Rot1\",
case when jb.picture2 = 'TRUE' then 'SI' else 'NO' end as \"Rot2\",
case when jb.picture3 = 'TRUE' then 'SI' else 'NO' end as \"Rot3\",
case when jb.picture4 = 'TRUE' then 'SI' else 'NO' end as   \"Rot4\",
case when jb.picture5 = 'TRUE' then 'SI' else 'NO' end as \"Rot5\",
case when jb.picture6 = 'TRUE' then 'SI' else 'NO'end as \"Rot6\",
round(mts.mtsp,2) as Mts2,

--substring(jb.\"before1\",0,32000)bf1a ,substring(jb.\"before1\",32000,32000)bf1b, substring(jb.\"before1\",64000,32000)bf1c,
--substring(jb.\"before2\",0,32000)bf2a ,substring(jb.\"before2\",32000,32000)bf2b, substring(jb.\"before2\",64000,32000)bf2c,
--substring(jb.\"before3\",0,32000)bf3a ,substring(jb.\"before3\",32000,32000)bf3b, substring(jb.\"before3\",64000,32000)bf3c,
--substring(jb.\"after1\",0,32000)af1a ,substring(jb.\"after1\",32000,32000)af1b, substring(jb.\"after1\",64000,32000)af1c,
--substring(jb.\"after2\",0,32000)af2a ,substring(jb.\"after2\",32000,32000)af2b, substring(jb.\"after2\",64000,32000)af2c,
--substring(jb.\"after3\",0,32000)af3a ,substring(jb.\"after3\",32000,32000)af3b, substring(jb.\"after3\",64000,32000)af3c,
--substring(jb.\"accepted\",0,32000)acpa ,substring(jb.\"accepted\",32000,32000)acpb, substring(jb.\"accepted\",64000,32000)acpc,
COALESCE(jb.comments,'Sin Comentarios') comentarios
    FROM drive_app.\"Jobs\" jb 
    join drive_app.\"Stores\" st on jb.\"StoreId\" = st.id
    join drive_app.\"Binnacles\" bn 
    on jb.\"StoreId\" = st.id and jb.\"ScheduleId\" = bn.schedule
  join drive_app.\"VwMtsPintados\" mts on mts.id = jb.id
where jb.completed = 'TRUE' and jb.accepted is not null";



$result = pg_query($conn, $sql);

$filename = 'data.xls';

//Send the correct headers to the browser so that it knows
//it is downloading an Excel file.
header("Content-Type: application/xls");    
header("Content-Disposition: attachment; filename=data.xls");  
header("Pragma: no-cache"); 
header("Expires: 0");

$separator = "\t";

//Retrieve the data from our table.


//$rows = pg_fetch_row($result);
?>
<table>
<tr>
<th>Fecha</th>
<th>Codigo Tienda</th>
<th>Nombre Tienda</th>
<th>Nombre Cliente</th>
<th>Telefono Cliente</th>
<th>Nombre Pintado</th>
<th>Rotulo 1</th>
<th>Rotulo 2</th>
<th>Rotulo 3</th>
<th>Rotulo 4</th>
<th>Rotulo 5</th>
<th>Rotulo 6</th>
<th>Mts2</th>
<!--<th>Comentario</th>
<th>bf1a</th>
<th>bf1b</th>
<th>bf1c</th>
<th>bf2a</th>
<th>bf2b</th>
<th>bf2c</th>
<th>bf3a</th>
<th>bf3b</th>
<th>bf3c</th>
<th>af1a</th>
<th>af1b</th>
<th>af1c</th>
<th>af2a</th>
<th>af2b</th>
<th>af2c</th>
<th>af3a</th>
<th>af3b</th>
<th>af3c</th>
<th>acpa</th>
<th>acpb</th>
<th>acpc</th> -->

</tr>
<?php
while ($rows = pg_fetch_row($result)){
    ?>
    <tr>
        <td><?php echo $rows[0];?></td>
        <td><?php echo $rows[1];?></td>
        <td><?php echo $rows[2];?></td>
        <td><?php echo $rows[3];?></td>
        <td><?php echo $rows[4];?></td>
        <td><?php echo $rows[5];?></td>
        <td><?php echo $rows[6];?></td>
        <td><?php echo $rows[7];?></td>
        <td><?php echo $rows[8];?></td>
        <td><?php echo $rows[9];?></td>
        <td><?php echo $rows[10];?></td>
        <td><?php echo $rows[11];?></td>
        <td><?php echo $rows[12];?></td>
      <!--   <td><?php echo $rows[32];?></td>
       <td><?php echo $rows[11];?></td>
        <td><?php echo $rows[12];?></td>
        <td><?php echo $rows[13];?></td>
        <td><?php echo $rows[14];?></td>
        <td><?php echo $rows[15];?></td>
        <td><?php echo $rows[16];?></td>
        <td><?php echo $rows[17];?></td>
        <td><?php echo $rows[18];?></td>
        <td><?php echo $rows[19];?></td>
        <td><?php echo $rows[20];?></td>
        <td><?php echo $rows[21];?></td>
        <td><?php echo $rows[22];?></td>
        <td><?php echo $rows[23];?></td>
        <td><?php echo $rows[24];?></td>
        <td><?php echo $rows[25];?></td>
        <td><?php echo $rows[26];?></td>
        <td><?php echo $rows[27];?></td>
        <td><?php echo $rows[28];?></td>
        <td><?php echo $rows[29];?></td>
        <td><?php echo $rows[30];?></td>
        <td><?php echo $rows[31];?></td> -->        
    </tr>
    <?php
}
?>
</table>
<?php
//The name of the Excel file that we want to force the
//browser to download.

//Define the separator line

//If our query returned rows
/*if(!empty($rows)){


    //Dynamically print out the column names as the first row in the document.
    //This means that each Excel column will have a header.
    echo implode($separator, array_keys($rows[0])) . "\n";
    
    //Loop through the rows
    foreach($rows as $row){
        
        //Clean the data and remove any special characters that might conflict
        foreach($row as $k => $v){
            $row[$k] = str_replace($separator . "$", "", $row[$k]);
            $row[$k] = preg_replace("/\r\n|\n\r|\n|\r/", " ", $row[$k]);
            $row[$k] = trim($row[$k]);
        }
        
        //Implode and print the columns out using the 
        //$separator as the glue parameter
        echo implode($separator, $row) . "\n";
    }
}
*/

?>