<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Framework\DW3BancoDeDados;
use \Framework\DW3Sessao;


class TestePainel extends Teste
{

    public function testeAcessarLogado()
    {
        $resposta = $this->post(URL_RAIZ . 'novoPais', [
            'nome-pais' => 'África do Sul',
            'sigla' => 'SA',
            'nome' => 'Cyril Ramaphosa',
            'email' => 'presidente@africadosul.com',
            'senha' => '102030',
            'confirmacao_senha' => '102030'
        ]); 
        $this->verificarContem($resposta, 'success');

        $resposta = $this->post(URL_RAIZ . 'login', [
            'email' => 'presidente@africadosul.com',
            'senha' => '102030'
        ]);     
        $this->verificarContem($resposta, 'true');

        $resposta = $this->get(URL_RAIZ . 'painel');
        $this->verificarContem($resposta, 'Olá, Cyril');
    }

    public function testeAcessarDeslogado()
    {
        $resposta = $this->get(URL_RAIZ . 'painel');
        $this->verificarNaoContem($resposta, 'Olá');
    }
    
}
