<?php
session_start();
if(!isset($_SESSION['id']) or $_SESSION['tipo_usuario']!='gerencia'  )
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
					<img src="../../img/logo.png"  width="200">
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
				
				<h1>Libretas</h1>
				<!--  COMPRA DE LIBRETA--> 
				 <h3>Compra Libreta</h3>
				<form class="contact_form" method="post" action="compra_libreta.php">
					<table style="width: 600px">
						<tr>
							<td>
								<label for="id">Id Alumno:</label>
							</td>
							<td>
								<input type="text" required="" placeholder="ID" name="id"></input>
							</td>
						</tr>
						
					</table>

					<center>
						<button class="submit" type="submit">Abrir</button>
					</center>
				    
				</form>

				 <h2>Reporte de Ingresos</h2>
				 <h3>Reporte por Día</h3>

				<form class="contact_form" method="post" action="reporte_ingresos_por_dia.php">
					<table style="width: 600px">
						<tr>
							<td>
								<label for="id">Seleccionar Fecha:</label>
							</td>
							<td>
								<input type="date" name="fecha">
							</td>
						</tr>
						
					</table>

					<center>
						<button class="submit" type="submit">Abrir</button>
					</center>
				    
				</form>

				<h3>Reporte por Mes</h3>

				<form class="contact_form" method="post" action="reporte_ingresos_por_mes.php">
					<table style="width: 600px">
						<tr>
							<td>
								<label for="id">Seleccionar Mes:</label>
							</td>

							<td>
								<input type="month" name="mes">
							</td>
						</tr>
						
					</table>

					<center>
						<button class="submit" type="submit">Abrir</button>
					</center>
				    
				</form>

					 <!--               FIN DE COMPRA DE LIBRETA                 -->					
			 <h3>Informacion De Compras de Facturas de hoy</h3>
				 <?php
					require_once ("../../datos/generico.class.php");
					
					date_default_timezone_set('UTC');
					$fecha= date("Y-m-d");
					$objcon=new BDgenerico();
					$objcon->conectar();
					$objcon->selectdb();
					$sql="select id,nombres,ap_paterno,ap_materno, boleta,cant_comprada,precio,fecha from ingresos_web left join dim_alumno on (ingresos_web.alumno= dim_alumno.id) where fecha='$fecha'";
					
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

			</div>
		</div>




		<div class="clear"></div>
	</div>

	<div id="footer">
		<div class="left">
			<p>Design: <a href="">Sixx</a> | Admin Panel: <a href="">ESCOMAPE</a></p>
		</div>
	</div>
</div>

</body>
</html>
