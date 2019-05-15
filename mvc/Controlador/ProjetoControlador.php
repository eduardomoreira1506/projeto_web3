<?php
namespace Controlador;

use \Modelo\Projeto;
use \Modelo\Pessoa;

class ProjetoControlador extends Controlador
{
	public function index()
	{
		$logado = parent::estaLogado();

		if($logado){
			$idPais = parent::getIdPaisSessao();
			$projeto = new Projeto();
			$projeto->setIdPais($idPais);

			$projetos = $projeto->buscarTodosProjetosDoPais();
		}else{
			$projeto = new Projeto();
			$projetos = $projeto->buscarTodosProjetos();
		}

		$informacoes = [
			'scripts' => [],
			'projetos' => $projetos,
			'logado' => $logado,
		];

		$this->visao('projetos/index.php', $informacoes);
	}

	public function filtrarPais($idPais)
	{
		$logado = parent::estaLogado();
		
		if($logado){
			$this->redirecionar(URL_RAIZ);
		}else{
			$projeto = new Projeto();
			$projeto->setIdPais($idPais);

			$projetos = $projeto->buscarTodosProjetosDoPais();

			$informacoes = [
				'scripts' => [],
				'projetos' => $projetos,
				'logado' => $logado,
			];

			$this->visao('projetos/index.php', $informacoes);
		}
	}

	public function novoProjeto()
	{
		$logado = parent::estaLogado();

		if($logado){
			$tipoSessao = parent::getTipoSessao();

			if($tipoSessao){
				$informacoes = [
					'scripts' => ['novo-projeto'],
					'logado' => $logado,
				];

				$this->visao('projetos/novo-projeto.php', $informacoes);
			}else{
				$this->redirecionar(URL_RAIZ);
			}
		}else{
			$this->redirecionar(URL_RAIZ);
		}
	}

	public function criarNovoProjeto()
	{
		$titulo = $_POST['titulo'];
		$imagem = array_key_exists('imagem', $_FILES) ? $_FILES['imagem'] : null;
		$descricao = $_POST['descricao'];

		$logado = parent::estaLogado();

		if($logado){
			$tipoSessao = parent::getTipoSessao();

			if($titulo != null && $titulo != '' && $imagem != null && $imagem != '' && $descricao != null && $descricao != ''){
				$emailDeputado = parent::getEmailSessao();
				$pessoa = Pessoa::getDeputado($emailDeputado);

				$idDeputado = $pessoa['id_deputado'];

				$idPais = parent::getIdPaisSessao();

				$projeto = new Projeto(null, $idDeputado, $idPais, null, null, $titulo, $descricao, $imagem);
				$projeto->inserir();

				$this->redirecionar(URL_RAIZ);
			}
			
			
		}else{
			$this->redirecionar(URL_RAIZ);
		}
	}

	public function projeto($idProjeto)
	{
		$logado = parent::estaLogado();

		if($logado){
			$idPaisSessao = parent::getIdPaisSessao();
			$projeto = Projeto::buscarProjeto($idProjeto);

			if($idPaisSessao == $projeto->getIdPais()){
				$informacoes = [
					'scripts' => [],
					'projeto' => $projeto,
					'logado' => $logado,
				];

				$this->visao('projetos/projeto.php', $informacoes);
			}else{
				$this->redirecionar(URL_RAIZ);
			}
		}else{
			$projeto = Projeto::buscarProjeto($idProjeto);

			$informacoes = [
				'scripts' => [],
				'projeto' => $projeto,
				'logado' => $logado,
			];

			$this->visao('projetos/projeto.php', $informacoes);
		}
	}
}
