<?php
require_once("dbconfig.php");
/**
* Clase generica para la conexion a la base de datos
*/
class BDgenerico 
{
	private $server=DB_HOST;
	private $user=DB_USER;
	private $pass=DB_PASS;
	private $db=DB_NAME;
	private $con;
	private $flag= false;

	function conectar()
	{
		$this->con=@mysql_connect($this->server,$this->user,$this->pass);
		$this->flag=true;
		return $this->con;
	}

	function desconectar()
	{
		if($this->flag==true)
		{
			@mysql_close($this->con);
		}
	}

	function selectdb()
	{
		$res=@mysql_select_db($this->db,$this->con);
		if($res)
		{
			return true;
		}
		else 
		{
			return false;
		}
	}
	function cSimple($query)
	{
		return @mysql_db_query($this->db,$query);
	}
	function rObjetos($query)
	{
		return @mysql_fetch_object($query);
	}
	function rAsocuativo($query)
	{
		$aArea=array();
		$cont =0;
		while ($row=@mysql_fetch_assoc($query)) 
		{
			foreach ($row as $clave => $valor) 
			{
				$vector[$clave]=$valor;
			}
			$aArea[$cont]=$vector;
			$cont++;
		}
		return $aArea;
	}

	function nRegistros($query)
	{
		return @mysql_num_rows($query);
	}

	function UnRegistro($query)
	{
		return @mysql_fetch_array($query);
	}	

}

?>