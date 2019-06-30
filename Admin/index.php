<?php require_once('..\Files\server\include\contas.funcoes.php'); ?>
<?php
	session_start();
	

	if(!Logado())
		
		header("Location: Admin/login");

	else if(Logado() && Cargo() < 2)
		
		header("Location: ../");
	else if(Logado() && Cargo() > 1)
		header('Location: ro/');
?>	