<?php
	define('HOST','localhost');
	define('USER','user');
	define('password','123');
	define('db','loja_roupas');
	#define('dev',true);

	$pdo = new PDO('mysql:host='.HOST.';port=3306;charset=utf8',USER,password);

if(defined('dev')){
	$pdo->exec('CREATE DATABASE '.db);

	$sql = 'CREATE TABLE `'.db.'`.`produto` ( `nome` VARCHAR(50) NOT NULL ,
	 `preco` DOUBLE NOT NULL ,
	  `data_criacao` DATE NOT NULL ,
	   `visto` INT NOT NULL , `compras` INT NOT NULL ,
	    `avaliacao` FLOAT NOT NULL ,
	     `desconto` DOUBLE NOT NULL ,
	      `cupom` VARCHAR(10) NOT NULL ,
	       `criador_id` INT NOT NULL ,
	        `Descricao` VARCHAR(500) NOT NULL ,
	         `ProdutoID` VARCHAR(7) NOT NULL ,
	          `Categoria` INT NOT NULL ,
	           `Genero` VARCHAR(25) NOT NULL ,
	            `imagens` VARCHAR(500) NOT NULL ,
	             `anuncio` BOOLEAN NOT NULL , 
	             `desativado` BOOLEAN NOT NULL ) ENGINE = InnoDB;';
	
	$pdo->exec($sql);

	$sql =$pdo->prepare("INSERT INTO `produto` (nome,preco,visto,compras,avaliacao,cupom,criador_id,Descricao,ProdutoID,Categoria,Genero, imagens,anuncio,desativado,desconto,`data_criacao`) VALUES('Roupa social',685.84,13,112,5,0,2, 'Camisa social para se utilizada socialmente entre grupos sociais.',9600002,3,'M','produtoImagem.jpg,produtoImagem.jpg,produtoImagem.jpg',0,0,1,NOW());");

	$sql->execute();
}
else{
	$pdo->exec('USE '.db);
}
?>