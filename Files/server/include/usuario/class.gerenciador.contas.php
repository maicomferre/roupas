<?php


class GerenciadorContas
{
	private $conexaoBanco = null;
	function __construct($db=null)
	{
		if(!isset($_SESSION) or session_status() !== PHP_SESSION_ACTIVE)
			session_start();
			session_name(hash('sha256',base64_encode(random_bytes(8))));
		
		if($db !== null)
			$conexaoBanco = $db;
	}

	function toPass($pass)
	{
		$salt1 = $this->db_Get("salt1");
		$salt2 = $this->db_Get("salt2");
		$passw = $this->db_Get("senha");
		$salt4 = substr($salt1,0,6).md5($salt2).hash('sha256',$salt1);
		
		$p = explode('-',$passw);
		
		$passw = password_hash(hash('sha256',md5($salt1 + $p[1]) + hash('sha512',$p[0]+ $salt4) ,PASSWORD_DEFAULT ));
	}

	function setLogin($user,$password)
	{
		if($user === $_SESSION['user'])return 0;
		
		if(isset($_SESSION['banned']))
		{
			if($_SESSION['banned'] > time())
				unset($_SESSION['banned']);
		}
		
		if(isset($_SESSION['time']['requestLogin']))
		{
			/*
				@ Caso faça 5 tentativas de login em menos de 50 segundos
				@ Sera bloqueador por 3 horas.
				@ Apenas bloqueio de sessão.
			*/
			if($_SESSION['time']['requestLogin'] < time() + 10)
			{
				$_SESSION['time']['ForcaBruta']++;
				if($_SESSION['time']['ForcaBruta'] > 5)
				{
					$_SESSION['banned'] = time() + 10800;
					return -2;
				}
			}
		}
		$_SESSION['time']['requestLogin'] = time();
		if($this->db_Check("user",$user) === true)
		{
			sleep(1);
			$this->ToPass();
			
			#if($passw === 
		}	
	}
}

?>