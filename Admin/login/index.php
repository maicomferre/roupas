<!DOCTYPE html>
<html>
	<head>
		<title>Admin - Login</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="src/admin.login.index.css" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	</head>
	<body>
		<div class="fundo"></div>
		<div class="fundo_input">
			<form action="../../Files/server/request/contas/Logar.php" method="post">
				<input type="text" id="login" required name="login" placeholder="Login" /><br />
				<input type="password" id="pass" required name="pass" placeholder="Senha" /><br />
				<input type="submit" value="Entrar" />
			</form>
		</div>
	</body>
</html>