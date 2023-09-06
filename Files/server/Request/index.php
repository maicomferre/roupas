<?php require_once('../bd/PDO.php'); ?>
<?php require_once('../include/class.usuario.php'); ?>
<?php

	$user = new Usuario();

	$status = $user->Logado();

	if(isset($_GET['logar'])){
		if($status === true){
			$user->SetMensagem('aviso','Você já está logado!');
			header('/');
			exit;
		}

		if(isset($_POST['email']) && isset($_POST['pass']))
		{
			$logar = $user->Logar($_POST['email'],$_POST['pass']);

			if($logar){
				$user->SetMensagem('aviso','Login com sucesso! Bem Vindo(a), '.$_SESSION['nome']);
				header('/');
			}else{
				$user->SetMensagem('aviso','E-mail ou senha incorreto!');
				header('/Login');
			}
		}else{
			echo "Erro logar. requisição inválida";
			header('/');
		}
		exit;
	}


	if(isset($_GET['Roupas']))
	{
		if($_GET['Roupas'] == 'all')
		{
			header("Content-Type: application/json; charset=utf-8");
			
			$a = array();
			try{
				$result = $pdo->prepare('SELECT * FROM `produto`');
			
				$result->execute();
		
				$a = $result->fetchAll();
			}
			catch(Exception $e)
			{
				echo $e.getMessage();
				$a = array($a,"error" => $e.getMessage());
			}

			$a = array($a,'indice' => count($a));
			
			echo json_encode($a);
		}	
	}
	else if(isset($_POST['produtoID']))
	{
		$ProdutoID = $_POST['produtoID'] ?? -1;
		
		$result = $pdo -> prepare('SELECT * FROM `produto` WHERE produtoid=:pro_id');
		$result->bindParam(":pro_id",$ProdutoID);
		$result->execute();

		$re = $result->fetch();

		if(count($re) < 1)
		{
			echo json_encode(array('indice'=>'0'));
			exit();						
		}
		
		$img = explode(',',$re['imagens']);
		
		unset($re['imagens']);
		$re['imagens'] = [];
		
		
		foreach($img as $i => $c){
			$re['imagens'][$i] = $c;
		}
		$re['num_imagens'] = count($re['imagens']);
		
		
		echo json_encode($re);
	}	
	else
	{
		echo "erro1";
		#http_response_code(400);
		exit;
	}
?>