<?php
session_start();
if($_SESSION['tipo_usuario']=="alumno")
{
	require_once("../datos/generico.class.php");

	$con=new BDgenerico ;
	$con->conectar();
	$con->selectdb();
	$query="SELECT consultas_rest FROM h_usuarios where id_usuario='".$_SESSION['id']."';";
	$result=$con->cSimple($query);
	$row=mysql_fetch_row($result);
	$cant=$row[0];
	if ($cant>0)
	{

		$new_cant=$cant-1;
		echo $new_cant;
		$query_update="UPDATE h_usuarios SET consultas_rest = $new_cant WHERE id_usuario = $_SESSION[id];";
		$result_update=$con->cSimple($query_update);
	}
	$con->desconectar();
}
session_unset();
session_destroy();
header("location:../index.php");
?>


