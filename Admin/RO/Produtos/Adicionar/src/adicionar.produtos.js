var loaded = false;
$(document).ready(function(){
	loaded = true;

});

var view_opt = 1;
function view(opt){
	if(opt == 'next'){
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