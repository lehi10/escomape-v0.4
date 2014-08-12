<?php
require_once ("../../datos/generico.class.php");

$id=$_REQUEST['id'];
$pass=$_REQUEST['pass'];
$re_pass=$_REQUEST['re_pass'];
$nombres=$_REQUEST['nombre'];
$apellidos=$_REQUEST['apellidos'];
$permiso=$_REQUEST['permiso'];


$objcon=new BDgenerico();
$objcon->conectar();
$objcon->selectdb();


$sql="INSERT INTO su_adm (id,permisos,nombres,apellidos) VALUES ('$id', '$permiso', '$nombres', '$apellidos');";
$result=$objcon->cSimple($sql);
$sql="INSERT INTO `h_usuarios` (`id_usuario`, `pass`, `consultas_rest`, `tipo_usuario`) VALUES ('$id', '$pass', '-1', 'adm');";
$result=$objcon->cSimple($sql);
$objcon->desconectar();

header("Location:admins.php");

?>
