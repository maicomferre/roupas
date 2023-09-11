<?php require_once('../bd/PDO.php');?>
<?php require_once('../include/class.usuario.php');?>
<?php
/*
$user=newUsuario();

$status=$user->Logado();

if(!$status)
{
	$user->retorna_com_aviso('Não possui privilegios para acessar esta página!');
	exit;
}
*/

if(isset($_GET['CriarAnuncio']))
{
	$a=new Banco();	
	$a->cria_anuncio();

}

if(isset($_GET['AddProduct'])){

	$user->requer('anunciante');

	$a=json_decode($_POST['data']);

	foreach($a as $i => $c){
		if(!isset($data[$i]))continue;
			$data[$i]=$c;
	}
	$data['criador_id']=$user->obter_id();


	$a->atualizar_todo_anuncio('123123',$data);

	$smt->execute();

	echo$random;

	exit;
}

if(isset($_GET['ModifyProduct'])){

	if(!isset($_GET['productId']) OR empty($_GET['productId'])){
			echo"<b>Erro:</b><br/>EmModifyProduct->Identificação do produto não Enviada";
			http_response_code(400);
			die();		
	}
	if(!isset($_GET['Replaceimages'])){
		if(!isset($_FILES)){
			echo"<b>Erro:</b><br/>Em ModifyProduct & Replaceimages-> Arquivos Não Enviados";
			http_response_code(400);
			die();
		}
	}
	
	$imagens='';
	foreach($_FILES['file']['error']as$key=>$error){

		$ext='.jpg';

		if($error==UPLOAD_ERR_OK){
			$newname=md5(random_bytes(12)).$ext;
			if(move_uploaded_file($_FILES['file']['tmp_name'][$key],'../../../Produtos/img/'.$newname)){
				$imagens.=$newname.',';
			}
		}
	}

	$con=newBanco();
	$con->substitui_imagens_anuncio($_GET['productId'],$imagens);

	exit;
}

function randomID($a){
	$a='';
	for($i=0;$i<7;$i++){
		$a.=random_int(0,9);
	}
	return$a;
}



http_response_code(400);

?>