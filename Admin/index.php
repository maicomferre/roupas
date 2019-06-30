<?php
	session_start();
	
	if(!isset($_GET['Auth']) || empty($_GET['Auth']))
	{
		header("Location: http://".$_SERVER['HTTP_HOST']);
		exit();
	}
	if($_GET['Auth'] == '1023')
	{
		if(!isset($_SESSION['Logado']))
		{
			header("Location: http://".$_SERVER['HTTP_HOST'].'/Admin/login');
			exit();
		}
		if($_SESSION['Logado'] !== true)
		{
			header("Location: http://".$_SERVER['HTTP_HOST'].'/Admin/login');
			exit();
		}else{
			header("Location: http://".$_SERVER['HTTP_HOST'].'/Admin/RO');
			exit();
		}
		exit(0);
	}else{
		header("Location: http://".$_SERVER['HTTP_HOST']);
		exit();	
	}
?>	