<?php
/*
	Verifica login do usuário


*/
if(strtolower($_SERVER['REQUEST_METHOD']) !== 'post'){
	http_response_code(403);
	exit();
}

if(!isset($_POST['login']) or  !isset($_POST['pass']) or empty($_POST['login']) or  empty($_POST['pass'])){
	http_response_code(403);
	exit();
}

session_start();


/*
	Falta integrar com banco de dados
*/
$_SESSION['Admin'] = true;
$_SESSION['cargo'] = 3;

?>