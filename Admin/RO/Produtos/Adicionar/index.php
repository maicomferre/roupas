<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Roupas Online - Pagina Inicial</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="../../../../Files/css/_Pagina_Index.css" charset="utf-8" media="screen and (min-width:429px)" />
		<link rel="stylesheet" type="text/css" href="../../../../Files/css/PaginaIndex_Width-429px-width_.css" media="screen and (max-width: 429px)" />
		<link rel="stylesheet" type="text/css" href="src/adicionar.produtos.css" />
		<script type="text/javascript" src="../../../../jquery-3.1.0.min.js" language="javascript"></script>
		<script type="text/javascript" src="src/adicionar.produtos.js" language="javascript"></script>
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	</head>
	<body>
		<div class="Titulo">
			<img id="image0" src="../../../../Files/img/Camisa0.gif" />
			<img id="image1" src="../../../../Files/img/Camisa1.gif" />
			<p id="Title">Venda de Roupas Online - Pagina Inicial</p>
			<p id="SubTitle">Administração -  Opção: Adicionar produtos</p>
			<p id="credits">Desenvolvido por: Maicom Ferreira</p>
		</div>
		<br /><br />
			<div class="Conteudo">
				<div class="anterior" style="display:none;">
				
				</div>
				<div class="display" id="opt_0">
					<center>
						<h1>Adicionar um novo produto</h1>
						<h2>Você está prestes a adicionar um produto</h2>
						
						<h4>Lembre-se que não é necessário preencher tudo agora<br />Você pode começar
						o pre-cadastro e continuar mais tarde</h4>
					</center>
					<br /><br /><br />
				</div>
				<div class="display" id="opt_1" style="display:none;">
					<h1>Diga o nome do produto a ser vendido</h1>
					<br /><hr />
					<input type="text" placeholder="Diga o nome do produto" maxlength="100" />
				</div>
				
				<div class="display" id="opt_2" style="display:none;">
					<h1>Diga o preço do produto</h1>
					<br /><hr />
					<input type="text" placeholder="Diga o preço do produto" maxlength="100" />
				</div>
				
				<div class="display" id="opt_3" style="display:none;">
					<h1>Descreva o produto</h1>
					<textarea cols="190" rows="15"></textarea>
				</div>
				
				<div class="display" id="opt_4" style="display:none;">
					<h1>Adicione até 5 imagens</h1>
					<div class="img">
						<img id="imagen_opcao" src="" />
						<img id="imagen_opcao" src="" />
						<img id="imagen_opcao" src="" />
						<img id="imagen_opcao" src="" />
						<img id="imagen_opcao" src="" />
					</div><br /><br /><br />
					<input type="file" multiple id="imgadd" />
					<br /><br /><br />
				</div>
				
				<div class="display" id="opt_5" style="display:none;">
				
				</div>
				
				<div class="display" id="opt_6" style="display:none;">
				
				</div>

				<br  /><br />
				<div class="botoes">
					<button class="bottao" onClick="view('next');" id="btn0" >Iniciar Cadastro</button>
				</div>
				<br />
			</div>	
	</body>
</html>	