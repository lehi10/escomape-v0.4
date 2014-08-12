
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
				
				<h1>Libretas</h1>
				 				<!--  CONTENIDO--> 
				 <h3>Informacion del Alumno</h3>

				 

				 <?php
					require_once ("../../datos/generico.class.php");
					if($_REQUEST['id'])
						$id=$_REQUEST['id'];
					if($_GET['id'])
						$id=$_GET['id'];

					$objcon=new BDgenerico();
					$objcon->conectar();
					$objcon->selectdb();
					$sql="SELECT id,nombres,ap_paterno,ap_materno,consultas_rest FROM h_usuarios inner join dim_alumno on (h_usuarios.id_usuario = dim_alumno.id) where id='$id';";
					
					$result=$objcon->cSimple($sql);
					$resp=$objcon->nRegistros($result);

					if($resp==0) 
						die("<center><h2> No hay registros para mostrar </h2></center>");

					echo "<table >";

					 echo "<tr>
					       <tr>
					         <th scope='col' style='width: 50px;'>ID </th>
					         <th scope='col' >Apellidos</th>
					         <th scope='col'>Nombres</th> 
					         <th scope='col'style='width: 100px;'>Descargas</th> 
					      </tr>";
					while($row=mysql_fetch_array($result))
					{
					 echo "<tr>
					         <td class='align-center'> $row[0] </td>
					         <td> $row[2] $row[3] </td>
					         <td> $row[1] </td>
					         <td class='align-center'> $row[4] </td>
					      </tr>";
					}
					echo "</table>";
				?>



				<form class="contact_form" method="post" action="compra_libreta_update.php?id=<?php echo $id; ?>" >
					<table style="width: 600px">
						
						<tr>
							<td>
								<label for="permiso">Cantidad:</label>
							</td>
							<td>
								<SELECT style='width: 150px;' NAME="cantidad"  > 
									<OPTION VALUE="3">3 </OPTION>
									<OPTION VALUE="5">5</OPTION>
									<OPTION VALUE="7">7</OPTION>
								</SELECT> 
							</td>
						</tr>
						<tr>
							<td>
								<label for="nboleta">N° de Boleta:</label>
							</td>
							<td>
								<input type="text" required="" placeholder="N° de boleta" name="boleta"></input>
							</td>
						</tr>
						<tr>
							<td>
								<label for="costo">Costo:</label>
							</td>
							<td>
								<input type="text" required="" placeholder="S/." name="costo"></input>
							</td>
						</tr>
					</table>
					<center>
						<button class="submit" type="submit">Comprar</button>
					</center>
				    
				</form>
					 <!--               FIN DE COMPRA DE LIBRETA                 -->					

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
