<?php require_once('../include/regras.php'); ?>
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
	public $tabela_usuario = 'usuario';
	public $cache;
	public $chaves = array(
		'nome','preco','preco_antigo',
		'data_criacao','visto', 'compras',
		'avaliacao','hadesconto', 'descontovalidade',
		'tipodesconto','calculodesconto','valordesconto',
		'descontotitulo', 'cupomtitulo', 'cores',
		'criador_id','descricao','produto_id',
		'categoria','genero','imagens',
		'anuncio','tamanhos','desativado'
	);


	function __construct(){
		global $pdo;
		$this->banco = $pdo;

		$this->cache = array(
			'anuncioid' => array(),
			'usuarioid' => array(),
		);
	}

	function mudar_imagens_anuncio($anuncioid,$imagens):bool
	{
		if($this->anuncio_existe($anuncioid) === false){
			echo "[class=Banco][mudar_imagens_anuncio(..,..)]: não encontrado anuncio $anuncioid";			
			return false;
		}

		$esp = $this->dado_especifico_anuncio($anuncioid,'imagens');

		$esp = explode(',',$esp[0]['imagens']);

		foreach($imagens as $i => $x)
		{
			for($c=0; $c<count($esp); $c++)
			{
				if($i === $esp[$c])
					$esp[$c] = $x;
			}
		}

		$esp = implode(',',$esp);

		$this->atualizar_especifico_anuncio($anuncioid,'imagens',$esp);
		return true;
	}

	function atualizar_especifico_anuncio($anuncioid,$chave,$dados)
	{
		if($this->anuncio_existe($anuncioid) === false){
			echo "[class=Banco][atualizar_especifico_anuncio(..,..)]: não encontrado anuncio $anuncioid";			
			return false;
		}

		if(in_array($chave, $this->chaves) === false){
			echo "[class=Banco][atualizar_especifico_anuncio(..,..)]: $chave chave não econtrada no dicionário";
			return false;
		}

		$smt = $this->banco->prepare("UPDATE `produto` SET `{$chave}`=:dados where `produto_id`=:id");

		$smt->bindParam('dados',$dados);
		$smt->bindParam('id',$anuncioid);

		$smt->execute();
	}

	function substitui_imagens_anuncio($anuncioid,$strimagens):bool
	{
		if($this->banco->anuncio_existe($anuncioid) === false){
			echo "[class=Banco][substitui_imagens_anuncio(..,..)]: não encontrado anuncio $anuncioid";			
			return false;
		}
		
		if(is_string($strimagens) === false){
			echo "[class=Banco][atualiza_imagem_anuncio(..,..)]: $strimagens não é uma string";
			return false;
		}

		$smt = $this->prepare('UPDATE `produto` SET `imagens`=:img where `produto_id`=:id');

		$smt->bindParam('id',$anuncioid);
		$smt->bindParam('img',$strimagens);

		$smt->execute();
	}

	function dado_especifico_anuncio($anuncioid,$dado):array
	{
		if($this->anuncio_existe($anuncioid) === false){
			echo "[class=Banco][dado_especifico_anuncio(..,..)]: não encontrado anuncio $anuncioid";			
			return false;
		}

		$s = $this->banco->prepare("SELECT `{$dado}` FROM `produto` WHERE `produto_id`=:id");
	
		$s->bindParam(":id",$anuncioid);

		$s->execute();

		return $s->fetchAll();
	}

	function anuncio_existe($anuncioid):bool
	{
		if(in_array($anuncioid, $this->cache['anuncioid']))
			return true;

		$s = $this->banco->prepare("SELECT `produto_id` FROM `produto` WHERE `produto_id`=:id");
		
		$s->bindParam('id',$anuncioid);

		$s->execute();

		$r = $s->fetchAll();

		if(count($r) > 0){
			$this->cache['anuncioid'][] = $anuncioid;
			return true;
		}
		
		return false;
	}

	function cria_anuncio($produto_id,$criador_id):bool
	{
		/*if($this->anuncio_existe($produto_id) === true){
			echo "[class=Banco][cria_anuncio(...,...)]: anuncio já existe";
			return false;
		}
		if($this->usuario_existe($criador_id) === false){
			echo "[class=banco][cria_anuncio(...,...): usuário criador do anuncio inexistente";
			return false;
		}*/

		$t = $this->banco->prepare("INSERT INTO `produto`(`produto_id`,`criador_id`) VALUES(:prodid, :userid)");

		$t->bindParam(":prodid",$produto_id);
		$t->bindParam(":userid",$criador_id);

		$t->execute();

		return false;
	}


	///usuário 
	function usuario_existe(string $usuarioid):bool
	{
		if(in_array($usuarioid, $this->cache['usuarioid']))
			return true;

		$s = $this->banco->prepare("SELECT `usuario_id` FROM `{$this->tabela_usuario}` WHERE `usuario_id`=:id");

		$s->bindParam('id',$usuarioid);

		$s->execute();

		$r = $s->fetchAll();

		if(count($r) > 0){
			$this->cache['usuarioid'][] = $usuarioid;
			return true;
		}
		
		return false;		
	}
}

$a = new Banco();

$array = array();


$a->cria_anuncio('123123','123124');


/*
//print_r($a->dado_especifico_anuncio('7593026','imagens'));



 $a->mudar_imagens_anuncio('7593026',array(
 	'asd.jpg'=>'maicom.jpg',
 	'wewq.jpg'=>'joshua.jpg',
 ));


*/





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
	
	$pdo->exec($sql);

/*
	//exemplo
	$sql =$pdo->prepare("INSERT INTO `produto` (
	 `nome`,
	 `preco`,
	 `preco_antigo`,
	  `data_criacao`,
	   `visto`, 
	   `compras`,
	    `avaliacao`,
	     
	     `hadesconto`,
	     `descontovalidade`,
	     `tipodesconto`,
	     `calculodesconto`,
	     `valordesconto`,

	     `descontotitulo`,
	      `cupomtitulo`,

	      `cores`,
	       `criador_id`,
	        `descricao`,
	         `produto_id`,
	          `categoria`,
	           `genero`,
	            `imagens`,
	             `anuncio`,
	             `tamanhos`,
	             `desativado`
	    )  VALUES(
	 'Casaco de teste para moda',
	 182.93,
	 321.14,
	  NOW(),
	   0, 
	   0,
	    0,
	     
	     false,
	     NOW(),
	     0,
	     0,
	     0,

	     0,
	      'black',

	      '0xFFCCAA,0xFFFFFF',
	       01,
	        'Produto bem Produtado conhecido mundialmente por seus Produtamentos',
	         '7593026',
	          0,
	           0,
	            'asd.jpg,eer.jpg,efer.jpg,eerf.jpg,wewq.jpg',
	             true,
	             '0,1,3',
	             false
	    );
*/
	$sql->execute();
}
else{
	$pdo->exec('USE '.db);
}
?>