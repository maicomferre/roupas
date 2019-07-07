<?php require_once('..\Files\server\include\class.usuario.php'); ?>
<?php
	$u = new Usuario();
	
	#>>>>temporário
	header('Location: ro/');
	exit;
	#>>>>temporário

	if(!$u->Logado())
		
		header("Location: Admin/login");

	else if($u->Cargo() < 2)
		
		header("Location: ../");
	else if(Cargo() > 1)
		header('Location: ro/');
?>	