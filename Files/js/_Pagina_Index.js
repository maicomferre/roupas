var ROUPA = [];
var ROUPA_Indice = 0;
var FILTRO = [];
var FILTRO_Indice = 0;
var Imagens0Carregadas = 0;
function CriarRoupa(retorno)
{
	ROUPA[ROUPA_Indice] = []; 
	
	img = retorno['imagens'].split(',');
	
	ROUPA[ROUPA_Indice]['Imagem'] = img[0];
	ROUPA[ROUPA_Indice]['Imagem2'] = img[1];
	ROUPA[ROUPA_Indice]['Valor_Original'] = retorno['val'];
	ROUPA[ROUPA_Indice]['ProdutoID'] = retorno['ProdutoID'];
	ROUPA[ROUPA_Indice]['ValorDesconto'] = retorno['Desconto'];
	ROUPA[ROUPA_Indice]['Tipo'] = retorno['Tipo'];
	ROUPA[ROUPA_Indice]['Genero'] = retorno['Genero'];
	ROUPA[ROUPA_Indice]['Centralizacao_X'] = retorno['CT_X'];
	ROUPA[ROUPA_Indice]['Centralizacao_Y'] = retorno['CT_Y'];
	ROUPA[ROUPA_Indice]['Descricao'] = retorno['Descricao'];
	ROUPA[ROUPA_Indice]['Imagem_Indice'] = 0;
	var HTML = '';
	HTML  =	'<div class="ListObject" onmousemove="AlterarImagem(this);" title="'+ROUPA[ROUPA_Indice]['Descricao']+'" id="'+ROUPA_Indice+'"><a href="Produtos/?categoria='+ExtensoGenero(ROUPA[ROUPA_Indice]['Genero'])+'&ProdutoID='+ROUPA[ROUPA_Indice]['ProdutoID']+'"><img src="Produtos/img/'+ROUPA[ROUPA_Indice]['Imagem']+'" ></div>';
	$('.listamaisvendidos').html($('.listamaisvendidos').html()+HTML);
	ROUPA_Indice++;
}
function Filtro_Adicionar(filtro,tipo)
{
	if(filtro === 'genero')
	{
		switch(tipo)
		{
			case 'F':
				break;
			case 'M':
				break;
			case 'FI':
				break;
			case 'MI':
				break;
			case 'A':
				break;
			default:
				alert('Erro javascript; Função: Filtro_Adicionar; Valor em parametro "tipo" invalido');
				return false;
		}
	}
	if(filtro === 'tamanho')
	{
		switch(tipo)
		{
			case  'G':
				break;
			case 'GG':
				break;
			case 'M':
				break;
			case 'P':
				break;
			case 'MP':
				break;
			default:
				alert('Erro javascript; Função: Filtro_Adicionar("'+filtro+'","'+tipo+'"); Valor em parametro "tipo" invalido');
				return false;			
		}
	}
	if(filtro === 'valor_ate')
	{
		switch(tipo)
		{
			case '':
				break;			
		}
	}
}
function Filtro_Remover(filtro)
{
	
}
function Filtro_Alterar(filtro,tipo)
{
	
}
function ExtensoGenero(genero)
{
		switch(genero)
		{
			case 'F':
				genero = 'feminino';
				break;
			case 'M':
				genero = 'masculino';
				break;
			case 'MI':
				genero = 'masculino-infantil';
				break;
			case 'FI':
				genero = 'feminino-infantil';
				break;
			case 'A':
				genero = 'animais-domesticos';
				break;
			case 'SAF':
				genero = 'sapatos-feminino';
				break;
			case 'SAM':
				genero = 'sapatos-masculino';				
			default:
				alert('Erro javascript; Função: ExtensoGenero; Valor em parametro "genero" invalido');
				return false;
		}
	return genero;
}
function AlterarImagem (elemento){
	
}
var ABRIRLISTAMENU =false;
function AbrirListaMenu(Op,elemento){
	ABRIRLISTAMENU = true; 
	setTimeout(function(){AbrirListaMenu2(Op,elemento)},600);
}
function AbrirListaMenu2(Op,elemento){
	if(ABRIRLISTAMENU===false)return false;
	if(elemento === undefined){
		alert('[Arquivo=_Pagina_Index.js][Funcao=AbrirListaMenu('+Op+','+elemento+')][Tipo=Erro] Elemento não definido;');
		return false;
	}
	$('.Seta').css('left',elemento.offsetLeft+'px');
	$('.Conteudo_Links').show();
}
function ListaMenuFechar(){
	ABRIRLISTAMENU = false;
	$('.Conteudo_Links').hide();
}
function Filtros(acao){
	
}
$(document).ready(function(){
	var rl = $.ajax({
		url:'Files/server/Request.php?Roupas=all',
		method:'GET',
		cache:false,
		dataType:"json"
	});
	
	rl.done(function(valor){
		if(valor.length === 0)
		{
			alert('Erro! Javascript: AJAX; servidor não retornou informações 0x0F0F0F');
			return false;
		}
		var indice = valor['indice'];
		valor = valor[0];

		$('.listamaisvendidos').html('');
				
		for(var c=0; c<indice; c++)
		{
			if(valor[c] === undefined)continue;
			CriarRoupa(valor[c]);
		}
	});
});