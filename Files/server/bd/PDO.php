<?php require_once('../include/regras.php'); ?>
<?php
/*
	Class que gerencia o banco de dados.
	Apenas ela acessa o banco de dados
*/

	define('HOST','localhost');
	define('USER','user');
	define('password','123');
	define('db','loja_roupas');

class Banco{

	private $banco;
	private $tabela_produtos = 'produto';
	private $tabela_usuario = 'usuario';
	private $cache;
	private $chaves_produto = array(
		'nome','preco','preco_antigo',
		'data_criacao','visto', 'compras',
		'avaliacao','hadesconto', 'descontovalidade',
		'tipodesconto','calculodesconto','valordesconto',
		'descontotitulo', 'cupomtitulo', 'cores',
		'criador_id','descricao','produto_id',
		'categoria','genero','imagens',
		'anuncio','tamanhos','desativado',
	);

	private $chaves_usuario = array(
		'nome','email','senha','data_criacao','comprasid',
		'produtos_visto','preferencias','genero',
		'ultimoacesso','dadoshardware','carrinho',
		'emailvalidado','cargo','usuario_id','avaliacoesid',
	);

	public function __construct(){
		$pdo = new PDO('mysql:host='.HOST.';port=3306;dbname='.db.';charset=utf8',USER,password);

		$this->banco = $pdo;

		$this->cache = array(
			'anuncioid' => array(),
			'usuarioid' => array(),
		);
	}

	public function mudar_imagens_anuncio($anuncioid,$imagens):bool
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

	function atualizar_todo_anuncio($anuncioid,$chaves)
	{
		if($this->anuncio_existe($anuncioid) === false){
			echo "[class=Banco][atualizar_todo_anuncio(..,..)]: não encontrado anuncio $anuncioid";			
			return false;
		}
		$indices = '';
		foreach($chaves as $chave => $valor)
		{
			if(in_array($chave,$this->chaves_produto) === false or empty($valor))
			{
				unset($tmp[$chave]);
				continue;
			}
			$tmp[$chave] = $valor;
			$indices .= "`$chave`=:$chave,";
		}

		$tam = strlen($indices)-1;
		if($indices[$tam] === ',')
			$indices = substr($indices,0,$tam);

		$sql = "UPDATE `produto` SET {$indices} WHERE `produto_id`=:id";

		$tmp["id"] = $anuncioid;

		echo "<pre>$sql<hr>";
		print_r($tmp);
		echo "</pre>";


		$this->query($sql,$tmp);
	}

	public function atualizar_especifico_anuncio($anuncioid,$chave,$dados)
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

	public function substitui_imagens_anuncio(string $anuncioid,string $imagens):bool
	{
		if($this->anuncio_existe($anuncioid) === false){
			echo "[class=Banco][substitui_imagens_anuncio(..,..)]: não encontrado anuncio $anuncioid";			
			return false;
		}
		
		if(is_string($imagens) === false){
			echo "[class=Banco][atualiza_imagem_anuncio(..,..)]: $imagens não é uma string";
			return false;
		}

		$smt = $this->prepare('UPDATE `produto` SET `imagens`=:img where `produto_id`=:id');

		$smt->bindParam('id',$anuncioid);
		$smt->bindParam('img',$imagens);

		$smt->execute();
	}
	public function deleta_anuncio(string $anuncioid):bool
	{
		if($this->anuncio_existe($anuncioid) === false){
			echo "[class=Banco][deleta_anuncio(..,..)]: não encontrado anuncio $anuncioid";			
			return false;
		}

		$this->query("DELETE FROM `{$this->tabela_produtos}` WHERE `produto_id`=:id",array(":id"=>$anuncioid));
		return true;

	}
	public function listar_anuncios(array $filtros=array()):bool|array
	{
		if(count($filtros) == 0)
		{
			$a = $this->query("SELECT * FROM `{$this->tabela_produtos}`");
			return $a;
		}

		$ftl = '';

		foreach($filtros as $indice => $filtro)
		{
			$a = match($indice)
			{
				"vistodec" => "ORDER BY `visto` DESC LIMIT ".MAXIMO_LINHAS_RETORNO ,
				"vistocre" =>  "ORDER BY `visto` ASC LIMIT ".MAXIMO_LINHAS_RETORNO,
			};
			$ftl = $a;
		}

		if(strlen($ftl) === 0)
		{
			echo "[class=Banco][listar_anuncios(array ...)]: Filtro não listado";
			return false;
		}

		$r = $this->query("SELECT * FROM `{$this->tabela_produtos}` $ftl");

		return $r;
	}


