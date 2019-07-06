<?php

class Usuario
{
	function __construct(){
		if(!isset($_SESSION) or session_status() !== PHP_SESSION_ACTIVE)
			session_start();
	}
	
	function Logado():bool
	{
		$logado = $_SESSION['Logado'] ?? false;
		if($logado === true){
			if(!isset($_SESSION['CLogado'])){
				if($_SESSION['limite'] < time()){
					$this->Deslogar();
					return false;
				}
			}
			return true;
		}
		return false;
	}
	
	function Deslogar():bool
	{
		unset($_SESSION);
		return session_decode();
	}
	
	function TempoRestante():int
	{
		if(isset($_SESSION['CLogado'])
			return -1;
		else
			return $_SESSION['limite'] - time();
	}
	
	function Cargo($cargo=-1):int
	{
		if($this->cargo == -1)
			return $_SESSION['Cargo'];
		else
			return $_SESSION['Cargo'] = $cargo;
	}
	
	function SetMensagem($tipo,$msg){
		if(!isset($_SESSION['msg'])){
			$_SESSION['msg'] = [];
		}
		
		$_SESSION['msg'][] = array(
				'tipo' => $tipo,
				'msg' => $msg
			);
	}
}

?>
