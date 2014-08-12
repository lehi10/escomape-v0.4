<?php
require_once ("../../datos/generico.class.php");

$id=$_REQUEST['id'];

$objcon=new BDgenerico();
$objcon->conectar();
$objcon->selectdb();


$sql="DELETE FROM su_adm WHERE id='$id';";
$result=$objcon->cSimple($sql);
$sql="DELETE FROM `h_usuarios` WHERE id_usuario='$id';";
$result=$objcon->cSimple($sql);
$objcon->desconectar();

header("Location:admins.php");

?>
