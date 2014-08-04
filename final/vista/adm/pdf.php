<?php
session_start();

if(!isset($_SESSION['id']) or $_SESSION['tipo_usuario']!='adm')
	{
		header("Location:../logout.php");
	}

ob_start(); 

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

<script type="text/javascript">
function imprSelec(muestra)
{
	var ficha=document.getElementById(muestra);
	var ventimp=window.open(' ','popimpr');
	ventimp.document.write(ficha.innerHTML);
	ventimp.document.close();
	ventimp.print();
	ventimp.close();
}
</script>
<script type="text/javascript">
var doc = new jsPDF();
// We'll make our own renderer to skip this editor
var specialElementHandlers = 
{
	'#editor': function(element, renderer)
	{
		return true;
	}
};

doc.fromHTML($('body').get(0), 15, 15, {'width': 170,'elementHandlers': specialElementHandlers});


</script>
</head>

<body>

<div id="main">
			<div id="full_w" class="full_w">
				<div class="h_title">Libreta de Notas</div>
					<div id="to_print">
						<h1>LIBRETA DE NOTAS</h1>
							
						<?php
							require_once ("../../datos/generico.class.php");
							$id =$_GET['id'];
							$objcon=new BDgenerico();
							$objcon->conectar();
							$objcon->selectdb();
							$sql="SELECT * FROM dim_alumno where id= '$id' ";
							

							
							$result=$objcon->cSimple($sql);
							$resp=$objcon->nRegistros($result);
							$row=mysql_fetch_array($result);


							echo "
								<table>
									<tr>
										<td>
											<strong>Apellidos y Nombres:</strong>			
										</td>
										<td>
											".$row['ap_paterno']." ".$row['ap_materno']." ".$row['nombres']."
										</td>
									</tr>
									<tr>
										<td>
											<strong>Horario:</strong>
										</td>
										<td>
											Horario
										</td>
									</tr>
									<tr>
										<td>
											<strong>Especialidad:</strong>
										</td>
										<td>
											Operación de Maquinaria Pesada
										</td>
									</tr>
									<tr>
										<td>
											<strong>Fecha de Inicio</strong>
										</td>
										<td>
											Fecha de inicio
										</td>
									</tr>
									
								</table>";
						?>
						<center>
						<table  style="width: 760px;" border="1">
								<thead>
									<tr>
										<th scope="col" class="align-left" style="width: 200px;">Curso</th>
										<th scope="col" style="width: 70px;">Inicio</th>
										<th scope="col" style="width: 70px;">Fin</th>
										<th scope="col" style="width: 40px;">Operación</th>
										<th scope="col" style="width: 40px;">Mecánica</th>
										<th scope="col" style="width: 40px;">Ing.Técnico</th>
										<th scope="col" style="width: 40px;">Seguridad</th>
										<th scope="col" style="width: 40px;" >Gestión</th>
									</tr>
								</thead>
							<tbody>

								<?php
								$sql="SELECT * FROM h_notas where id_alumno= '$id' ";
								$result=$objcon->cSimple($sql);
								$resp=$objcon->nRegistros($result);
								if($resp==0) 
									die("No hay registros para mostrar");
								while($row=mysql_fetch_array($result))
								{
									echo'
										<tr>
											<td>'.$row['maquina'].'</td>
											<td class="align-center">'.$row['fecha_inicio'].'</td>
											<td class="align-center">'.$row['fecha_fin'].'</td>
											<td class="align-center">'.$row['nota_c1'].'</td>
											<td class="align-center">'.$row['nota_c2'].'</td>
											<td class="align-center">'.$row['nota_c3'].'</td>
											<td class="align-center">'.$row['nota_c4'].'</td>
											<td class="align-center">'.$row['nota_c5'].'</td>	
										</tr>
										';
									}

								?>
								

								</tbody>
							</table>
							
						</center>
						
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
$filename = "libreta.pdf";
//file_put_contents($filename, $pdf); // para guardar el archivo creado
$dompdf->stream($filename);
?>