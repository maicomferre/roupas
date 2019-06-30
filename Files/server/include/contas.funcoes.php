<?php
#session_start();

function Logado():bool
{
	$logado = $_SESSION['Logado'] ?? true;
	return $logado;
}

function Cargo():int
{
	return $_SESSION['Cargo'] ??  3;
}


?>