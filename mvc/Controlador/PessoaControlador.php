<?php
namespace Controlador;

use \Modelo\Pessoa;
use \Modelo\Deputado;
use \Framework\DW3Sessao;

class PessoaControlador extends Controlador
{
	public function login()
	{
		$logado = parent::estaLogado();

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
		$verificacao = parent::estaLogado();
		$senha = $_POST['senha'];
		
		if(!$verificacao){
			if($_POST['email'] == "" || $_POST['email'] == null || $_POST['senha'] = "" || $_POST['senha'] == null){
				$resposta = ['status' => false, 'frase' => 'Usuário e senha são obrigatórios.'];
				echo json_encode($resposta);
			}else{
				$pessoa = Pessoa::fazerLogin($_POST['email']);

				if($pessoa == null){
					$resposta = ['status' => false, 'frase' => 'Usuário ou senha incorretos.'];
					echo json_encode($resposta);
				}elseif(!password_verify($senha, $pessoa->getSenha())){	
					$resposta = ['status' => false, 'frase' => 'Usuário ou senha incorretos.'];
					echo json_encode($resposta);
				}else{
					$resposta = ['status' => true];
					echo json_encode($resposta);
					DW3Sessao::set('logado', true);
					DW3Sessao::set('idPais', $pessoa->getIdPais());
					DW3Sessao::set('tipo', $pessoa->getTipo());
					DW3Sessao::set('email', $pessoa->getEmail());
				}
			}
		}
	}

	public function novoDeputado()
	{
		$logado = parent::estaLogado();

		if($logado){
			$tipoSessao = parent::getTipoSessao();

			if(!$tipoSessao){
				$informacoes = [
					'scripts' => ['novo-deputado'],
					'logado' => $logado,
				];

				$this->visao('deputados/novo-deputado.php', $informacoes);
			}else{
				$this->redirecionar(URL_RAIZ);
			}
		}else{
			$this->redirecionar(URL_RAIZ);
		}
	}

	public function cadastrarNovoDeputado()
	{
		$logado = parent::estaLogado();

		if($logado){
			$tipoSessao = parent::getTipoSessao();

			if(!$tipoSessao){
				$nome = $_POST['nome'];
				$email = $_POST['email'];
				$senha = $_POST['senha'];

				if($nome == null || $nome == "" || $email == null || $email == "" || $senha == null || $senha == ""){
					$resposta = ['status' => false, 'frase' => 'Todos campos são obrigatórios.'];
					echo json_encode($resposta);
				}else{
					$verificacao = Pessoa::pessoaExiste($email);

					if($verificacao){
						$resposta = ['status' => false, 'frase' => 'Esse e-mail já está cadastrado no sistema.'];
						echo json_encode($resposta);
					}else{
						$idPais = parent::getIdPaisSessao();
						$deputado = new Deputado($nome, $email, $senha, $idPais);
						$deputado->inserir();

						$nome = explode(" ", $nome);
						$nome = $nome[0];

						$resposta = ['status' => true, 'frase' => "Deputado $nome cadastrado!"];
						echo json_encode($resposta);
					}
				}
			}else{
				$this->redirecionar(URL_RAIZ);
			}
		}else{
			$this->redirecionar(URL_RAIZ);
		}
	}
}
