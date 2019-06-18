<?php
namespace Controlador;

use \Modelo\Pessoa;
use \Modelo\Deputado;
use \Modelo\Projeto;
use \Framework\DW3Sessao;

class PessoaControlador extends Controlador
{
	public function index()
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

	public function destruir()
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

	public function armazenar()
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
}
