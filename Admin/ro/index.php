<?php require_once('../../Files/server/include/class.usuario.php'); ?>
<?php
	$u = new Usuario();
	
	
	if(!$u->Logado() or $u->Cargo() < 2){
		#header('Location: ../../');
		#exit;
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Administração de Roupas Online</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="src/admin.ro.index.css" />
	</head>
	<body>
		<div class="Fundo_Menu">
			<div class="Selecionar" onClick="javascript:document.location.href='Produtos/Adicionar'">
				<p id="title">Adicionar Produto</p><hr />
				<p id="SubTitle">Adicione produtos ao site</p>
			</div>
			<div class="Selecionar" onClick="javascript:document.location.href='Produtos/Info'">
				<p id="title">Produto info</p><hr />
				<p id="SubTitle">Veja informações sobre um produto</p>
			</div>
			<div class="Selecionar" onClick="javascript:document.location.href='Clientes/'">
				<p id="title">Clientes</p><hr />
				<p id="SubTitle">Menu sobre clientes</p>
			</div>		
		</div>
	</body>
</html>