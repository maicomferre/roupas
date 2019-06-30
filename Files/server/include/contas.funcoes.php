<?php


function Logado():bool
{
	return $_SESSION['Logado'] ?? $_SESSION['Logado'] : false;
}

function Cargo():int
{
	return $_SESSION['Cargo'] ?? $_SESSION['Cargo'] : 0;
}


?>