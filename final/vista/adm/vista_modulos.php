
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
	
	<div id="content">
		<div><h2>Menu</h2></div>

		<div id="sidebar">
			<div class="box">
				<div class="h_title">&#8250; Inicio</div>
				<ul>
					<li class="b1"><a href="index.php">Inicio</a></li>
				</ul>
				<div class="h_title">&#8250; Administrar Alumnos</div>
				<ul id="diario">
					<li class="b1"><a href="lista_alumnos.php">Alumnos</a></li>
					<li class="b1"><a href="vista_modulos.php">Vista Modulos</a></li>
				</ul>
				<?php

					if($_SESSION['permiso_adm']=="libreta")
					{
						echo "<div class='h_title'>&#8250; Pago de Libreta de Notas</div>
						<ul>
							<li class='b1'><a href='adm_libretas.php'>Pago de Libreta de Notas</a></li>
						</ul>";
					}
				?>
			</div>
		</div>
                
            
		<div id="main">
			<div class="full_w">
				
				<h1>Información</h1>

				<!--  CONTENIDO--> 
				<form class="contact_form" method="post" action="lista_modulos.php">
					<table style="width: 600px">
						<tr>
							<td>
								<label for="id">Modulo:</label>
							</td>
							<td>
								<SELECT name="modulo" size=1  style="width: 200px;"> 
									<OPTION VALUE="I">MODULO I</OPTION>
									<OPTION VALUE="II">MODULO II</OPTION>
									<OPTION VALUE="III">MODULO III</OPTION>
									<OPTION VALUE="IV">MODULO IV</OPTION> 
									<OPTION VALUE="V">MODULO V</OPTION> 
									<OPTION VALUE="VI">MODULO VI</OPTION> 
								</SELECT> 
								
							</td>
						</tr>

					</table>

					<center>
						<button class="submit" type="submit">Buscar</button>
					</center>
				</form>

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
