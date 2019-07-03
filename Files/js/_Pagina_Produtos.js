$(document).ready(function(){
	$.ajax({
		url:'../Files/server/Request/produto.php',
		method:'POST',
		data:{
			'produtoID':pro_id,
			'categoria':catego,
		},
		success:function(data){ConstruirProduto(data);},
		dataType:'json',
	});
});

function ConstruirProduto(Dados){
	var Valor = 0;
	if(typeof Dados['ValorDesconto'] !== undefined)
	{
		Valor = Dados['ValorDesconto'];	
	}else{
		Valor = Dados['valor'];
		$('#descontovalorantigo').hide();
	}
	
	var OutrasImg = '';
	var IMGS = Dados['num_imagens'];
	
	for(var i=0; i<IMGS; i++)
	{
		OutrasImg = OutrasImg + '<img src="../Produtos/img/'+Dados.imagens[i]+'" onClick="AlterarImagemPara(this);" /><br />';
	}
	
	txt = '';
	
	txt +=	'<div class="OutrasImg">'+OutrasImg+'</div>';
	
	txt +=	'<img src="../Produtos/img/'+Dados.imagens[0]+'" id="ImgCentrProduto" />';
	
	txt +=	'	<p id="Titulo_Produto">'+Dados['nome']+'</p>';
	
	txt +=	'	<p id="Valor">R$: '+Valor+'</p> <p id="descontovalorantigo">R$: '+ (Dados['valor']) +' </p>';
	
	txt +=	'	<p id="TextCor">Selecione a Cor</p>';
	
	txt +=	'	<select id="Cores" title="Selecionar cor">';
	txt +=	'		<option value="VERDE" selected>Azul</option>';
	txt +=	'	</select><br />';
	
	txt +=	'<p id="Descricao">'+Dados['Descricao']+'<span onClick="javascript:window.location.href=\'#Mais\';" id="MaisDetalhes"> &nbsp;Mais Detalhes</span></p>';
	
	txt +=	'<div class="SelecionarTamanho">';
	txt +=	'<p id="STAM0">P</p>\
			<p id="STAM1">M</p>\
			<p id="STAM2">G</p>\
			<p id="STAM3">GG</p>\
			<p id="STAM4">XGG</p>';
			
	txt +=	'</div>';
	txt +=	'<img src="../Files/img/5estrela.png" id="NumeroEstrelas" />';
	txt +=	'<p id="numEstrelas"><b>5</b> &nbsp;(1 avaliação)</p><br /><br /><br />';
	
	$('.Conteudo').html(txt);	
	
}