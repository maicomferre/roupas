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
/*
 `nome` VARCHAR(50)
	 `preco` DOUBLE
	  `data_criacao` DATE
	   `visto` INT
	   `compras` INT
	    `avaliacao` FLOAT
	     `desconto` DOUBLE
	      `cupom` VARCHAR(10)
	       `criador_id` INT
	        `Descricao` VARCHAR(500)
	         `ProdutoID` VARCHAR(7)
	          `Categoria` INT
	           `Genero` VARCHAR(25)
	            `imagens` VARCHAR(500)
	             `anuncio` BOOLEAN
	             `desativado` BOOLEAN 
	             `tamanhos` VARCHAR
*/

	var Valor = 0;
	if(Dados['ValorDesconto'] != undefined)
	{
		Valor = Dados['ValorDesconto'];
	}else{
		Valor = Dados['preco'];
	}
	
	var OutrasImg = '';
	var IMGS = Dados['num_imagens'];
	
	for(var i=0; i<IMGS; i++)
		OutrasImg = OutrasImg + '<img src="/Produtos/img/'+Dados.imagens[i]+'" onClick="AlterarImagemPara(this);" /><br />';

	$('.OutrasImg').html(OutrasImg);
	$('#preco').html(parseFloat(Dados['preco']).toFixed(2));
	$('#descricao').html(Dados['Descricao']);
	$('#Titulo_Produto').html(Dados['nome']);
	$('#ImgCentrProduto').attr('src','/Produtos/img/'+Dados['imagens'][0]);



	/*
		//Dados['cores']//deve conter cores em hexadecimal separado por ,

		não há cores em banco de dados precisa mudar o servidor.
		let cores = Dados['cores'].split(',');

		if(cores.length == 0){
			//informar opção indisponível para o anuncio
		}

		for(let x=0; x<cores)
		{
			... //Criar quadrados ou circulos que mostra as cores selecionadas na pagina criar anuncio.

		}
	*/

	/*
		A lógica de desconto não faz sentido. 
		Ela define o desconto caso haja o valor desconto definido.
		mas não define nem mesmo calcula se o desconto é menor que o valor do produto
		deve ser refomulado.

		banco de dados:
			tabela produto:
				hadesconto = bool
				descontovalidade = data deve ser maior que a atual caso não o servidor deve informar falso.
				tipodesconto = int -> se desconto por kit ou por valor minimo(em categoria de produtos) ou por produto
				calculodesconto = bool -> se o tipo é porcentagem ou valor referente a preço
				valordesconto = float -> valor do desconto.

		também relacionado a cupom.

	*/

	Dados['tamanhos'] = Dados['tamanhos'].split(',');
	for(let x=0; x<Dados['tamanhos'].length; x++){
		let dv = document.createElement('div');
		div.setAttribute('id',x);
		div.setAttribute('onClick',"tamanhosclick('"+x+"');");
	
		$(".SelecionarTamanho").add(div);
	}

	if(Dados['ValorDesconto'] == undefined)
			$('#descontovalorantigo').hide();
	else{
		$('#descontovalorantigo').html('$<sub><del>'+Dados['ValorDesconto']+'<del></sub>');
		$('#descontovalorantigo').show();
	}
	
	
}