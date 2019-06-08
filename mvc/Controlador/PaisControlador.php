<?php
namespace Controlador;

use \Modelo\Pais;
use \Modelo\Presidente;
use \Framework\DW3Sessao;

class PaisControlador extends Controlador
{
	public function index()
	{
		$logado = DW3Sessao::get('logado');

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
		$logado = DW3Sessao::get('logado');

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
		if($_POST['nomePais'] == null || $_POST['sigla'] == null || $_POST['nomePais'] == '' || $_POST['sigla'] == ''){
			$resposta = ['status' => false, 'frase' => 'Campos de nome e sigla do país são obrigatórios.'];
			echo json_encode($resposta);
		}elseif(strlen($_POST['sigla']) != 2){
			$resposta = ['status' => false, 'frase' => 'Sigla precisa ter duas letras.'];
			echo json_encode($resposta);
		}else{
			$verificacao = Pais::paisExiste($_POST['nomePais'], $_POST['sigla']);

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
		$confirmacaoSenha = $_POST['confirmacao_senha'];

		$verificacao = Pais::paisExiste($nomePais, $sigla);
		$this->verificarLogin();


		if($verificacao){
			$resposta = ['type' => 'error', 'frase' => 'Esse país já existe']; 
		}elseif($nomePais == null || $nomePais == '' || $sigla == null || $sigla == '' || $nomePresidente == null || $nomePresidente == '' || $email == null || $email == '' || $senha == null || $senha == '' || $confirmacaoSenha == '' || $confirmacaoSenha == null){
			$resposta = ['type' => 'error', 'frase' => 'Todos campos são obrigatórios']; 
		}elseif($senha != $confirmacaoSenha){
			$resposta = ['type' => 'error', 'frase' => 'Senha e confirmação de senha são diferentes']; 
		}elseif(strlen($email) < 6 && strlen($email) > 255){
			$resposta = ['type' => 'error', 'frase' => 'Email precisa ter entre 6 e 255 caracteres']; 
		}elseif(strlen($nomePresidente) < 3 && strlen($nomePresidente) > 255){
			$resposta = ['type' => 'error', 'frase' => 'Nome do presidente precisa ter entre 3 e 255 caracteres']; 
		}elseif(strlen($nomePresidente) < 5){
			$resposta = ['type' => 'error', 'frase' => 'Senha precisa ter no mínimo 5 caracteres']; 
		}elseif(strlen($sigla) != 2){
			$resposta = ['type' => 'error', 'frase' => 'Sigla precisa ter duas letras']; 
		}else{
			$pais = new Pais($nomePais, $sigla, $bandeira);
			$pais->inserir();

			$presidente = new Presidente($nomePresidente, $email, $senha, $pais->getIdPais());
			$presidente->inserir();
			$idPresidente = $presidente->getIdPresidente();
			
			$resposta = ['type' => 'success', 'frase' => 'País criado com sucesso'];
		}

		echo json_encode($resposta);
	}

}
