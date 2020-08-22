<?php require_once('../bd/PDO.php'); ?>
<?php
if(isset($_GET['AddProduct'])){


	$data = array(
		'nome'=>'',
		'preco'=>'',
		'quantidade'=>'',
		'descricao'=>'',
		'cor1'=>'',
		'cor2'=>'',
		'categoria'=>'',
		'keywords'=>'',
		'Tamanhos'=>'',
	);

 	$a = json_decode($_POST['data']);


	foreach($a as $i =>$c){
		if(!isset($data[$i]))continue;
		
		$data[$i] = $c;

	}
	$random = randomID();
	$preco = ($data['preco']);



	$smt = $pdo->prepare("INSERT INTO `produto`(`nome`, `preco`, `Descricao`, `ProdutoID`, `Categoria`, `imagens`) VALUES (:nome,:preco,:descricao,:id,:categoria,'')");

	$smt->bindParam('nome',$data['nome']);
	$smt->bindParam('preco',$preco);
	$smt->bindParam('descricao',$data['descricao']);
	$smt->bindParam('categoria',$data['categoria']);
	$smt->bindParam('id',$random);

	$smt->execute();


}

function randomID(){
	$a = '';
	for($i=0; $i<7; $i++){
		$a .= random_int(0, 9);
	}
	return $a;
}
?>