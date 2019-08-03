var Produto = {};
var ElementoEmErro = undefined;

var tamanhoDisponivelUsadoProd = 0;

var loaded = false;
$(document).ready(function(){
	loaded = true;

	$(document).keypress(function(e){
		if(e.wich == 13 || e.keyCode == 13){
			if($('input,textarea').is(':focus') === false){
				view('next');
			}
		}
	});
});

var view_opt = 1;
function view(opt){
	if(opt == 'next'){
		
		if(validar_opcao(view_opt-1) === false){
			return false;
		}
		
		if(view_opt >= 1){
			$('#btn0').html('Próximo');			
		}
		
		$('#opt_'+(view_opt-1)).toggle('slow');
		$('#opt_'+view_opt).toggle('slow');
		if(view_opt != 0)
		view_opt++;
	}else if(opt == 'back'){
		if(view_opt == 1)return 0;
		$('#opt_'+view_opt-1).toggle('slow');
		$('#opt_'+view_opt).toggle('slow');
		view_opt--;
	}else{
		alert('function view(opt='+opt+'); parametro opt inválido');
	}
	return 1;
}
function validar_opcao(opt)
{
	if(opt == 1)
	{
		var prod_name = document.getElementById('produto_nome');
		var quant = document.getElementById('produto_quantidade');
		
		if(prod_name === undefined || prod_name === null || quant === undefined || quant === null){
			alert('Algo de errado não deu certo! Parece que sua pagina não foi carregada corretamente ou você está fazendo algo que não devia!');
			return false;
		}
		VerificarSeTemQRemover();
		quant = parseInt(quant.value);
		
		if(prod_name.value.length < 10){
			MessageEx('#produto_nome',"Nome do produto: O nome do produto deve conter pelo menos 10 caracteres para ser melhor descrito!");
			return false;
		}
		else if(prod_name.value.length > 100){
			MessageEx('#produto_nome',"Nome do produto:O produto deve ter no máximo 100 caracteres para não ficar com um titulo demasiadamente grande.");
			return false;
		}
		
		Produto['nome'] = prod_name.value;
		
		if(isNaN(quant)){
			document.getElementById('produto_quantidade').focus();
			MessageEx('#produto_quantidade',"Quantidade: Verifique se o valor digitado é um número");
			return false;			
		}
		else if(quant === 0){
			document.getElementById('produto_quantidade').focus();
			MessageEx('#produto_quantidade',"Quantidade: Por favor, informe a quantidade disponível no estoque");
			return false;
		}
		
		Produto['quantidade']  = quant;
	}
	else if(opt == '2')
	{
		var quant = document.getElementById('produto_preco');
		
		if(quant === undefined || quant === null){
			alert('Algo de errado não deu certo! Parece que sua pagina não foi carregada corretamente ou você está fazendo algo que não devia!');
			return false;			
		}
		
		var preco = parseFloat(quant.value);
		
		if(isNaN(preco)){
			quant.focus();
			MessageEx('#produto_preco',"Quantidade: Verifique se o valor digitado é um número");
			return false;				
		}
		else if(preco < 0){
			quant.focus();
			MessageEx('#produto_preco',"Preço: Verifique o preço do produto. Deve ser maior ou igual a 0(gratis)");
			return false;			
		}

		Produto['preco'] = preco;
	}
	else if(opt == '3')
	{
		var txt = document.getElementById('text').value;
		
		if(txt === undefined || txt === null){
			alert('Algo de errado não deu certo! Parece que sua pagina não foi carregada corretamente ou você está fazendo algo que não devia!');
			return false;
		}
		
		if(txt.length === 0){
			document.getElementById('text').focus();
			MessageEx('#text',"Descrição: Desceva o produto");
			return false;
		}
		else if(txt.length > 500){
			document.getElementById('text').focus();
			MessageEx('#text',"Máximo de 500 caracteres!");
			return false;			
		}
		
		Produto['descricao'] = txt;
		
	}
	else if(opt == '4')
	{
		
	}
	else if(opt == '5')
	{
		
	}
	else if(opt == '6')
	{
	

		//Para o opt = 7
		document.getElementById('set_qntEstoque').innerHTML = Produto['quantidade'];
		document.getElementById('set_qntDistribuida').innerHTML = tamanhoDisponivelUsadoProd;
	}
	else if(opt == '7')
	{
		
	}
	else if(opt == '8')
	{
		
	}else if(opt == '9')
	{
		
	}
	
	if(ElementoEmErro !== undefined){
		MessageExRemove(ElementoEmErro);
		ElementoEmErro = undefined;
	}	
	
	return true;
}

function MessageEx(elemento,texto){
	ElementoEmErro = elemento;
	$(elemento).css({'border':'1px solid #EE0000'});
	$('#alerta_erro').html(texto);
	$('#alerta_erro').hide();
	$('#alerta_erro').show('fat');
		
}
function MessageExRemove(elemento){
	$(elemento).css({'border':'1px solid #555555'});
	$('#alerta_erro').hide();
}
function VerificarSeTemQRemover(){
	if(ElementoEmErro !== undefined){
		MessageExRemove(ElementoEmErro);
		ElementoEmErro = undefined;
	}	
	
}