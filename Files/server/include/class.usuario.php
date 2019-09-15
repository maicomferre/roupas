<?php require_once('usuario/class.gerenciador.contas.php'); ?>
<?php

class Usuario
{
	function __construct(){
		if(!isset($_SESSION) or session_status() !== PHP_SESSION_ACTIVE){
			session_name(hash('sha256',base64_encode(random_bytes(8))));	
			session_start();
		}
	}
	
	function sessaoLimite($time=-1)
	{
		
		if($time == -1){
			if(!isset($_SESSION['limite']))
				$_SESSION['limite'] = 10;
		
			session_cache_expire($time);
			return $_SESSION['limite'];
		}else
			$_SESSION['limite'] = $time;
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
		return session_destroy();
	}
	
	function TempoRestante():int
	{
		if(isset($_SESSION['CLogado']))
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
	
	function Logar($pdo,$user,$login){
		$conta = new GerenciadorContas();
		
		$conta->conexaoBanco = $pdo;
		$conta->setLogin($user,$login);
		
		if($conta->tentarLogar() === false)
			return false;
		else 
			return true;
	}
	
}

?>
