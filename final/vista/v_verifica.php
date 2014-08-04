<?php
require_once("../negocio/cVerificarUsu.class.php");
$log=$_POST["login"];
$pass=$_POST["password"];
$obj=new cVerificarUsu($log,$pass);


if($obj->Existe())
{
	session_start();
	$_SESSION['flag']=true;
	$_SESSION['id']=$log;
	$_SESSION['pass']=$pass;
//------------ OBTENER TIPO DE USUARIO--------ADM----ALUMNO----GERENCIA-------
	$tipo_usu=$obj->tipo_usuario();
	$_SESSION['tipo_usuario']=$tipo_usu;
	
//-----------SI EL TIPO DE USUARIO ES ALUMNO---------------
	$cant_descargas_res=$obj->cant_descargas_res();
	$_SESSION['cant_descargas']=$cant_descargas_res;

//-----------SI EL TIPO DE USUARIO ES UN ADM---------------	
	
	$perm_adm=$obj->permiso();
	$_SESSION['permiso_adm']=$perm_adm;


	if($tipo_usu=="alumno" and $cant_descargas_res<=0)
	{
		header("Location:../index.php");
	}
	header("Location: $tipo_usu");
}
else
{
	header("Location:../index.php");
}

?>