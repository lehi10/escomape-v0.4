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
<script> function validar()
{ 
	var p1 = document.getElementById("pass").value;
	var p2 = document.getElementById("re_pass").value;
	if (p1 != p2)
	{
  		alert("Las contraseñas deben coincidir");
  		return false;
  	}
  	else 
  	{
  		return true;
	}
} 
</script>

<script>
function conf_eliminar() {
    if (confirm("Esta seguro de eliminar al Administrador ") == true) {
        return true;
    } else {
        return false;
    }

}
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
				
				<h1>Administradores</h1>

				<!--  CONTENIDO--> 

				<?php
					require_once ("../../datos/generico.class.php");

					$objcon=new BDgenerico();
					$objcon->conectar();
					$objcon->selectdb();
					$sql="SELECT * FROM su_adm;";
					$result=$objcon->cSimple($sql);
					$resp=$objcon->nRegistros($result);

					if($resp==0) 
						die("No hay registros para mostrar");

					echo "<table >";

					 echo "<tr>
					       <tr>
					         <th scope='col' style='width: 50px;'>ID </th>
					         <th scope='col' style='width: 100px;'>Permisos</th>
					         <th scope='col'>Nombres</th> 
					         <th scope='col'>Apellidos</th>
					         <th scope='col' style='width: 50px;'>Eliminar</th> 

					      </tr>";
					while($row=mysql_fetch_array($result))
					{

					 echo "<tr>
					         <td class='align-center'> $row[0] </td>
					         <td class='align-center'> $row[1] </td>
					         <td> $row[2] </td>
					         <td> $row[3] </td>
					         <td class='align-center'><a href='eliminar_adm.php?id=$row[0]' class='table-icon delete' title='Ver' onclick='return conf_eliminar()'></a></td>
					      </tr>";
					}
					echo "</table>";
				?>




				<h2>Cambiar Permisos </h2>
				<form class="contact_form" method="post" action="modificar_adm.php">
					 <table>

						<tr>
							<td>
								<label for="id">Id de Usuario:</label>
							</td>
							<td>
								<input type="text" required="" placeholder="ID" name="id"></input>
							</td>
						</tr>
						<tr>
							<td>
								<label for="permiso">Tipo de Permiso:</label>
							</td>
							<td>
								<SELECT style='width: 150px;' NAME="permiso"  > 
									<OPTION VALUE="libreta">Libretas</OPTION>
									<OPTION VALUE="-">-</OPTION>
									
								</SELECT> 
							</td>
						</tr>

					 </table>
				 <center>
				 	<button class="submit" type="submit">Enviar</button>
				 </center>
				    
				</form>



				<h2>Agregar Administradoress </h2>
				<form class="contact_form"  method="post" onSubmit="return validar() "action="agregar_adm.php">
					 <table>
						<tr>
							<td>
								<label for="id">Id del Administrador:</label>
							</td>
							<td>
								<input type="text" required="" placeholder="ID" name="id"></input>
							</td>
						</tr>
						<tr>
							<td>
								<label for="id">Contraseña del Administrador:</label>
							</td>
							<td>
								<input type="password" required="" placeholder="Contraseña" id="pass" name="pass"></input>
							</td>
						</tr>
						<tr>
							<td>
								<label for="id">Repira la contraseña:</label>
							</td>
							<td>
								<input type="password" required="" placeholder="Contraseña" id="re_pass" name="re_pass"></input>
							</td>
						</tr>
						<tr>
							<td>
								<label for="id">Nombre del Administrador:</label>
							</td>
							<td>
								<input type="text" required="" placeholder="Nombres" name="nombre"></input>
							</td>
						</tr>
						<tr>
							<td>
								<label for="id">Apellidos del Administrador:</label>
							</td>
							<td>
								<input type="text" required="" placeholder="Apellidos" name="apellidos"></input>
							</td>
						</tr>
						<tr>
							<td>
								<label for="permiso">Tipo de Permiso:</label>
							</td>
							<td>
								<SELECT style='width: 150px;' NAME="permiso"> 
									<OPTION VALUE="-">-</OPTION>
									<OPTION VALUE="libreta">Libretas</OPTION> 	
								</SELECT> 
							</td>
						</tr>

					 </table>
				 <center>
				 	<button class="submit" type="submit" 	>Enviar</button>
				 </center>
				    
				</form>





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

