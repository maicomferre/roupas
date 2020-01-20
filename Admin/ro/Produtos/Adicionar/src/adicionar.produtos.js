var Produto = {};
Produto['Imagem'] = Array(); 
var ElementoEmErro = undefined;

var tamanhoDisponivelUsadoProd = 0;

var loaded = false;
$(document).ready(function(){
	loaded = true;

	$(document).keypress(function(e){
		if(e.wich == 13 || e.keyCode == 13){
			if($('input,textarea').is(':focus') == false){
				view('next');
			}
		}
	});
});

var view_opt = 1;
function view(opt){
	if(opt == 'next'){
		
		if(validar_opcao(view_opt-1) === false)return false;
		
		if(view_opt >= 1){
			$('#btn0').html('Próximo');			
		}
		
		$('#opt_'+(view_opt-1)).toggle('slow');
		$('#opt_'+view_opt).toggle('slow');
		if(view_opt != 0)
			view_opt++;
	}
	else if(opt == 'back'){
		if(view_opt == 1)return 0;

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

		//$('#btn1_d').show();

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
	{//imagens
		if(Produto['Imagem'].length < 3){
			MessageEx("#imgadd0","Imagens: Adicione pelo menos 3 imagens.");
			return false;
		}

	}
	else if(opt == '5')
	{//categoria e palavras chavess
		var categorias = document.getElementById('select_opt5');
		var palavrasChaves = document.getElementById('txt_keyword');

		if(categorias.value == 'cat-default'){
			MessageEx('#select_opt5','Categoria: Selecione uma categoria');
			return false;
		}

		if(palavrasChaves.value.length == 0){
			MessageEx('#txt_keyword','Palavras Chave: Selecione Pelo menos 1 Palavra chave');
			return false;
		}

		Produto['categoria'] = categorias.value;
		Produto['keywords'] = palavrasChaves.value;
	}
	else if(opt == '6')
	{//
		Produto['cor1'] = document.getElementById('opt6_color1').value;
		Produto['cor2'] = '-1';

		if(document.getElementById('sec_color_input').checked == true){
			Produto['cor2'] = document.getElementById('opt6_color2').value;
		}

		//Para o opt = 7
		document.getElementById('set_qntEstoque').innerHTML = Produto['quantidade'];
		document.getElementById('set_qntDistribuida').innerHTML = tamanhoDisponivelUsadoProd;

	}
	else if(opt == '7')
	{
		var qnt_pp = document.getElementById('qnt_pp');
		var qnt_p = document.getElementById('qnt_p');
		var qnt_m = document.getElementById('qnt_m');
		var qnt_g = document.getElementById('qnt_g');
		var qnt_gg = document.getElementById('qnt_gg');	

		if(Produto['quantidade'] < tamanhoDisponivelUsadoProd){
			MessageEx('#tam_table','Tamanho: Há mais produtos distribuidos do que produtos reais.');
			return false;
		}

		if(Produto['quantidade'] > tamanhoDisponivelUsadoProd){
			MessageEx('#tam_table','Tamanho: Há produtos não distribuidos.');
			return false;
		}


		Produto['Tamanhos'] = {};
		Produto['Tamanhos']['pp'] = qnt_pp.value;
		Produto['Tamanhos']['p'] = qnt_p.value;
		Produto['Tamanhos']['m'] = qnt_m.value;
		Produto['Tamanhos']['g'] = qnt_g.value;
		Produto['Tamanhos']['gg'] = qnt_gg.value;
	}
	else if(opt == '8')
	{
		
	}
	else if(opt == '9')
	{
		
	}
	
	if(ElementoEmErro !== undefined){
		MessageExRemove(ElementoEmErro);
		Elemento·oooçEmErro = undefined;
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
function preview_images()
{
	var img = document.getElementById('imgadd0');
	var imagen_opcao = document.getElementById('img_img');
	document.getElementById('image_message').style.display = 'block';

	if(img.files){
		var index = img.files.length;

		for(var c=0; c<index; c++){
			var read = new FileReader();

			read.onload = function(event){
				var imagem = new Image();
				imagem.setAttribute('class','img_opt_img');
				imagem.setAttribute('onClick','ImagemRemove('+c+')');
				imagem.setAttribute('id','imagem_autoremove_'+c);
				imagem.title = 'Pressione para remover';
				imagem.src = event.target.result;
				imagen_opcao.appendChild(imagem);
			}
			Produto['Imagem'].push(img.files[c]);
			read.readAsDataURL(img.files[c]);
		}
	}
}

function ImagemRemove(id)
{
	var doc = document.getElementById('imagem_autoremove_'+id);
	if (doc.parentNode)
		doc.parentNode.removeChild(doc);
	else
		doc.remove();
}


var temp_values = [0,0,0,0,0];

function tamn_quant_check()
{
	var distr = document.getElementById('set_qntDistribuida');
	var qnt_pp = document.getElementById('qnt_pp');
	var qnt_p = document.getElementById('qnt_p');
	var qnt_m = document.getElementById('qnt_m');
	var qnt_g = document.getElementById('qnt_g');
	var qnt_gg = document.getElementById('qnt_gg');


	var tm = parseInt(Produto['quantidade']) - parseInt(tamanhoDisponivelUsadoProd);

	if(qnt_pp.value > tm)
		qnt_pp.value = tm;
	else if(qnt_p.value > tm)
		qnt_p.value = tm;
	else if(qnt_m.value > tm)
		qnt_m.value = tm;
	else if(qnt_g.value > tm)
		qnt_m.value = tm;	
	else if(qnt_gg.value > tm)
		qnt_gg.value = tm;

	var sum = parseInt(qnt_pp.value) + parseInt(qnt_p.value) + parseInt(qnt_m.value) + parseInt(qnt_g.value) + parseInt(qnt_gg.value);

	tamanhoDisponivelUsadoProd = sum;

	console.log('Produto["quantidade"] = ' + Produto['quantidade']);
	console.log('distr.value = ' + distr.innerHTML);

	if(tm == 0){
		qnt_gg.max = 0;
		qnt_g.max = 0;
		qnt_m.max = 0;
		qnt_pp.max = 0;
		qnt_p.max = 0;
	}else{
		qnt_gg.max = Produto['quantidade']+1;
		qnt_g.max = Produto['quantidade']+1;
		qnt_m.max = Produto['quantidade']+1;
		qnt_pp.max = Produto['quantidade']+1;
		qnt_p.max = Produto['quantidade']+1;
	}


	if(distr.innerHTML > Produto['quantidade']+1){
		qnt_gg.setAttribute('disabled','true');
		qnt_g.setAttribute('disabled','true');
		qnt_m.setAttribute('disabled','true');
		qnt_pp.setAttribute('disabled','true');
		qnt_p.setAttribute('disabled','true');
	}
	distr.innerHTML = tamanhoDisponivelUsadoProd;
}

