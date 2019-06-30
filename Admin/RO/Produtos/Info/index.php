<?php
	/*
		@Desenvolvido por: Maicom Ferreira
		@Data: 07/2017
		@Descrição: Painel de controle de produtos do site de roupas.
	
	*/
	if(!isset($_COOKIE['asdkmslw']))
	{
		header("Location: http://".$_SERVER['HTTP_HOST']);
		exit;
	}else{
		if($_COOKIE['asdkmslw'] != 'LIUHERTNMHLDSKJUHYEGRHJKM')
		{
			header("Location: http://".$_SERVER['HTTP_HOST']);
			exit;
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Administração de Roupas Online - Produtos Info</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="0_0@_F0i0les/_dSDsSfwer_QWEASD.css" />
		<script type="text/javascript" src="/jquery-3.1.0.min.js">var Request=false;var Out=0;</script>
		<script><?php
			if((!isset($_GET['listar']) || empty($_GET['listar'])) && (!isset($_GET['ProdutoID']) || empty($_GET['ProdutoID'])))
			{
				echo 'Request = false;';
			}
			if((isset($_GET['listar']) && !empty($_GET['listar'])))
			{
				if($_GET['listar'] == 'selecionar-categoria')
				{
					echo 'Request = true;Out = 1;';
				}
				else
				{
					
				}
			}
		?>
			$(document).ready(function(){
			if(Request === false){
				$('.Fundo').show();
			}
			if(Out == 1){
				$('.Selecionar_categoria').show();
			}
			});
		</script>
	</head>
	<body>
		<div class="Fundo">
			<p id="title">O que deseja fazer?</p>
			<div class="Objeto" title="Exibe informações sobre um produto em especifico" onClick="javascript:document.location.href=document.location.href+'?listar=selecionar-categoria';">
				<p id="title">Ver um Produto</p><hr />
				<p id="subtitle">Veja as informaçoes um produto em especifico</p>
			</div>
			<div class="Objeto" title="Lista os produtos que tiveram mais vendas">
				<p id="title">Listar Mais Vendidos</p><hr />
				<p id="subtitle">Exibe uma lista dos produtos mais vendidos</p>
			</div>	
			<div class="Objeto" title="Mostra todos os produtos com melhor classificação, das avaliações dos usuarios">
				<p id="title">Listar Melhor Classificação</p><hr />
				<p id="subtitle">Lista os produtos que tiveram mais estrelas</p>
			</div>	
			<div class="Objeto" title="Permite criar um produto para ser vendido">
				<p id="title">Criar Produto</p><hr />
				<p id="subtitle">Crie um novo produto para venda</p>
			</div>	
			<div class="Objeto" title="Permite deletar um produto à venda">
				<p id="title">Deletar Produto</p><hr />
				<p id="subtitle">Delete um produto</p>
			</div>	
			<div class="Objeto" title="Altere: preço, cor, valor, imagens, etc...">
				<p id="title">Modificar Produto</p><hr />
				<p id="subtitle" >Altere configurações do produto.</p>
			</div>	
			<div class="Objeto" title="Lista os produtos que tiveram a menor venda">
				<p id="title">Listar Menos Vendidos</p><hr />
				<p id="subtitle">Exibe uma lista dos produtos menos vendidos</p>
			</div>	
			<div class="Objeto" title="Mostra todos os produtos que tiveram uma avaliação ruim dos usuarios">
				<p id="title">Listar Pior Classificação</p><hr />
				<p id="subtitle">Exibe uma lista dos produtos com uma baixa reputação</p>
			</div>	
			<div class="Objeto" title="Mostra quantos usuarios tem os produtos nas suas listas de desejos">
				<p id="title">Produtos na Lista de Desejos</p><hr />
				<p id="subtitle">Exibe uma lista de todos os produtos e o numero de usuarios que o tem na lista de desejos</p>
			</div>	
			<div class="Objeto" title="Exibe uma lista dos produtos com o numero de vezes que foram comprados e o usuario chegou ao produto por um dos anuncios: email e outros metodos">
				<p id="title">Comprados por Anuncio</p><hr />
				<p id="subtitle">Exibe uma lista das estatisticas de marketing(Anuncios)</p>
			</div>	
			<div class="Objeto" title="">
				<p id="title"></p><hr />
				<p id="subtitle"></p>
			</div>	
			<div class="Objeto" title="">
				<p id="title"></p><hr />
				<p id="subtitle"></p>
			</div>	
			<div class="Objeto" title="">
				<p id="title"></p><hr />
				<p id="subtitle"></p>
			</div>	
			<div class="Objeto" title="">
				<p id="title"></p><hr />
				<p id="subtitle"></p>
			</div>	
			<div class="Objeto">
				<p id="title"></p><hr />
				<p id="subtitle"></p>
			</div>				
		</div>
		<div class="Selecionar_categoria">
			<form action="" method="get" id="form">
				<select id="listar" name="listar" title="Por favor, Selecione a categoria." onChange="javascript:$('#form').submit();">
				<?php
					$fopen = fopen('../../../../p88oiu77jjhj66fg33bjdgbnfjhdgbjerg88nfjhdnfjh390747833b44n56486v422mb3n4d5mbc\Config_x\Categorias_registradas.ini','r');
					$explode = explode(',',fgetss($fopen));
					fclose($fopen);$i=0;
					echo "<option selected value=\"-1\">Selecione a Categoria</option>";
					while((isset($explode[$i])) !== false)
					{
						echo '<option value="'.$explode[$i].'">'.$explode[$i].'</option>';
						$i++;
					}
				?>
				</select>
			</form>
		</div>
		<div class="Listar_Produtos">
			
		
		</div>
	</body>
</html>