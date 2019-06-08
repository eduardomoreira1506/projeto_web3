<?php
namespace Controlador;

use \Modelo\Pessoa;
use \Modelo\Deputado;
use \Modelo\Projeto;
use \Framework\DW3Sessao;

class PessoaControlador extends Controlador
{
	public function login()
	{
		$logado = DW3Sessao::get('logado');

		if($logado){
			$this->redirecionar(URL_RAIZ);
		}else{
			$informacoes = [
				'scripts' => ['login'],
				'logado' => $logado,
			];

			$this->visao('login/index.php', $informacoes);
		}
	}

	public function logoff()
	{
		DW3Sessao::deletar('logado');
		DW3Sessao::deletar('idPais');
		DW3Sessao::deletar('tipo');
		DW3Sessao::deletar('email');
		DW3Sessao::deletar('nome');
		$this->redirecionar(URL_RAIZ);
	}

	public function verificarEmailExiste()
	{
		$email = $_POST['email'];

		if($email == null || $email == ""){
			$resposta = ['status' => false, 'frase' => 'E-mail é obrigatório.'];
			echo json_encode($resposta);
		}else{
			$verificacao = Pessoa::pessoaExiste($email);
			if(!$verificacao){
				$resposta = ['status' => false, 'frase' => 'Esse e-mail não está cadastrado no sistema.'];
				echo json_encode($resposta);
			}else{
				$resposta = ['status' => true];
				echo json_encode($resposta);
			}
		}
	}

	public function verificacaoEmailNaoExiste()
	{
		$email = $_POST['email'];

		if($email == null || $email == ""){
			$resposta = ['status' => false, 'frase' => 'E-mail é obrigatório.'];
			echo json_encode($resposta);
		}else{
			$verificacao = Pessoa::pessoaExiste($email);
			if($verificacao){
				$resposta = ['status' => false, 'frase' => 'Esse e-mail já está cadastrado no sistema.'];
				echo json_encode($resposta);
			}else{
				$resposta = ['status' => true];
				echo json_encode($resposta);
			}
		}
	}

	public function fazerLogin()
	{
		$verificacao = DW3Sessao::get('logado');
		$senha = $_POST['senha'];
		
		if(!$verificacao){
			if($_POST['email'] == "" || $_POST['email'] == null || $_POST['senha'] = "" || $_POST['senha'] == null){
				$resposta = ['status' => false, 'frase' => 'Usuário e senha são obrigatórios.'];
				echo json_encode($resposta);
			}else{
				$pessoa = Pessoa::fazerLogin($_POST['email']);

				if($pessoa == null){
					$resposta = ['status' => false, 'frase' => 'Usuário inválido.'];
					echo json_encode($resposta);
				}elseif(!password_verify($senha, $pessoa->getSenha())){	
					$resposta = ['status' => false, 'frase' => 'Usuário inválido.'];
					echo json_encode($resposta);
				}else{
					$resposta = ['status' => true];
					echo json_encode($resposta);
					DW3Sessao::set('logado', true);
					DW3Sessao::set('idPais', $pessoa->getIdPais());
					DW3Sessao::set('tipo', $pessoa->getTipo());
					DW3Sessao::set('email', $pessoa->getEmail());
					DW3Sessao::set('nome', $pessoa->getNome());
				}
			}
		}
	}

	public function novoDeputado()
	{
		$this->verificarLogin();

		$tipoSessao = $this->getTipoSessao();

		if(!$tipoSessao){
			$informacoes = [
				'scripts' => ['novo-deputado'],
				'logado' => $logado,
			];

			$this->visao('deputados/novo-deputado.php', $informacoes);
		}else{
			$this->redirecionar(URL_RAIZ);
		}
	}

	public function cadastrarNovoDeputado()
	{
		$this->verificarLogin();

		$tipoSessao = $this->getTipoSessao();

		if(!$tipoSessao){
			$nome = $_POST['nome'];
			$email = $_POST['email'];
			$senha = $_POST['senha'];

			if($nome == null || $nome == "" || $email == null || $email == "" || $senha == null || $senha == ""){
				$resposta = ['status' => false, 'frase' => 'Todos campos são obrigatórios.'];
			}else{
				$verificacao = Pessoa::pessoaExiste($email);

				if($verificacao){
					$resposta = ['status' => false, 'frase' => 'Esse e-mail já está cadastrado no sistema.'];
				}else{
					$idPais = $this->getIdPaisSessao();
					$deputado = new Deputado($nome, $email, $senha, $idPais);
					$deputado->inserir();

					$nome = explode(" ", $nome);
					$nome = $nome[0];
					$resposta = ['status' => true, 'frase' => "Deputado $nome cadastrado!"];
				}
			}
		}else{
			$resposta = ['status' => false, 'frase' => "Deputados não podem cadastrar outros deputados!"];
		}
		
		echo json_encode($resposta);
	}

	public function votar()
	{
		$voto = $_POST['voto'];
		$idProjeto = $_POST['idProjeto'];
		$this->verificarLogin();

		if($voto != 1 && $voto != 0){
			$resposta = ['status' => false, 'frase' => "As opções de voto são deferir ou indeferir!"];
		}else{
			$idPaisSessao = $this->getIdPaisSessao();
			$tipo = $this->getTipoSessao();

			if($tipo){
				$email = $this->getEmailSessao();
				$verificacaoVoto = Projeto::getVotosDeputadoProjeto($idProjeto, $email);
				if($verificacaoVoto){
					$resposta = ['status' => false, 'frase' => "Você já votou nesse projeto! Uma vez votado, não pode ser alterado"];
				}else{
					$projeto = Projeto::buscarProjeto($idProjeto);

					if($projeto->getIdPais() == $idPaisSessao){
						$registroDeputado = Deputado::getDeputado($email);
						$deputado = new Deputado(
							$registroDeputado['nome'],
							$registroDeputado['email'],
							null,
							$registroDeputado['id_pais'],
							$registroDeputado['id_deputado']
						);

						$retornoVoto = $deputado->votar($voto, $idProjeto);
						if($retornoVoto != false){
							$resposta = ['status' => true, 'frase' => "Você foi o último voto desse projeto e ele acaba de ser $retornoVoto"];
						}else{
							$resposta = ['status' => true, 'frase' => "Seu voto foi contabilizado"];
						}
					}else{
						$resposta = ['status' => false, 'frase' => "Você só pode votar em projetos do seu país!"];
					}
				}
			}else{
				$resposta = ['status' => false, 'frase' => "Apenas deputados podem votar!"];
			}
		}

		echo json_encode($resposta);
	}
}
