<?php require_once("../../"); ?>
<?php require_once("../../"); ?>
<?php require_once("../../"); ?>
<?php

$user = new Usuario();

if(!$user->Logado() || $user->Cargo() < 2)
{
	$user->Deslogar();
	exit;
}

?>