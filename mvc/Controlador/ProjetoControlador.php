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
		$logado = $this->estaLogado();

		if($logado){
			$idPais = $this->getIdPaisSessao();
			$projeto = new Projeto();
			$projeto->setIdPais($idPais);

			$projetos = $projeto->buscarTodosProjetosDoPais();
		}else{
			$projeto = new Projeto();
			$projetos = $projeto->buscarTodosProjetos();
		}

		$informacoes = [
			'scripts' => ['projetos'],
			'projetos' => $projetos,
			'logado' => $logado,
		];

		$this->visao('projetos/index.php', $informacoes);
	}

	public function paginacao()
	{
		$logado = $this->estaLogado();
		$paginacao = $_POST['paginacao'];

		if($logado){
			$idPaisSessao = $this->getIdPaisSessao();
			$projetos = Projeto::buscarProjetosDoPaisPaginacao($idPaisSessao, $paginacao);
		}else{
			$projetos = Projeto::buscarProjetosPaginacao($paginacao);
		}

		echo json_encode($projetos);
	}

	public function buscar()
	{
		$logado = $this->estaLogado();
		$palavraChave = $_POST['palavraChave'];

		if($logado){
			$idPaisSessao = $this->getIdPaisSessao();
			$projetos = Projeto::buscarProjetosDoPaisPalavraChave($idPaisSessao, $palavraChave);
		}else{
			$projetos = Projeto::buscarProjetosPalavraChave($palavraChave);
		}

		echo json_encode($projetos);
	}

	public function filtrar()
	{
		$logado = $this->estaLogado();
		$filtro = $_POST['filtro'];

		if($logado){
			$idPaisSessao = $this->getIdPaisSessao();
			$projetos = Projeto::filtarProjetosDoPais($idPaisSessao, $filtro);
		}else{
			$projetos = Projeto::filtrarProjetos($filtro);
		}

		echo json_encode($projetos);
	}

	public function filtrarPais($idPais)
	{
		$logado = $this->estaLogado();
		
		if($logado){
			$this->redirecionar(URL_RAIZ);
		}else{
			$projeto = new Projeto();
			$projeto->setIdPais($idPais);

			$projetos = $projeto->buscarTodosProjetosDoPais();

			$informacoes = [
				'scripts' => ['projetos'],
				'projetos' => $projetos,
				'logado' => $logado,
			];

			$this->visao('projetos/index.php', $informacoes);
		}
	}

	public function novoProjeto()
	{
		$logado = $this->estaLogado();

		if($logado){
			$informacoes = [
				'scripts' => ['novo-projeto'],
				'logado' => $logado,
			];

			$this->visao('projetos/novo-projeto.php', $informacoes);
		}else{
			$this->redirecionar(URL_RAIZ);
		}
	}

	public function criarNovoProjeto()
	{
		$titulo = $_POST['titulo'];
		$imagem = array_key_exists('imagem', $_FILES) ? $_FILES['imagem'] : null;
		$descricao = $_POST['descricao'];

		$logado = $this->estaLogado();

		if($logado){
			if($titulo == null || $titulo == '' || $imagem == null || $imagem == '' || $descricao == null || $descricao == ''){
				$resposta = ['type' => 'error', 'frase' => 'Todos campos são obrigatórios'];
			}elseif(strlen($titulo) < 4 || strlen($titulo) > 254){
				$resposta = ['type' => 'error', 'frase' => 'Título do projeto precisa ter de 4 a 255 caracteres'];
			}elseif(strlen($descricao) < 10 || strlen($descricao) > 254){
				$resposta = ['type' => 'error', 'frase' => 'Descrição do projeto precisa ter de 10 a 255 caracteres'];
			}else{
				$tipoSessao = $this->getTipoSessao();
				$idPais = $this->getIdPaisSessao();
				$emailSessao = $this->getEmailSessao();

				if($tipoSessao){
					$pessoa = Deputado::getDeputado($emailSessao);
					$idDeputado = $pessoa['id_deputado'];

					$projeto = new Projeto(null, $idDeputado, $idPais, null, null, $titulo, $descricao, $imagem);
				}else{
					$presidente = Presidente::buscarPresidente($emailSessao);
					$idPresidente = $presidente->getIdPresidente();

					$projeto = new Projeto(null, null, $idPais, null, null, $titulo, $descricao, $imagem, null, null, null, $idPresidente);
				}

				$projeto->inserir();
				

				$resposta = ['type' => 'success', 'frase' => 'Projeto criado com sucesso'];
			}

			echo json_encode($resposta);
		}else{
			$this->redirecionar(URL_RAIZ);
		}
	}

	public function projeto($idProjeto)
	{
		$logado = $this->estaLogado();

		if($logado){
			$idPaisSessao = $this->getIdPaisSessao();
			$nome = $this->getNomeSessao();
			$tipo = $this->getTipoSessao();
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

		$logado = $this->estaLogado();

		if($logado){
			if(strlen($comentario) > 255){
				$resposta = ['status' => false, 'frase' => 'Comentário deve ter no máximo 255 caracteres!'];
			}else{
				$idPaisSessao = $this->getIdPaisSessao();
			$projeto = Projeto::buscarProjeto($idProjeto);
			$idPais = $projeto->getIdPais();

			if($idPaisSessao == $idPais){
				$tipo = $this->getTipoSessao();
				$email = $this->getEmailSessao();
				if($tipo){
					$deputado = Deputado::buscarDeputado($email);
					$deputado->comentar($idProjeto, $comentario);
				}else{
					$presidente = Presidente::buscarPresidente($email);
					$presidente->comentar($idProjeto, $comentario);
				}

				$resposta = ['status' => true, 'nome' => $this->getNomeSessao()];
			}else{
				$resposta = ['status' => false, 'frase' => 'Você só pode comentar em projetos do seu país!'];
			}	
			}
			
			echo json_encode($resposta);
		}else{
			$resposta = ['status' => false, 'frase' => 'Você precisa estar logado para poder comentar!'];
			echo json_encode($resposta);
		}
	}

	public function alterarStatusProjeto()
	{
		$status = $_POST['status'];
		$idProjeto = $_POST['idProjeto'];

		$logado = $this->estaLogado();
		if($logado){
			$tipo = $this->getTipoSessao();
			$idPais = $this->getIdPaisSessao();

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
