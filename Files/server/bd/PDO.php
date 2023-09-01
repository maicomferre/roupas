<?php
	define('HOST','localhost');
	define('USER','user');
	define('password','123');
	define('db','loja_roupas');
	#define('dev',true);

	$pdo = new PDO('mysql:host='.HOST.';port=3306;dbname='.db.';charset=utf8',USER,password);


class Banco{

	public $banco;
	public $tabela_produtos = 'produto';

	function __construct(){
		global $pdo;
		$this->banco = $pdo;
	}

	function atualiza_imagem_anuncio($anuncioid,$strimagens):bool
	{
		if($banco->anuncio_existe($anuncioid) === false)
			echo "[class=Banco][atualiza_imagem_anuncio(..,..)]: não encontrado anuncio $anuncioid";			
			return false;
		
		if(is_string($strimagens) === false){
			echo "[class=Banco][atualiza_imagem_anuncio(..,..)]: $strimagens não é uma string";
			return false;
		}


		$smt = $this->banco->prepare('UPDATE `produto` SET `imagens`=:img where `produto_id`=:id');

		$smt->bindParam('id',$anuncioid);
		$smt->bindParam('img',$strimagens);

		$smt->execute();
	}

	function anuncio_existe($anuncioid):bool
	{
		$s = $this->banco->prepare("SELECT `produto_id` FROM `produto` WHERE `produto_id`=:id");
		
		$s->bindParam('id',$anuncioid);

		$s->execute();

		$r = $s->fetch();

		echo $r;

		return true;
	}

}

$a = new Banco();
$a->anuncio_existe('4234235');





























if(defined('dev')){
	$pdo->exec('CREATE DATABASE '.db);

	$sql = 'CREATE TABLE `loja_roupas`.`produto` ( `nome` VARCHAR(50) NOT NULL ,
	 `preco` DOUBLE NOT NULL ,
	 `preco_antigo` DOUBLE NOT NULL,
	  `data_criacao` DATE NOT NULL ,
	   `visto` INT NOT NULL , 
	   `compras` INT NOT NULL ,
	    `avaliacao` FLOAT NOT NULL ,
	     
	     `hadesconto` BOOLEAN NOT NULL,
	     `descontovalidade` DATE NOT NULL,
	     `tipodesconto` INT NOT NULL,
	     `calculodesconto` INT NOT NULL,
	     `valordesconto` DOUBLE NOT NULL,

	     `descontotitulo` DOUBLE NOT NULL ,
	      `cupomtitulo` VARCHAR(10) NOT NULL ,

	      `cores` VARCHAR(32) NOT NULL,
	       `criador_id` INT NOT NULL ,
	        `descricao` VARCHAR(500) NOT NULL ,
	         `produto_id` VARCHAR(7) NOT NULL ,
	          `categoria` INT NOT NULL ,
	           `genero` VARCHAR(25) NOT NULL ,
	            `imagens` VARCHAR(500) NOT NULL ,
	             `anuncio` BOOLEAN NOT NULL ,
	             `tamanhos` VARCHAR(20) NOT NULL,
	             `desativado` BOOLEAN NOT NULL ) ENGINE = InnoDB;';
	
	$pdo->exec($sql);


	//exemplo
	$sql =$pdo->prepare("INSERT INTO `produto` (nome,preco,visto,compras,avaliacao,cupom,criador_id,Descricao,ProdutoID,Categoria,Genero, imagens,anuncio,desativado,desconto,`data_criacao`) VALUES('Roupa social',685.84,13,112,5,0,2, 'Camisa social para se utilizada socialmente entre grupos sociais.',9600002,3,'M','produtoImagem.jpg,produtoImagem.jpg,produtoImagem.jpg',0,0,1,NOW());");

	$sql->execute();
}
else{
	$pdo->exec('USE '.db);
}
?>