	public function dado_especifico_anuncio($anuncioid,$dado):array
	{
		if($this->anuncio_existe($anuncioid) === false){
			echo "[class=Banco][dado_especifico_anuncio(..,..)]: não encontrado anuncio $anuncioid";			
			return false;
		}

		if(in_array($dado,$this->chaves_produto) === false)
		{
			echo "[class=Banco][dado_especifico_anuncio(..,..)]: \$dado $dado inválido";			
			return false;			
		}

		$s = $this->banco->prepare("SELECT `{$dado}` FROM `produto` WHERE `produto_id`=:id");
	
		$s->bindParam(":id",$anuncioid);

		$s->execute();

		return $s->fetchAll();
	}

	public function anuncio_existe(string $anuncioid):bool
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

	public function cria_anuncio(string $produto_id,string $criador_id):bool
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

	private function query(string $sql, array $dados=array())
	{
		$a = $this->banco->prepare($sql);
		

		//Erro corrigido com auxilio de
		//http://www.php.net/manual/fr/pdostatement.bindparam.php#98145
		foreach($dados as $indice => &$dado)
		{
			$a->bindParam($indice,$dado);
		}

		$a->execute();

		return $a->fetchAll();
	}

	///usuário 

	public function listar_usuarios()
	{
		return $this->query("SELECT * FROM `{$this->tabela_usuario}`");
	}

	public function usuario_existe(string $usuarioid,bool $verificaporemail=false)
	{
		$tipo = '';
		if(!$verificaporemail)
		{
			if(in_array($usuarioid, $this->cache['usuarioid']))
				return true;

			$tipo = "usuario_id";
		}
		else
		{
			if(filter_var($usuarioid,FILTER_VALIDATE_EMAIL) === false)
			{
				echo "[class=Banco][usuario_existe(..,..)]: Email Inválido";
				return false;
			}
			$tipo = 'email';
		}
		$s = $this->banco->prepare("SELECT `usuario_id` FROM `{$this->tabela_usuario}` WHERE `{$tipo}`=:info");

		$s->bindValue(':info',$usuarioid);

		$s->execute();

		$r = $s->fetchAll();

		$c = count($r);
		if($c == 0){
			return false;
		}else if($c > 1){
			echo "[class=Banco][usuario_existe(..,..)]: Retorno SQL com mais de um usuário.";
			return false;
		}

		if(!$verificaporemail)
			$this->cache['usuarioid'][] = $usuarioid;
		else{
			$r = $r[0]['usuario_id'];
			$this->cache['usuarioid'][] = $r;
			return $r;
		}

		return true;
	}
	public function criar_usuario(string $nome,string $email,string $senha):bool
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

	public function obter_usuario($userid):bool|array
	{
		if($this->usuario_existe($userid) === false)
		{
			echo "[class=Banco][obter_usuario(..)]: Usuário não existe";
			return false;
		}

		$a = $this->query("SELECT * FROM `usuario` WHERE `usuario_id`=:id",array(':id'=>$userid));

		return $a;
	}
	public function obter_especifico_usuario($userid,$chave):bool|array
	{
		if($this->usuario_existe($userid) === false)
		{
			echo "[class=Banco][obter_usuario(..)]: Usuário não existe";
			return false;
		}

		if(in_array($chave,$this->chaves_usuario) === false)
		{
			echo "[class=Banco][altera_usuario(..)]: chave não encontrada no dicionário de usuários";
			return false;
		}

		$a = $this->query("SELECT `{$chave}` FROM `{$this->tabela_usuario}` WHERE `usuario_id`=:id",
			array("id" => $userid)
		);


		return $a;
	}	

	public function altera_usuario(string $userid,string $key,string $dado):bool
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
	public function deletar_usuario(int $userid):bool
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
?>