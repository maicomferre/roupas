$(document).ready(function(){
	$.ajax({
		url:'/Files/server/Request/',
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
	if(Dados['ValorDesconto'] != undefined)
	{
		Valor = Dados['ValorDesconto'];

	}else{
		Valor = Dados['preco'];
	}
	
	var OutrasImg = '';
	var IMGS = Dados['num_imagens'];
	
	//for(var i=0; i<IMGS; i++)
	//	OutrasImg = OutrasImg + '<img src="/Produtos/img/'+Dados.imagens[i]+'" onClick="AlterarImagemPara(this);" /><br />';

	//$('.Conteudo').html(txt);
	$('#preco').html(parseFloat(Dados['preco']).toFixed(2));
	$('#descricao').html(Dados['Descricao']);
	$('#Titulo_Produto').html(Dados['nome']);
	$('#ImgCentrProduto').attr('src','/Produtos/img/'+Dados['imagens'][0]);


	if(Dados['ValorDesconto'] == undefined)
			$('#descontovalorantigo').hide();
	
	
}