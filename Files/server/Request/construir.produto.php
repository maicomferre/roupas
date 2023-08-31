<?php require_once('../bd/PDO.php'); ?>

<?php

/*
	@Retorna a informações de 

*/
	if((!isset($_POST['categoria']) || empty($_POST['categoria'])) && (!isset($_POST['ProdutoID']) || empty($_POST['ProdutoID'])))
	{
		echo "Requisição inválida";
		http_response_code(400);
		exit();
	}
	
	
	
	/* SQL
INSERT INTO `produto`(`nome`,`preco`,`data_criacao`,`visto`,`compras`,`avaliacao`,`desconto`,`cupom`,`criador_id`,`Descricao`,`ProdutoID``Categoria`,`Genero`,`imagens`,`anuncio`,`desativado`) VALUES('Conjunto Camiseta',127.90,'23/06/2019',0,0,5,76.74,'-1',-1,'Conjunto compostr.','2872062','Roupas','Maculino','produto2-1.jpg,produto2-2.jpg,produto2-3.jpg',0,0);
	
	
	*/
?>