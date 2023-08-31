<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Roupas Online - Login</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="/Files/css/Global.css" charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="src/index.login.css" />

		<script type="text/javascript" src="/jquery-3.1.0.min.js" language="javascript"></script>
		<script type="text/javascript" src="src/index.login.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	</head>
	<body>
		<div class="Titulo">
			<img id="image0" src="/Files/img/Camisa0.gif" />
			<img id="image1" src="/Files/img/Camisa1.gif" />
			<p id="Title">Entre para continuar</p>
			<p id="SubTitle">Compre aqui, roupa para toda a família</p>
			<p id="credits">Desenvolvido por: Maicom Ferreira</p>
		</div>
		<nav id="naveounavegando">
			<!-- Menu -->
		</nav><br />
		<div class="Conteudo">
			
			<h1>Faça login para continuar</h1><hr />
			<form action="/Files/server/request/accounts/login.php" method="post">
				
		
				<label for="email">Seu e-mail:</label><br />
				<input type="email" name="email" id="email" autofocus required placeholder="Digite seu email" /><br /><br />
				
				<label for="pass">Sua senha:</label><br />
				<input type="password" name="pass" id="pass" required placeholder="Digite sua senha" /><br /><br />
				
				<input type="submit" value="Entrar" />
			</form>
		</div>