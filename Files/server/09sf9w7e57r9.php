<?php #require_once('PDO.php'); ?>
<?php
	if(!isset($_GET['Roupas']) OR empty($_GET['Roupas']))
	{
		echo "Acesso negado! <a href=\"/\">Voltar</a>";
		exit();
	}
	if($_GET['Roupas'] === 'all')
	{
		header("Content-Type: application/json; charset=utf-8");
		#$result = $pdo->query('SELECT * FROM `produtos`');

		#$a = $result->fetchAll();
		
		#count($a);
		 
		$JSON = '[{"indice":10,';
				
		$JSON .= '"roupa_0":{"img":"0.jpg","img2":"0.jpg","val":18.4,"ProdutoID":"QWMLSF","Desconto":15.23,"Tipo":"Calca","Genero":"F","CT_X":142,"Centralizacao_Y":1234.4,"Descricao":"Roupa"},"roupa_1":{"img":"1.jpg","img2":"0.jpg","val":18.4,"ProdutoID":"QWMLSF","Desconto":15.23,"Tipo":"Calca","Genero":"F","CT_X":142,"Centralizacao_Y":1234.4,"Descricao":"Roupa"},"roupa_2":{"img":"2.jpg","img2":"0.jpg","val":18.4,"ProdutoID":"QWMLSF","Desconto":15.23,"Tipo":"Calca","Genero":"F","CT_X":142,"Centralizacao_Y":1234.4,"Descricao":"Roupa"},"roupa_3":{"img":"3.jpg","img2":"0.jpg","val":18.4,"ProdutoID":"QWMLSF","Desconto":15.23,"Tipo":"Calca","Genero":"F","CT_X":142,"Centralizacao_Y":1234.4,"Descricao":"Roupa"},"roupa_4":{"img":"4.jpg","img2":"0.jpg","val":18.4,"ProdutoID":"QWMLSF","Desconto":15.23,"Tipo":"Calca","Genero":"F","CT_X":142,"Centralizacao_Y":1234.4,"Descricao":"Roupa"},"roupa_5":{"img":"5.jpg","img2":"0.jpg","val":18.4,"ProdutoID":"QWMLSF","Desconto":15.23,"Tipo":"Calca","Genero":"M","CT_X":142,"Centralizacao_Y":1234.4,"Descricao":"Roupa"},"roupa_6":{"img":"6.jpg","img2":"0.jpg","val":18.4,"ProdutoID":"2872062","Desconto":15.23,"Tipo":"Calca","Genero":"MI","CT_X":142,"Centralizacao_Y":1234.4,"Descricao":"Roupa"}}]';
		
		
		echo $JSON;
	}
?>