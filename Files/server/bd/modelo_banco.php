<?php
#Modelo

if(defined('dev')){
	$pdo->exec('CREATE DATABASE '.db);

	$sql = 'CREATE TABLE `loja_roupas`.`produto` ( `nome` VARCHAR(50) NULL ,
	 `preco` DECIMAL NULL DEFAULT 0,
	 `preco_antigo` DOUBLE NULL,
	  `data_criacao` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
	   `visto` INT NULL DEFAULT 0, 
	   `compras` INT NULL DEFAULT 0,
	    `avaliacao` double NULL DEFAULT 0,
	     `hadesconto` BOOLEAN NULL DEFAULT 0,
	     `descontovalidade` DATE NULL,
	     `tipodesconto` INT NULL DEFAULT 0,
	     `calculodesconto` INT NULL DEFAULT 0,
	     `valordesconto` DOUBLE NULL DEFAULT 0,
	     `descontotitulo` DOUBLE NULL DEFAULT 0,
	      `cupomtitulo` VARCHAR(100) NULL ,
	      `cores` VARCHAR(32) NULL,
	       `criador_id` INT NOT NULL,
	        `descricao` VARCHAR(500) NULL,
	         `produto_id` VARCHAR(8) NOT NULL,
	          `categoria` INT NULL DEFAULT -1,
	           `genero` VARCHAR(25) NULL,
	            `imagens` VARCHAR(500) NULL,
	             `anuncio` BOOLEAN NULL DEFAULT 0,
	             `tamanhos` VARCHAR(20) NULL,
	             `desativado` BOOLEAN NULL DEFAULT 1 ) ENGINE = InnoDB;';
	
	//$pdo->exec($sql);

	$sql = 'CREATE TABLE `loja_roupas`.`usuario`(
			`nome` VARCHAR(250) NOT NULL,
			`email` VARCHAR(150) NOT NULL,
			`senha` VARCHAR(128) NOT NULL,
			`data_criacao` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
			`comprasid` LONGTEXT NULL DEFAULT NULL,
			`produtos_vistos` VARCHAR(500) NULL DEFAULT NULL,
			`preferencias` VARCHAR(50) NULL DEFAULT NULL,
			`genero` SMALLINT DEFAULT 0,
			`ultimoacesso` DATE NULL DEFAULT NULL,
			`dadoshardware` VARCHAR(500) NULL DEFAULT NULL,
			`carrinho` VARCHAR(1000) NULL DEFAULT NULL,
			`emailvalidado` BOOL DEFAULT 0,
			`cargo` SMALLINT DEFAULT 0,
			`usuario_id` SMALLINT PRIMARY KEY AUTO_INCREMENT,
			`avaliacoesid` LONGTEXT NULL) ENGINE = InnoDB;';


	//$sql->execute();
}
?>