<?php
require_once ("../../datos/generico.class.php");

$id=$_REQUEST['id'];
$nuevo_permiso=$_REQUEST['permiso'];

$objcon=new BDgenerico();
$objcon->conectar();
$objcon->selectdb();

$sql="UPDATE `su_adm` SET `permisos`='$nuevo_permiso'  WHERE id='$id';";
$result=$objcon->cSimple($sql);
$objcon->desconectar();

header("Location:admins.php");

?>