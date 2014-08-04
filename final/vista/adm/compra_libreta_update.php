<?php
require_once ("../../datos/generico.class.php");

$id=$_GET['id'];
$cantidad=$_REQUEST['cantidad'];
$costo=$_REQUEST['costo'];
$boleta=$_REQUEST['boleta'];
$objcon=new BDgenerico();
$objcon->conectar();
$objcon->selectdb();

$sql="UPDATE `h_usuarios` SET `consultas_rest`='$cantidad'  WHERE id_usuario='$id';";
$result=$objcon->cSimple($sql);
date_default_timezone_set('UTC');
$fecha= date("Y-m-d");
$sql_costo="INSERT INTO `ingresos_web` (`alumno`, `boleta`, `precio`,`cant_comprada`,`fecha`) VALUES ('$id', '$boleta', '$costo','$cantidad','$fecha'); ";
$result=$objcon->cSimple($sql_costo);
$objcon->desconectar();



echo "<script TYPE=\"text/javascript\">alert(\" Compra por $cantidad exitosa.\"); </script>	";
header("refresh:0;url=compra_libreta.php?id=$id");
?>