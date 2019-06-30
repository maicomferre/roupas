<?php require_once('../Files/server/produtos.php'); ?>
<?php
	if((!isset($_POST['categoria']) || empty($_POST['categoria'])) && (!isset($_POST['ProdutoID']) || empty($_POST['ProdutoID'])))
	{
		http_response_code(400);
		exit();
	}
	$ProdutoID = $_POST['produtoID'] ?? -1;
	
	/*$Categoria = strtolower($_POST['categoria']);
	$Metodos = array(
		'masculino' => 'masculino/',
		'feminino' => 'masculino/',
		'masculino-infantil' => 'masculino/infantil/',
		'feminino-infantil' => 'feminino/infantil/',
		'sapatos-masculino' => 'sapatos/masculino/', 
		'sapatos-feminino' => 'sapatos/feminino/',
		'animais-domesticos' => 'animail/'
	);
	
	if(array_key_exists($Categoria,$Metodos) === false)
	{
		http_response_code(400);
		exit();
	}*/
	
	if(isset($_POST['produtoID']))
	{
		$result = $pdo -> prepare('SELECT * FROM `produto` WHERE produtoid= :pro_id');
		$result->bindParam(":pro_id",$ProdutoID);
		$result->execute();

		$re = $result->fetch();

		if(count($re) < 1)
		{
			echo json_encode(array('prod'=>'0'));
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
	
	
	
	/* SQL
INSERT INTO `produto`(`nome`,`preco`,`data_criacao`,`visto`,`compras`,`avaliacao`,`desconto`,`cupom`,`criador_id`,`Descricao`,`ProdutoID``Categoria`,`Genero`,`imagens`,`anuncio`,`desativado`) VALUES('Conjunto Camiseta e Bermuda Bege Up Baby',127.90,'23/06/2019',0,0,5,76.74,'-1',-1,'Conjunto composto por camiseta em meia malha e bermuda em tecido.Camiseta com estampa frontal e abertura de gola por botão de pressão nos tamanhos P, M e G.Bermuda com elástico ajustável na parte interna, e fechamento por botão de pressão e zíper.(As peças nos tamanhos P, M, G, 1, 2 e 3 não possuem zíper).Bolsos funcionais, e detalhe para a barra da bermuda dobrada e aplique de plaquinha da marca.Conjunto despojado e super confortável para aproveitar ainda mais os dias de muito calor.','2872062','Roupas','Maculino-infantil','produto2-1.jpg,produto2-2.jpg,produto2-3.jpg',0,0);
	
	
	*/
?>