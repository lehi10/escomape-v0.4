
<?php
session_start();

if(!isset($_SESSION['id']) or $_SESSION['tipo_usuario']!='gerencia' )
	{
		header("Location:../logout.php");
	}

ob_start(); 

$fecha=$_REQUEST['mes'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pl" xml:lang="pl">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Admin</title>
<link rel="stylesheet" type="text/css" href="../../css/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="../../css/navi.css" media="screen" />
<script type="text/javascript" src="../../js/jquery-1.7.2.min.js"></script>
<script type="text/javascript">
$(function(){
	$(".box .h_title").not(this).next("ul").hide("normal");
	$(".box .h_title").not(this).next("#home").show("normal");
	$(".box").children(".h_title").click( function() { $(this).next("ul").slideToggle(); });
});
</script>
</head>

<body>

<div id="main">
			<div id="full_w" class="full_w">
				<div class="h_title">Reporte de Notas</div>
					<div id="to_print">

							
								<?php
								require_once ("../../datos/generico.class.php");
								
								$objcon=new BDgenerico();
								$objcon->conectar();
								$objcon->selectdb();
								$sql="select id,nombres,ap_paterno,ap_materno, boleta,cant_comprada,precio,fecha from ingresos_web left join dim_alumno on (ingresos_web.alumno= dim_alumno.id) where fecha like'$fecha%'";
								
								$result=$objcon->cSimple($sql);
								$resp=$objcon->nRegistros($result);

								if($resp==0) 
									die("<center><h2> No hay registros para mostrar </h2></center>");

								echo "<table >";

								 echo "<tr>
								       <tr>
								         <th scope='col' style='width: 50px;'>ID </th>
								         <th scope='col' >Alumno</th>
								         <th scope='col' >N°Boleta</th>
								         <th scope='col'>Cant</th> 
								         <th scope='col'>Precio</th> 
								         <th scope='col'>Fecha</th> 
								      </tr>";
								while($row=mysql_fetch_array($result))
								{
								 echo "<tr>
								         <td class='align-center'> $row[0] </td>
								         <td> $row[1] $row[2] $row[3]</td>
								         <td> $row[4] </td>
								         <td> $row[5] </td>
								         <td> $row[6] </td>
								         <td class='align-center'> $row[7] </td>
								      </tr>";
								}
								echo "</table>";
							?>
								
							<div>
							<table style="width: 800px;">
								<tr>
									<td class="align-right">
										Fecha de Emisión   <?php echo date("d/m/Y");?> 	
									</td>
									<td class="align-right">
										 Hora de Emisión <?php echo date("H:i");?>
									</td>
									
								</tr>
							</table>
					</div>				
			</div>
		<div class="clear"></div>
	</div>

	
</body>







<?php
require_once("../../libs/dompdf/dompdf_config.inc.php");
$dompdf = new DOMPDF();
$dompdf->load_html(ob_get_clean());
$dompdf->render();
$pdf = $dompdf->output();
$filename = "reporte-$fecha.pdf";
//file_put_contents($filename, $pdf); // para guardar el archivo creado
$dompdf->stream($filename);
?>