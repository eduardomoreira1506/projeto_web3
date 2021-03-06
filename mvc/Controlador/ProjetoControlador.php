<?php
namespace Controlador;

use \Modelo\Projeto;
use \Modelo\Comentario;
use \Modelo\Pessoa;
use \Modelo\Presidente;
use \Modelo\Deputado;
use \Framework\DW3Sessao;

class ProjetoControlador extends Controlador
{
	public function index()
	{
		$logado = DW3Sessao::get('logado');

		if($logado){
			$idPais = $this->getIdPaisSessao();
			$projetos = Projeto::buscarTodosProjetosDoPais($idPais);
		}else{
			$projetos = Projeto::buscarTodosProjetos();
		}

		$informacoes = [
			'scripts' => ['projetos'],
			'projetos' => $projetos,
		];

		$this->visao('projetos/index.php', $informacoes);
	}

	public function busca()
	{
		$logado = DW3Sessao::get('logado');
		$palavraChave = $_POST['palavraChave'];
		$url = $_POST['url'];
		$filtro = $_POST['filtro'];
		$paginacao = $_POST['paginacao'];

		if($logado){
			$idPaisSessao = $this->getIdPaisSessao();
			$projetos = Projeto::buscaProjetosPais($idPaisSessao, $palavraChave, $filtro, $paginacao);
		}else{
			if(strpos($url, 'pais')){
				$arrayUrl = explode('/', $url);
				$paisUrl = $arrayUrl[count($arrayUrl) - 1];
				$projetos = Projeto::buscaProjetosPais($paisUrl, $palavraChave, $filtro, $paginacao);
			}else{
				$projetos = Projeto::buscaProjetos($palavraChave, $filtro, $paginacao);
			}
		}

		echo json_encode($projetos);
	}

	public function filtrarPais($idPais)
	{
		$logado = DW3Sessao::get('logado');
		
		if($logado){
			$this->redirecionar(URL_RAIZ);
		}else{
			$projetos = Projeto::buscarTodosProjetosDoPais($idPais);

			$informacoes = [
				'scripts' => ['projetos'],
				'projetos' => $projetos,
			];

			$this->visao('projetos/index.php', $informacoes);
		}
	}

	public function novoProjeto()
	{
		$logado = DW3Sessao::get('logado');

		if($logado){
			$informacoes = [
				'scripts' => ['novo-projeto'],
			];

			$this->visao('projetos/novo-projeto.php', $informacoes);
		}else{
			$this->redirecionar(URL_RAIZ);
		}
	}

	public function armazenar()
	{
		$titulo = $_POST['titulo'];
		$imagem = array_key_exists('imagem', $_FILES) ? $_FILES['imagem'] : null;
		$descricao = $_POST['descricao'];

		$this->verificarLogin();

		if($titulo == null || $titulo == '' || $descricao == null || $descricao == ''){
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
	}

	public function projeto($idProjeto)
	{
		$logado = DW3Sessao::get('logado');

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
				'comentarios' => $comentarios,
				'tipo' => 1
			];

			$this->visao('projetos/projeto.php', $informacoes);
		}
	}

	public function alterarStatusProjeto()
	{
		$status = $_POST['status'];
		$idProjeto = $_POST['idProjeto'];

		$this->verificarLogin();
		$tipo = $this->getTipoSessao();
		$idPais = $this->getIdPaisSessao();

		if($tipo){
			$resposta = ['status' => false, 'frase' => 'Apenas presidentes podem colocar o projeto em votação!'];
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

					if($status == 1){
						$resposta = ['status' => true, 'frase' => 'Projeto em fase de votação!', 'titulo' => $palavra];
					}else{
						$resposta = ['status' => true, 'frase' => 'Projeto rejeitado', 'titulo' => $palavra];
					}
				}else{
					$resposta = ['status' => false, 'frase' => 'Presidentes não podem votar nos projetos!'];
				}
			}else{
				$resposta = ['status' => false, 'frase' => 'Você só pode aprovar ou reprovar projetos do seu!'];
			}
		}

		echo json_encode($resposta);
	}
}
