$(document).ready(function() {


$('#startDate').datepicker({
    autoclose: true
  //  onSelect: function () {
           
    //    }
});

$('#endDate').datepicker({
    autoclose: true
});



    console.log("funciona");
//Cargar tiendas
    $('#search').keyup(function(e) {
        let search = $('#search').val();
//getDTable();
$.ajax({
            url: 'getStore.php',
            type: 'POST',
            data: { search: search },
            success: function(response) {
                let clientes = JSON.parse(response);
                let template = '';
                let i = 0;
                
                clientes.forEach(clientes => {

                    template += ` <tr codTienda="${clientes[1]}">
        <td>${clientes[1]}</td> 
        <td><a class="btnNom" href="#" id="btnNom" name="btnNom">${clientes[2]}</a></td>
        <td>${clientes[3]}</td>
        <td>${clientes[4]}</td>;
    
        </tr>;
                                `

                });
                $('#container').html(template)
            }
        })
    })
//Cargar trabajos
  $(document).on('click', '.btnNom', function() {
        let element = $(this)[0].parentElement.parentElement;
        let id = $(element).attr('codTienda');
        $.post('GetJob.php', { id }, function(response) {
            console.log(response);

            let task = JSON.parse(response);

//if (0 == 0) {
//Info tienda
try {
document.getElementById('lblCodTienda').innerHTML = task[0][0];
document.getElementById('lblNomTienda').innerHTML = task[0][1];
 document.getElementById('lblCliente').innerHTML = task[0][25];
 document.getElementById('lblTelCliente').innerHTML = task[0][26];
 //Info tarea
document.getElementById('lblDate').innerHTML = task[0][21];
document.getElementById('lblNomP').innerHTML = task[0][9];
document.getElementById('lblBanner').innerHTML = task[0][10];
document.getElementById('lblPorta').innerHTML = task[0][11];
document.getElementById('lblAfi').innerHTML = task[0][12];
document.getElementById('lblLego').innerHTML = task[0][13];
document.getElementById('lblGlori').innerHTML = task[0][14];
document.getElementById('lblBande').innerHTML = task[0][15];
document.getElementById("txtCom").value = task[0][16];  
document.getElementById('lblMts2').innerHTML = task[0][27];
 //imagenes
$('#BF01').attr('src',task[0][2]);
if(task[0][3].length >0){ $('#BF02').attr('src',task[0][3]);} else {$('#BF02').attr('src','IMG/images.png');} 
$('#BF03').attr('src',task[0][4]);
$('#AF01').attr('src',task[0][5]);

if(task[0][6].length >0){ $('#AF02').attr('src',task[0][6]);} else {$('#AF02').attr('src','IMG/images.png');} 
//$('#AF02').attr('src',task[0][6]);
$('#AF03').attr('src',task[0][7]);

$('#ACEPT').attr('src',task[0][8]);
}
catch (e)
{
    alert("Esta tienda sigue en proceso");
}
            //$('#AF01').val("PRUEBA");
			
            /*$('#f2').val(task[1].DESCRIPCION);
            $('#f3').val(task[2].DESCRIPCION);
            $('#v1').val(Intl.NumberFormat("en-US", { style: 'currency', currency: 'USD' }).format(task[0].VENTA));
            $('#v2').val(Intl.NumberFormat("en-US", { style: 'currency', currency: 'USD' }).format(task[1].VENTA));
            $('#v3').val(Intl.NumberFormat("en-US", { style: 'currency', currency: 'USD' }).format(task[2].VENTA));
*/
        })

    })

	
	
});