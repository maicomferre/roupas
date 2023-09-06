<?php

class Usuario
{
	private $cargos_str = array(
		"visitante" 	=> "0",
		"suporte" 		=> "1",
		'anunciante' 	=> "2",
		'admin'			=> "3",
		'dev'			=> "4"
	);


	function __construct()
	{
		if(session_status() !== PHP_SESSION_ACTIVE){
			session_name(hash('sha1',base64_encode(random_bytes(8))));			
			session_start();
		}
	}

	function Logar(string $usuarioemail,string $senha)
	{
		if($this->Logado()){
			echo "logado!";
			return true;
		}

		if(isset($_SESSION['banned']))
		{
			if($_SESSION['banned'] > time()){
				echo "Muitas Tentativas de Login. Aguarde";
				unset($_SESSION['banned']);
			}
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
					echo "Muitas Tentativas de Login. Aguarde";
					return -2;
				}
			}
		}
		$_SESSION['time']['requestLogin'] = time();

		$b = new Banco();

		$userid = $b->usuario_existe($usuarioemail,true);

		if(!$userid){
			return false;
		}

		$getsenha = ($b->obter_especifico_usuario($userid,'senha'))[0]['senha'];

		$senha = hash('sha512',$senha);

		if($senha === $getsenha)
		{
			$dados = $b->obter_usuario($userid)[0];

			if(!$dados){
				echo "[class=Usuario][Logar(..,..)]: Erro ao obter dados do usuário";
				return false;
			}
			$this->sessaoLimite(200);
			$_SESSION['Logado'] = true;
			$_SESSION['nome'] = $dados['nome'];
			$this->Cargo($dados['cargo']);
			return true;
		}
		else
		{
			echo "senha erro";
			return false;
		}
	}

	function sessaoLimite($time=-1)
	{
		
		if($time == -1){
			if(!isset($_SESSION['limite']))
				$_SESSION['limite'] = 100;
		
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
		if($cargo == -1)
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

	function requer($cargo)
	{
		if($this->Logado() === false)
		{
			if($cargo !== 'visitante')
			{
				$this->retorna_com_aviso("Acesso Não Autorizado!");
				exit;
			}
			return true;
		}

		if(in_array($this->cargos_str,$cargo) === false)
		{
			$this->retorna_com_aviso("Erro interno. Cargo não encontrado");
			exit;
		}

		if($this->Cargo() < $this->cargos_str)
		{
			$this->retorna_com_aviso("Acesso Não Autorizado!");
			exit;
		}
		return true;
	}


	function retorna_com_aviso(string $mensagem,string $retorno='/')
	{
		$this->SetMensagem('aviso',$mensagem);
		
		header((($retorno === "/") ? ("/") : $retorno) );
	}

}

?>
