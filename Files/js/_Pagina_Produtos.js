$(document).ready(function(){
	$.ajax({
		url:'../Files/server/Request/',
		method:'POST',
		data:{
			'produtoID':pro_id,
			'categoria':catego,
		},
		success:function(data){ConstruirProduto(data);},
		dataType:'json',
		cache:false,
	});
});

function ConstruirProduto(Dados){
	var Valor = 0;
	if(Dados['ValorDesconto'] !== undefined)
	{
		Valor = Dados['ValorDesconto'];
	}else{
		Valor = Dados['valor'];
		$('#descontovalorantigo').hide();
	}
	
	var OutrasImg = '';
	var IMGS = Dados['num_imagens'];
	
	for(var i=0; i<IMGS; i++)
		OutrasImg = OutrasImg + '<img src="../Produtos/img/'+Dados.imagens[i]+'" onClick="AlterarImagemPara(this);" /><br />';
	
	txt = '<p id="Titulo_Produto">' + Dados['nome'] + '</p><div class="objeto">';
	
	txt +=	'<div class="OutrasImg">'+OutrasImg+'</div>';
	
	txt +=	'<img src="../Produtos/img/'+Dados.imagens[0]+'" id="ImgCentrProduto" />';
	
	txt +=	'</div><div class="objeto">';
	
	txt +=	'	<p id="Valor">R$: '+Valor+' <span id="descontovalorantigo"><sub><del>R$: '+ (Dados['valor']) +'<del> </sub></span></p>';
	
	//txt +=	'<p id="TextCor">Selecione a Cor</p>';
	
	
	txt +=	'<p id="Descricao"><span id="descreva">Descrição:</span><br />\
		'+Dados['Descricao']+'<span onClick="descricao.maisMenos();" id="MaisDetalhes"> &nbsp;Mais Detalhes</span></p>';
	
	txt +=	'	<select id="Cores" title="Selecionar cor">';
	txt +=	'		<option value="-1" selected disabled>Selecione a cor</option>';
	txt +=	'		<option value="VERDE">Azul</option>';
	txt +=	'	</select><br />';	
	
	txt +=	'<div class="SelecionarTamanho">';
	txt +=	'<p id="STAM0">P</p>\
			<p id="STAM1">M</p>\
			<p id="STAM2">G</p>\
			<p id="STAM3">GG</p>\
			<p id="STAM4">XGG</p>';
			
	txt +=	'</div>';
	txt +=	'<img src="../Files/img/5estrela.png" id="NumeroEstrelas" />';
	txt +=	'<p id="numEstrelas"><b>5</b> &nbsp;(1 avaliação)</p></div><br /><div class="objeto comentários"></div>';
	
	$('.Conteudo').html(txt);	
	
}