<?php require_once('../bd/PDO.php'); ?>
<?php
	if(!isset($_GET['Roupas']) OR empty($_GET['Roupas']))
	{
		echo 'Acesso negado! <a href="../../../">Voltar</a>';
		exit();
	}
	if($_GET['Roupas'] == 'all')
	{
		header("Content-Type: application/json; charset=utf-8");
		
		$result = $pdo->prepare('SELECT * FROM `produto` LIMIT 20');
		
		$result->execute();
	
		$a = $result->fetchAll();

		$a = array($a,'indice' => count($a));
		
		echo json_encode($a);
		
	}
?>