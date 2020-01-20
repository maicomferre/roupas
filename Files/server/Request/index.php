<?php require_once('../bd/PDO.php'); ?>
<?php require_once('../include/class.usuario.php'); ?>
<?php
	$user = new Usuario();
	
	if($user->Logado() === false){
		//echo "<h1>Acesso Negado!</h1>";
		//exit();
	}
	
	if(isset($_GET['Roupas']))
	{
		if($_GET['Roupas'] == 'all')
		{
			header("Content-Type: application/json; charset=utf-8");
			
			$a = array();

			try{
				$result = $pdo->prepare('SELECT * FROM `produto` LIMIT 20');
			
				$result->execute();
		
				$a = $result->fetchAll();
			}
			catch(Exception $e)
			{
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
		http_response_code(400);
		exit;
	}
?>