<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Roupas Online - Pagina Inicial</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="../../../../Files/css/Global.css" charset="utf-8" media="screen and (min-width:429px)" />		
		<!--<link rel="stylesheet" type="text/css" href="../../../../Files/css/PaginaIndex_Width-429px-width_.css" media="screen and (max-width: 429px)" />-->
		<link rel="stylesheet" type="text/css" href="src/adicionar.produtos.css" />
		<script type="text/javascript" src="../../../../jquery-3.1.0.min.js" language="javascript"></script>
		<script type="text/javascript" src="src/adicionar.produtos.js" language="javascript"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

		<!-- Popper JS -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>		
				
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
				<span id="alerta_erro" style="#display:none;">Erro! Um erro errado está calsando algum erro estranhamente errado que não esta certo</span>
				<div class="anterior" style="display:none;">
				
				</div>
				<div class="display" id="opt_0">
					<center>
						<h1>Adicionar um novo produto</h1>
						<h2>Você está prestes a adicionar um produto</h2>
						
						<!--<h4>Lembre-se que não é necessário preencher tudo agora<br />Você pode começar
						o pre-cadastro e continuar mais tarde</h4>-->
					</center>
					<br /><br /><br />
				</div>
				<div class="display" id="opt_1" style="display:none;">
					<h1>Diga o nome do produto a ser vendido</h1>
					<br /><hr />
					<input type="text" autofocus id="produto_nome" placeholder="Diga o nome do produto" maxlength="100" />
					<br /><hr />
					<h3>Informe a quantidade deste produto disponivel no estoque</h3>
					<input type="number" id="produto_quantidade" value="0" />
				</div>
				
				<div class="display" id="opt_2" style="display:none;">
					<h1>Diga o preço do produto</h1>
					<br /><hr />
					<input type="text" id="produto_preco" autofocus placeholder="Diga o preço do produto" maxlength="100" />
				</div>
				
				<div class="display" id="opt_3" style="display:none;">
					<h1>Descreva o produto</h1>
					<textarea cols="190" rows="15" autofocus id="text"></textarea>
				</div>
				
				<div class="display" id="opt_4" style="display:none;">
					<h1>Adicione imagens</h1>
					<p style="display:none;" id="image_message">Clique na Imagem Para remover</p>
					<div class="img" id="img_img"></div>
					<br /><br /><br /><br />
					<button>
						<input type="file" multiple id="imgadd0" onChange="preview_images('img_img');" />
					</button>
					<br /><br /><br />
				</div>
				
				<div class="display" id="opt_5" style="display:none;">
					<h1>Selecione a categoria</h1>
					<select id="select_opt5">
						<option value="default" disabled selected>Selecionar</option> 
						<option value="masculino">Masculina</option>
						<option value="masculino_infantil">Masculina Infantil</option>
						<option value="feminino">Feminina</option>
						<option value="feminino_infantil">Feminina Infantil</option>
						<option value="pets">Pets</option>
						<option value="outra">Outras</option>
					</select>
					<br />
					<br />
					<hr />
					<h1>Digite Palavras Chaves para encontrar este produto</h1>
					<h6>Estas palavras chaves serão utilizadas em mecanismos de pesquisa, tanto externo<wbr /> quanto interno.(no próprio site)</h6>
					<input type="text" id="txt_keyword" placeholder="Palavras-Chaves(KeyWords): Ex: camisa,regata,manga" />
				</div>
				
				<div class="display" id="opt_6" style="display:none;">
					<h1>Selecione a cor principal do produto</h1>
					<input type="color" id="opt6_color1" />
					<br /><br /><hr />
					<h1 id="sec_color">Cor secundária?</h1>
					<input type="color" id="opt6_color2" style="display:none;" />
					<input type="checkbox" class="color2" id="sec_color_input" value="Não" onClick="script:$('#sec_color').html('Selecione a cor secundária');$('#opt6_color2').show('slow');$('#sec_color_input').hide('slow');"/>
				</div>
				
				<div class="display" id="opt_7" style="display:none;">
					<h1>Selecione o tamanho disponível</h1>
					<p>
						<b>Quantidade Em Estoque:</b> <span id="set_qntEstoque">[ERRO JAVASCRIPT]</span><br />
						<b>Quantidade distribuída</b> <span id="set_qntDistribuida">[ERRO JAVASCRIPT]</span><br />
					</p>
					<table id="tam_table">
						<tr>
							<th>Tamanho</th>
							<th>Quantidade</th>
						</tr>
						<tr>
							<td>Pequeno Pequeno [PP]</td>
							<td><input type="number" id="qnt_pp" class="quant_number_ctx" onChange="tamn_quant_check();" value="0" min="0" /></td>
						</tr>
						<tr>
							<td>Pequeno [P]</td>
							<td><input type="number" id="qnt_p"class="quant_number_ctx"  onChange="tamn_quant_check();" value="0" min="0" /></td>
						</tr>
						<tr>
							<td>Médio [M]</td>
							<td><input type="number" id="qnt_m"class="quant_number_ctx"  onChange="tamn_quant_check();" value="0" min="0" /></td>
						</tr>
						<tr>
							<td>Grande [G]</td>
							<td><input type="number" id="qnt_g"class="quant_number_ctx"  onChange="tamn_quant_check();" value="0" min="0" /></td>
						</tr>
						<tr>
							<td>Grande Grande [GG]</td>
							<td><input type="number" id="qnt_gg" class="quant_number_ctx" onChange="tamn_quant_check();" value="0" min="0" /></td>
						</tr>						
					</table>
				</div>
				
				<div class="display" id="opt_8" style="display:none;">
					<div class="container">
						<div class="debbug"></div>
						<div class="table table-striped">
							<table>
								<tr>
									<th>Nome</th>
									<th>Valor</th>
								</tr>
								<tr>
									<td>Nome</td>
									<td><span id="nome"></span></td>
								</tr>
								<tr>
									<td>Quantidade</td>
									<td id="qtn"></td>
								</tr>
								<tr>
									<td>Preço</td>
									<td id="preco"></td>
								</tr>
								<tr>
									<td>Lucro Estimado</td>
									<td id="lucro"></td>
								</tr>
								<tr>
									<td>Descrição</td>
									<td id="desc"></td>
								</tr>
								<tr>
									<td>Imagens</td>
									<td id="img"><div class="img2" id="img_img2"></div></td>
								</tr>
								<tr>
									<td>Categoria</td>
									<td id="cat"></td>
								</tr>
								<tr>
									<td>Palavras Chave</td>
									<td id="key"></td>
								</tr>
								<tr>
									<td>Cor Primária</td>
									<td id="cor1"></td>
								</tr>
								<tr>
									<td>Cor secundária</td>
									<td id="cor2"></td>
								</tr>
								<tr>
									<td>Tamanhos </td>
									<td id="tam"></td>
								</tr>
							</table>
							<!--<button type="button" class="btn btn-primary">Enviar</button>-->
						</div>
					</div>
				</div>
				<br  /><br />
				<div class="botoes">
					<!--<button class="bottao" onClick="view('back');" style="display:none;" id="btn1_d" >Voltar</button>-->
					<button class="bottao" onClick="view('next');" id="btn0" >Iniciar Cadastro</button>
				</div>
				<br />
			</div>	
	</body>
</html>	