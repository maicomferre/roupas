<!DOCTYPE html>
<html>
	<head>
		<title>Roupas Online </title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="../Files/css/_Pagina_Index.css" charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="../Files/css/_Pagina_Produtos_responsivo.css" charset="utf-8" media="(min-width: 935px)" />
		<!--
				@Desenvolvido por: Maicom Ferreira
				@Data: Começo: 07/2017
				@Função: Exibir produtos, um em especifico ou uma lista por categorias
		-->
		<script>
			var pro_id = <?= ($_GET['ProdutoID'] ?? -1);  ?>;
			var catego = "<?= ($_GET['categoria'] ?? -1); ?>";
		</script>
		<script type="text/javascript" src="../jquery-3.1.0.min.js" ></script>				
		<script type="text/javascript" src="../Files/js/_Pagina_Produtos.js" language="javascrpt"></script>

	</head>
	<body>
		<div class="Titulo">
			<img id="image0" src="../Files/img/Camisa0.gif" />
			<img id="image1" src="../Files/img/Camisa1.gif" />
			<p id="Title"><a href="../" style="text-decoration:none;">Venda de Roupas Online - Produtos</a></p>
			<p id="SubTitle">Compre aqui, roupa para toda a família</p>
			
			<p id="credits">Desenvolvido por: Maicom Ferreira</p>
		</div>
		<nav id="naveounavegando">
			<ol id="olid">
				<a href="../Produtos?categoria=masculino" target="_blank" ><li id="Olid0">Masculino</li></a>
				<a href="../Produtos?categoria=feminino" target="_blank"><li id="Olid1">Feminino</li></a>
				<a href="../Produtos?categoria=masculino-infantil" target="_blank"><li id="Olid2">Masculino -  Infantil</li></a>
				<a href="../Produtos?categoria=feminino-infantil" target="_blank"><li id="Olid3">Feminino - Infantil</li></a>
				<a href="../Produtos?categoria=sapatos-masculino" target="_blank"><li id="Olid4">Sapatos Masculino</li></a>
				<a href="../Produtos?categoria=sapatos-feminino" target="_blank"><li id="Olid5">Sapatos Feminino</li>	</a>
				<a href="../Produtos?categoria=animais-domesticos" target="_blank"><li id="Olid6">Animais Domesticos</li></a>
			</ol>
		</nav><br />
		<div class="Conteudo"></div>
	</body>
</html>