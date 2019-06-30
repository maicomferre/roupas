<?php
	if(!isset($_GET['v']) || empty($_GET['v']) || !isset($_POST['login']) || empty($_POST['login']) || !isset($_POST['pass']) || empty($_POST['pass']))
	{
		header("Location: http://".$_SERVER['HTTP_HOST']);
		exit();
	}
	if($_POST['login'] == 'roupasonline@hotmail.com' && $_POST['pass'] == '1023')
	{
		setcookie('asdkmslw','LIUHERTNMHLDSKJUHYEGRHJKM',0,'/');
		sleep(2);
		header("Location: /Admin/RO");
		exit();
	}else{
		header("Location: http://.$_SERVER['HTTP_HOST']);
	}
?>