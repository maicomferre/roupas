<?php
	define('HOST','127.0.0.1');
	define('USER','root');
	define('password','');
	define('db','roupas');
	$pdo = new PDO('mysql:host='.HOST.';dbname='.db.';charset=utf8',USER,password);
	#$pdo->


if(defined('dev')){
	$sql = 'CREATE TABLE `roupas`.`produto` ( `nome` VARCHAR(50) NOT NULL , `preco` DOUBLE NOT NULL , `data_criacao` DATE NOT NULL , `visto` INT NOT NULL , `compras` INT NOT NULL , `avaliacao` FLOAT NOT NULL , `desconto` DOUBLE NOT NULL , `cupom` VARCHAR(10) NOT NULL , `criador_id` INT NOT NULL , `Descricao` VARCHAR(500) NOT NULL , `ProdutoID` VARCHAR(7) NOT NULL , `Categoria` INT NOT NULL , `Genero` INT NOT NULL , `imagens` VARCHAR(500) NOT NULL , `anuncio` BOOLEAN NOT NULL , `desativado` BOOLEAN NOT NULL ) ENGINE = InnoDB;';
	
	
	$pdo = "INSERT INTO `produto`(nome,valor,visto,compras,avaliacao,ValorDesconto,cupom,criador_id,Descricao,ProdutoID,Categoria,Genero,
	imagens,anuncio,desativo,desconto) VALUES('Roupa social',685.84,13,112,5,384,0,2,
	'Camisa social para se utilizada socialmente entre grupos sociais.',96000012,'social','masculino','produtoImagem.jpg,produtoImagem.jpg,produtoImagem.jpg',0,0,1);";
}
?>