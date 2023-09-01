<!DOCTYPE html>
<html>
	<head>
		<title>Roupas Online - Produtos</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="../Files/css/Global.css" charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="../Files/css/_Pagina_Produtos.css"  />
		<!--
				@Desenvolvido por: Maicom Ferreira
				@Data: Começo: 07/2017 - 07/2019
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
			<!-- Menu -->
		</nav>		
		<br />
		<div class="Conteudo">
			
			<p id="Titulo_Produto"></p>
			<div class="objeto">
	
				<div class="OutrasImg"></div>
	
				<img src="" id="ImgCentrProduto" />
	
			</div>
			<div class="objeto">
	
				<p id="Valor">R$: 
					<span id="preco"></span> 
					<span id="descontovalorantigo"></span>
				</p>
	
			<p id="TextCor">Selecione a Cor</p>
	
			<fieldset>
				
				<legend>Descrição</legend>
				<br />
				<span id="descricao"></span>
				<!--
					<span onClick="descricao.maisMenos();" id="MaisDetalhes"> &nbsp; Mais Detalhes</span></p>
				-->
				<br><br><br>
				<select id="Cores" title="Selecionar cor"></select>
	
				<br><br><br>
				<div class="SelecionarTamanho">
					<p id="STAM0">P</p>
					<p id="STAM1">M</p>
					<p id="STAM2">G</p>
					<p id="STAM3">GG</p>
					<p id="STAM4">XGG</p>
				</div>

			</fieldset>
			<img src="/Files/img/5estrela.png" id="NumeroEstrelas" />
			<p id="numEstrelas"><b>5</b> &nbsp;(1 avaliação)</p></div><br />
			<div class="comentarios"></div>
	

		</div>
	</body>
</html>