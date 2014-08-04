
<?php
session_start();
if(!isset($_SESSION['id']) or $_SESSION['tipo_usuario']!='adm'  )
	header("Location:../../index.php");
error_reporting(E_ERROR);

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
<div class="wrap">
	<div id="header">
		<div id="top">
			<div class="left">
				<p>Welcome, <strong>Administración </strong> [ <a href="../logout.php">logout</a> ]</p>
			</div>
			<div class="right">
				<div class="align-right">
					<p>Last login: <strong>00-00-2014 12:12</strong></p>
				</div>
			</div>
		</div>
		<div id="nav">
			<ul>
				<li class="upp"><a href="http://www.escomape.com">Pagina Principal</a></li>
				<li class="upp"><a href="index.php">Inicio</a></li>
				<li class="upp"><a>Administrar Alumnos</a>
					<ul>
						<li class="upp"><a href="lista_alumnos.php">Alumnos</a></li>
						<li class="upp"><a href="vista_modulos.php">Vista por Modulos</a></li>

					</ul>
				</li>
				
					<?php

					if($_SESSION['permiso_adm']=="libreta")
					{
							echo "<li class='upp'><a>Administrar Libretas</a>
							<ul>
								<li class='upp'><a href='adm_libretas.php'>Libreta de Notas</a></li>
							</ul>
						</li>";
					}
					
					?>
			</ul>
		</div>
	</div>
	
	

                
            
		<div id="main">
			<div class="full_w">
				
				<h1>INFORMACIÓN</h1>

							
						<?php

							require_once ("../../datos/generico.class.php");
							
							date_default_timezone_set('UTC');
							$id =$_REQUEST['id'];
							$objcon=new BDgenerico();
							$objcon->conectar();
							$objcon->selectdb();
							$sql="SELECT * FROM dim_alumno where id='$id' ";
							

							
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

						<table  style="width: 860px;" border="1">
								<thead>
									<tr>
										<th scope="col" class="align-left" style="width: 300px;">Curso</th>
										<th scope="col" style="width: 80px;">Inicio</th>
										<th scope="col" style="width: 80px;">Fin</th>
										<th scope="col" style="width: 50px;">Operación</th>
										<th scope="col" style="width: 50px;">Mecánica</th>
										<th scope="col" style="width: 50px;">Ing.Técnico</th>
										<th scope="col" style="width: 50px;">Seguridad</th>
										<th scope="col" style="width: 50px;" >Gestión</th>
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
<center><a class="button"  href="pdf.php?id=<?php echo $id; ?>">Descargar Libreta</a><a class="button"  href="javascript:imprSelec('to_print')">Imprimir Libreta</a></center>
		<br>



		<div class="clear"></div>
	</div>

	<div id="footer">
		<div class="left">
			<p>Design: <a href="">CSN</a> | Admin Panel: <a href="">Computer Science News</a></p>
		</div>
		<div class="right">
			<p><a href="">2014</a> | <a href="">Universidad Nacional de San Agustín</a></p>
		</div>
	</div>
</div>

</body>
</html>
