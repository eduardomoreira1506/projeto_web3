<?php
namespace Controlador;

use \Modelo\Pessoa;
use \Modelo\Deputado;
use \Modelo\Projeto;
use \Framework\DW3Sessao;

class DeputadoControlador extends PessoaControlador
{
    public function index()
    {
        $logado = $this->verificarLogin();

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

    public function armazenar()
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

}
