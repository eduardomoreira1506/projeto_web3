<?php
namespace Controlador;

use \Modelo\Projeto;
use \Modelo\Comentario;
use \Modelo\Pessoa;
use \Modelo\Presidente;
use \Modelo\Deputado;
use \Framework\DW3Sessao;

class ComentarioControlador extends Controlador
{
	public function armazenar()
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
}
