<?php
namespace Controlador;

use \Modelo\Pessoa;
use \Modelo\Deputado;
use \Modelo\Projeto;
use \Framework\DW3Sessao;

class VotoControlador extends Controlador
{
	public function armazenar()
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
