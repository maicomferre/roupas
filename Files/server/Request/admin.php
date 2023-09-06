<?php require_once('../bd/PDO.php'); ?>
<?php require_once('../include/class.usuario.php'); ?>
<?php

$user = new Usuario();

$status = $user->Logado();
$cargo = 0;

if(!$status)
{
	$user->retorna_com_aviso('Não possui privilegios para acessar esta página!');
	exit;
}


if(isset($_GET['AddProduct'])){

	$user->requer('anunciante');

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
		'Genero'=>'',
	);

 	$a = json_decode($_POST['data']);


	foreach($a as $i =>$c){
		if(!isset($data[$i]))continue;
		
		$data[$i] = $c;

	}
	$random = randomID();
	$preco = ($data['preco']);
	$criadorid = 0;


	$smt = $pdo->prepare("INSERT INTO `produto`(`nome`, `preco`, `Descricao`, `ProdutoID`, `Categoria`, `imagens`,`data_criacao`,`visto`,`compras`,`avaliacao`,`desconto`,`cupom`,`criador_id`,`Genero`,`anuncio`,`desativado`) VALUES (:nome,:preco,:descricao,:id,:categoria,'',NOW(),0,0,0,0,'',:criadorid,:genero,false,false)");

	$smt->bindParam('nome',$data['nome']);
	$smt->bindParam('preco',$preco);
	$smt->bindParam('descricao',$data['descricao']);
	$smt->bindParam('categoria',$data['categoria']);
	$smt->bindParam('id',$random);
	$smt->bindParam('criadorid',$criadorid);
	$smt->bindParam('genero',$data['Genero']);

	$smt->execute();

	echo $random;

	exit;
}
if(isset($_GET['ModifyProduct'])){

	if(!isset($_GET['productId']) OR empty($_GET['productId'])){
			echo "<b>Erro:</b><br />Em ModifyProduct -> Identificação do produto não Enviada";
			http_response_code(400);
			die();		
	}
	if(!isset($_GET['Replaceimages'])){
		if(!isset($_FILES)){
			echo "<b>Erro:</b><br />Em ModifyProduct&Replaceimages -> Arquivos Não Enviados";
			http_response_code(400);
			die();
		}
	}
	
	$imagens = '';
	foreach($_FILES['file']['error'] as $key => $error){

		$ext = '.jpg';

		if($error == UPLOAD_ERR_OK){
			$newname = md5(random_bytes(12)).$ext;
			if(move_uploaded_file($_FILES['file']['tmp_name'][$key], '../../../Produtos/img/'.$newname)){
				$imagens .= $newname.',';
			}
		}
	}
	//usar classe

	$con = new Banco();
	$con->substitui_imagens_anuncio($_GET['productId'],$imagens);

	exit;
}

function randomID(){
	$a = '';
	for($i=0; $i<7; $i++){
		$a .= random_int(0, 9);
	}
	return $a;
}



http_response_code(400);

?>