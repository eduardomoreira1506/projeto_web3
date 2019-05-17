<?php
namespace Controlador;

use \Modelo\Projeto;
use \Modelo\Comentario;
use \Modelo\Pessoa;
use \Modelo\Presidente;
use \Modelo\Deputado;

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
			$nome = parent::getNomeSessao();
			$tipo = parent::getTipoSessao();
			$projeto = Projeto::buscarProjeto($idProjeto);

			if($idPaisSessao == $projeto->getIdPais()){
				$comentarios = Comentario::buscarComentarios($projeto->getIdProjeto());

				$informacoes = [
					'scripts' => ['projeto'],
					'projeto' => $projeto,
					'logado' => $logado,
					'nome' => $nome,
					'comentarios' => $comentarios,
					'tipo' => $tipo
				];


				$this->visao('projetos/projeto.php', $informacoes);
			}else{
				$this->redirecionar(URL_RAIZ);
			}
		}else{
			$projeto = Projeto::buscarProjeto($idProjeto);
			$comentarios = Comentario::buscarComentarios($projeto->getIdProjeto());

			$informacoes = [
				'scripts' => ['projeto'],
				'projeto' => $projeto,
				'logado' => $logado,
				'comentarios' => $comentarios,
				'tipo' => 1
			];

			$this->visao('projetos/projeto.php', $informacoes);
		}
	}

	public function comentar()
	{
		$comentario = $_POST['comentario'];
		$idProjeto = $_POST['idProjeto'];

		$logado = parent::estaLogado();

		if($logado){
			$idPaisSessao = parent::getIdPaisSessao();
			$projeto = Projeto::buscarProjeto($idProjeto);
			$idPais = $projeto->getIdPais();

			if($idPaisSessao == $idPais){
				$tipo = parent::getTipoSessao();
				$email = parent::getEmailSessao();
				if($tipo){
					$deputado = Deputado::buscarDeputado($email);
					$deputado->comentar($idProjeto, $comentario);
				}else{
					$presidente = Presidente::buscarPresidente($email);
					$presidente->comentar($idProjeto, $comentario);
				}

				$resposta = ['status' => true, 'nome' => parent::getNomeSessao()];
				echo json_encode($resposta);
			}else{
				$resposta = ['status' => false, 'frase' => 'Você só pode comentar em projetos do seu país!'];
				echo json_encode($resposta);
			}
		}else{
			$resposta = ['status' => false, 'frase' => 'Você precisa estar logado para poder comentar!'];
			echo json_encode($resposta);
		}
	}

	public function alterarStatusProjeto()
	{
		$status = $_POST['status'];
		$idProjeto = $_POST['idProjeto'];

		$logado = parent::estaLogado();
		if($logado){
			$tipo = parent::getTipoSessao();
			$idPais = parent::getIdPaisSessao();

			if($tipo){
				$resposta = ['status' => false, 'frase' => 'Apenas presidentes podem colocar o projeto em votação!'];
				echo json_encode($resposta);
			}else{
				$projeto = Projeto::buscarProjeto($idProjeto);

				if($projeto->getIdPais() == $idPais){
					if($status == 1 || $status == 4){
						Projeto::atualizar($status, $idProjeto);

						if($status == 1){
							$palavra = "Aprovado";
						}else{
							$palavra = "Reprovado";
						}

						$resposta = ['status' => true, 'frase' => 'Projeto em fase de votação!', 'titulo' => $palavra];
						echo json_encode($resposta);
					}else{
						$resposta = ['status' => false, 'frase' => 'Presidentes não podem votar nos projetos!'];
						echo json_encode($resposta);
					}
				}else{
					$resposta = ['status' => false, 'frase' => 'Você só pode aprovar ou reprovar projetos do seu!'];
					echo json_encode($resposta);
				}
			}
		}
		
	}
}
