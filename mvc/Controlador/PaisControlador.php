<?php
namespace Controlador;

use \Modelo\Pais;
use \Modelo\Presidente;

class PaisControlador extends Controlador
{
	public function index()
	{
		$logado = parent::estaLogado();

		if($logado){
			$this->redirecionar(URL_RAIZ . 'projetos');
		}else{
			$pais = new Pais();
			$paises = $pais->buscarTodosPaises();

			$informacoes = [
				'scripts' => [],
				'paises' => $paises,
			];

			$this->visao('paises/index.php', $informacoes);
		}
	}

	public function novoPais()
	{
		$logado = parent::estaLogado();

		if($logado){
			$this->redirecionar(URL_RAIZ . 'projetos');
		}else{
			$informacoes = [
				'scripts' => ['novo-pais'],
			];

			$this->visao('paises/novo-pais.php', $informacoes);
		}
	}

	public function verificarPaisExiste()
	{
		$nomePais = $_POST['nomePais'];
		$sigla = $_POST['sigla'];

		if($nomePais == null || $sigla == null || $nomePais == '' || $sigla == ''){
			$resposta = ['status' => false, 'frase' => 'Campos de nome e sigla do país são obrigatórios.'];
			echo json_encode($resposta);
		}elseif(strlen($sigla) != 2){
			$resposta = ['status' => false, 'frase' => 'Sigla precisa ter duas letras.'];
			echo json_encode($resposta);
		}else{
			$verificacao = Pais::paisExiste($nomePais, $sigla);
		
			if($verificacao){
				$resposta = ['status' => false, 'frase' => 'Um país com essa sigla ou nome já existe.'];
			}else{
				$resposta = ['status' => true, 'frase' => 'Muito bem! Como você está criando o pais, você é o presidente! Preencha todos os campos com suas informações pessoais, e claro não se esqueça de mandar a bandeira do seu país para gente!'];
			}

			echo json_encode($resposta);
		}
	}

	public function criarNovoPais()
	{
		$nomePais = $_POST['nome-pais'];
		$sigla = $_POST['sigla'];
		$bandeira = array_key_exists('bandeira-imagem', $_FILES) ? $_FILES['bandeira-imagem'] : null;
		$nomePresidente = $_POST['nome'];
		$email = $_POST['email'];
		$senha = $_POST['senha'];

		$verificacao = Pais::paisExiste($nomePais, $sigla);

		if($nomePais != null && $nomePais != '' && $sigla != null && $sigla != '' && $bandeira != null && $bandeira != '' && $nomePresidente != null && $nomePresidente != '' && $email != null && $email != '' && $senha != null && $senha != '' && $verificacao == false){

			$presidente = new Presidente($nomePresidente, $email, $senha);
			$presidente->inserir();

			$idPresidente = $presidente->getIdPresidente();
			$pais = new Pais($nomePais, $sigla, $bandeira, $idPresidente);
			$pais->inserir();

			$this->redirecionar(URL_RAIZ);
		}
	}

}
