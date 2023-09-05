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
	public $chaves_produto = array(
		'nome','preco','preco_antigo',
		'data_criacao','visto', 'compras',
		'avaliacao','hadesconto', 'descontovalidade',
		'tipodesconto','calculodesconto','valordesconto',
		'descontotitulo', 'cupomtitulo', 'cores',
		'criador_id','descricao','produto_id',
		'categoria','genero','imagens',
		'anuncio','tamanhos','desativado'
	);

	public $chaves_usuario = array(
		'nome','email','senha','data_criacao','comprasid',
		'produtos_visto','preferencias','genero',
		'ultimoacesso','dadoshardware','carrinho',
		'emailvalidado','cargo','usuario_id','avaliacoesid'	
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

		if(in_array($chave, $this->chaves_produto) === false){
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

	function anuncio_existe(string $anuncioid):bool
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

	function cria_anuncio(string $produto_id,string $criador_id):bool
	{
		if($this->anuncio_existe($produto_id) === true){
			echo "[class=Banco][cria_anuncio(...,...)]: anuncio já existe";
			return false;
		}
		if($this->usuario_existe($criador_id) === false){
			echo "[class=banco][cria_anuncio(...,...): usuário criador do anuncio inexistente";
			return false;
		}

		$t = $this->banco->prepare("INSERT INTO `produto`(`produto_id`,`criador_id`) VALUES(:prodid, :userid)");

		$t->bindParam(":prodid",$produto_id);
		$t->bindParam(":userid",$criador_id);

		$t->execute();

		return false;
	}

	function query(string $sql, array $dados=array())
	{
		$a = $this->banco->prepare($sql);
		
		foreach($dados as $indice => $dado)
		{
			$a->bindParam($indice,$dado);
		}

		$a->execute();

		return $a->fetchAll();
	}

	///usuário 
	function usuario_existe(string $usuarioid):bool
	{
		if(in_array($usuarioid, $this->cache['usuarioid']))
			return true;

		$s = $this->banco->prepare("SELECT `usuario_id` FROM `{$this->tabela_usuario}` WHERE `usuario_id`=:id");

		$s->bindValue('id',$usuarioid);

		$s->execute();

		$r = $s->fetchAll();

		if(count($r) > 0){
			$this->cache['usuarioid'][] = $usuarioid;
			return true;
		}
		
		return false;
	}
	function criar_usuario(string $nome,string $email,string $senha):bool
	{
		if(strlen($nome) < 10)
		{
			echo "[class=Banco][criar_usuario(..,..,..)]: Nome muito curto. Minimo: 10 caracteres";
			return false;
		}

		if(filter_var($email, FILTER_VALIDATE_EMAIL) === false)
		{
			echo "[class=Banco][criar_usuario(..,..,..)]: Sintaxe email inválida";
			return false;
		}

		$r = $this->query("SELECT * FROM `{$this->tabela_usuario}` WHERE email = :email",array(":email"=>$email));

		if(count($r) > 0)
		{
			echo "[class=Banco][criar_usuario(..,..,..)]: Este e-mail já está cadastrado";
			return false;
		}

		$senha = hash('sha512', $senha);

		$a = $this->banco->prepare("INSERT INTO `{$this->tabela_usuario}`(`nome`,`senha`,`email`) VALUES(:nome,:senha,:email)");

		$a->bindParam(":nome",$nome);
		$a->bindParam(":senha",$senha);
		$a->bindParam(":email",$email);

		$a->execute();

		return true;
	}
	function altera_usuario(string $userid,string $key,string $dado):bool
	{
		if($this->usuario_existe($userid) === false)
		{
			echo "[class=Banco][altera_usuario(..)]: Usuário não existe";
			return false;
		}

		if(in_array($key,$this->chaves_usuario) === false)
		{
			echo "[class=Banco][altera_usuario(..)]: chave não encontrada no dicionário de usuários";
			return false;
		}

		$a = $this->banco->prepare("UPDATE `{$this->tabela_usuario}` SET `{$key}`=:dado WHERE `usuario_id`=:id");

		$a->bindParam(":dado",$dado);
		$a->bindParam(":id",$userid);

		$a->execute();

		return true;
	}
	function deletar_usuario(int $userid):bool
	{
		if($this->usuario_existe($userid) === false)
		{
			echo "[class=Banco][deletar_usuario(..)]: Usuário não existe";
			return false;
		}

		$this->query("DELETE FROM `{$this->tabela_usuario}` WHERE `usuario_id`=:id",array(":id"=>$userid));
		return true;
	}
}

$a = new Banco();


print_r($a->query("SELECT * FROM `usuario`"));

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
else{
	$pdo->exec('USE '.db);
}
?>