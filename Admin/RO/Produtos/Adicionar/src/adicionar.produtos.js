var Produto = {};



var loaded = false;
$(document).ready(function(){
	loaded = true;

});

var view_opt = 1;
function view(opt){
	if(opt == 'next'){
		if(!validar_opcao(opt)){
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
	if(opt == '1')
	{
		var prod_name = document.getElementById('produto_nome');
		var quant = document.getElementById('produto_quantidade');
		
		
		if(typeof prod_name === undefined || typeof quant === undefined){
			alert('Algo de errado não deu certo! Parece que sua pagina não foi carregada corretamente ou você está fazendo algo que não devia!');
			return false;
		}
		
		if(prod_name.Length < 10){
			MessageEx('#produto_nome',"O nome do produto deve conter pelo menos 10 caracteres para ser melhor descrito!");
			return false;
		}
		else if(prod_name.Length > 100){
			MessageEx('#produto_quantidade',"O produto deve ter no máximo 100 caracteres para não ficar com um titulo demasiadamente grande.");
			return false;
		}
		
	
	}else if(opt == '2')
	{
		
	}else if(opt == '3')
	{
		
	}else if(opt == '4')
	{
		
	}else if(opt == '5')
	{
		
	}else if(opt == '6')
	{
		
	}else if(opt == '7')
	{
		
	}else if(opt == '8')
	{
		
	}else if(opt == '9')
	{
		
	}else 
	
	
}