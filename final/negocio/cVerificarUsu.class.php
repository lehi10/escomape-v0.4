<?php
require_once("negocio.inc.php");
class cVerificarUsu
{
	private $login;
	private $pass;
	private $objcon;
	private $existe;
	private $tipo_usu;
	private $cant_descargas;
	private $permiso;
	public function cVerificarUsu($login,$pass)
	{
		$this->login=$login;
		$this->pass=$pass;
		$this->objcon=new BDgenerico();
		$this->objcon->conectar();
		$this->objcon->selectdb();
		$sql="select * from h_usuarios where id_usuario='$login' and pass='$pass'";
		$result= $this->objcon->cSimple($sql);
		$resp=$this->objcon->nRegistros($result);

		if($resp>0)
		{
			$this->existe=true;
			$row=mysql_fetch_row($result);
			$this->tipo_usu= $row[3];
			if($this->tipo_usu=="alumno");
				{
					$this->cant_descargas=$row[2];
				}
			if($this->tipo_usu=="adm")
			{
				$sql_perm="SELECT * from su_adm  where id='$login';";
				$result_perm=$this->objcon->cSimple($sql_perm);
				$n_perm_adm=$this->objcon->nRegistros($result_perm);
				
				if($n_perm_adm > 0)
				{
					$row_su_adm=mysql_fetch_row($result_perm);
					$this->permiso=$row_su_adm[1];
					
				}

			}
		}
		else
		{
			$this->existe=false;
			$this->objcon->desconectar();
		}

		return $resp;
	}
	public function Existe()
	{
		return $this->existe;
	}
	public function tipo_usuario()
	{
		return $this->tipo_usu;
	}
	public function cant_descargas_res()
	{
		return $this->cant_descargas;
	}
	public function permiso()
	{
		return $this->permiso;
	}
}

?>