<?php
session_start();
if(!isset($_SESSION['id']) or $_SESSION['tipo_usuario']!='gerencia')
	header("Location:../../index.php");
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
				<p>Welcome, <strong>USUARIO </strong> [ <a href="../logout.php">logout</a> ]</p>
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
					
					<li class="upp"><a>Administrar Libretas</a>
						<ul>
							<li class="upp"><a href="adm_libretas.php">Libreta de Notas</a></li>
						</ul>
					</li>
					<li class="upp"><a>Administradores</a>
						<ul>
							<li class="upp"><a href="admins.php">Administradores</a></li>
						</ul>
					</li>
			</ul>
		</div>
	</div>
	
	<div id="content">
		<div><h2>Menu</h2></div>

		<div id="sidebar">
			<div class="box">
				<div class="h_title">&#8250; Inicio</div>
				<ul>
					<li class="b1"><a href="index.php">Inicio</a></li>
				</ul>

				<div class="h_title">&#8250; Administrar Alumnos</div>
				<ul >
					<li class="b1"><a href="lista_alumnos.php">Alumnos</a></li>
					<li class="b1"><a href="vista_modulos.php">Vista por Modulos</a></li>
				</ul>
				<div class="h_title">&#8250; Pago de Libreta de Notas</div>
				<ul>
					<li class="b1"><a href="adm_libretas.php">Pago de Libreta de Notas</a></li>
				</ul>
				<div class="h_title">&#8250; Administradores</div>
				<ul>
					<li class="b1"><a href="admins.php">Administradores</a></li>
				</ul>
			</div>
		</div>

                
            
		<div id="main">
			<div class="full_w">

				
				<h1>Nómina de Matricula</h1>




					<?php

			
						require_once ("../../datos/generico.class.php");
						$modulo=$_GET['modulo'];

						$fecha_inicio=$_GET['fecha_inicio'];
						$fecha_fin=$_GET['fecha_fin'];
						$horario=$_GET['horario'];
						$nombre_modulo=$_GET['nombre_modulo'];

						echo "
								<table>
									<tr>
										<td><strong>REGION:</strong></td>
										<td>Arequipa</td>
										<td><strong>UGEL:</strong></td>
										<td>Norte</td>
										<td><strong>CETPRO:</strong></td>
										<td>ESCOMAPE</td>
									</tr>

									<tr>
										<td><strong>GESTIÓN PÚBLICA</strong></td>
										<td></td>
										<td><strong>GESTIÓN PRIVADA</strong></td>
										<td>X</td>
										<td><strong>CONVENIO</strong></td>
									</tr>

									<tr>
										<td><strong>RESOLUCIÓN DE CREACIÓN</strong></td>
										<td colspan='2' >000135-2008 UGEL AN</td>
										<td><strong>RESOLUCIÓN DIRECTORAL MODULO</strong></td>
										<td colspan='2' >R.D. 0039-2013</td>
									</tr>

									<tr>
										<td><strong>PROVINCIA</strong></td>
										<td colspan='2'>Arequipa</td>
										<td><strong>DISTRITO</strong></td>
										<td colspan='2'>Arequipa</td>
									</tr>
									<tr>
										<td><strong>LUGAR</strong></td>
										<td colspan='2'>Arequipa</td>
										<td><strong>DIRECCIÓN</strong></td>
										<td colspan='2'>Av. Independencia 510</td>
									</tr>
									<tr>
										<td colspan='3'><strong>OPCIÓN OPCUPACIONAL O ESPECIALIDAD</strong></td>
										<td colspan='3'>Transporte Terrestre y Operación de Equipo Pesado</td>
									</tr>
									<tr>
										<td><strong>MODULO</strong></td>
										<td colspan='2'>".$nombre_modulo."</td>
										<td><strong>CICLO</strong></td>
										<td colspan='2'>Medio</td>
									</tr>
									<tr>
										<td><strong>FECHA DE INICIO</strong></td>
										<td >".$fecha_inicio."</td>
										<td><strong>TERMINO</strong></td>
										<td >".$fecha_fin."</td>
										<td><strong>TURNO</strong></td>
										<td >".$horario."</td>
									</tr>
									
								</table>";



						date_default_timezone_set('UTC');
						$id =$_REQUEST['modulo'];
						$objcon=new BDgenerico();
						$objcon->conectar();
						$objcon->selectdb();
						$sql="select id,nombres, ap_paterno,ap_materno,sexo,year(fecha_nac) from h_notas left join dim_alumno on (h_notas.id_alumno = dim_alumno.id) where fecha_inicio='$fecha_inicio' and modulo='$modulo' and horario='$horario' group by modulo, fecha_inicio asc,fecha_fin,horario";
						$result=$objcon->cSimple($sql);
						$resp=$objcon->nRegistros($result);
						if($resp==0) 
							die("No hay registros para mostrar");
						
						else
						{
							echo '
						<table  style="width: 650px;" border="1">
							<thead>
								<tr>
									<th scope="col" style="width: 20px;">Nro</th>
									<th scope="col" class="align-left" style="width: 50px;">Codigo</th>
									<th scope="col" class="align-left" style="width: 250;">Alumno</th>
									<th scope="col" style="width: 50px;">Sexo</th>
									<th scope="col" style="width: 50px;">Edad</th>
									
								</tr>
							</thead>
						<tbody>';
						$cont=1;
						while($row=mysql_fetch_array($result))
						{
							$edad=(int)date('Y')-(int)$row[5];
							echo'
								<tr>
									<td class="align-center">'.$cont.'</td>										
									<td class="align-center">'.$row[0].'</td>
									<td>'.$row[1].' '.$row[2].' '.$row[3].'</td>
									<td class="align-center">'.$row[4].'</td>
									<td class="align-center">'.$edad.'</td>
									
								</tr>
								';
							$cont=$cont+1;
							}
							

						}
						

						?>
						
				</tbody>
				</table>
				
			</div>
		</div>
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
