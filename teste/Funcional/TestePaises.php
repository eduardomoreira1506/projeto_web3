<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Framework\DW3BancoDeDados;
use \Framework\DW3Sessao;


class TestePaises extends Teste
{

    public function testeListagemDeslogado()
    {
        $resposta = $this->get(URL_RAIZ . 'pais/1');
        $this->verificarContem($resposta, 'filtro');
    }

    public function testeListagemLogado()
    {
        DW3Sessao::set('logado', true);
        $resposta = $this->get(URL_RAIZ . 'pais/1');
        $this->verificarNaoContem($resposta, 'filtro');
    }

    public function testeCriarLogado()
    {
        DW3Sessao::set('logado', true);

        $resposta = $this->post(URL_RAIZ . 'novoPais', [
            'nome-pais' => 'África do Sul',
            'sigla' => 'SA',
            'nome' => 'Presidente da África do sul',
            'email' => 'presidente@africadosul.com',
            'senha' => '102030',
            'confirmacao_senha' => '102030'
        ]);

        $this->verificarContem($resposta, 'error');
    }

    public function testeCriarDeslogado()
    {
        $resposta = $this->post(URL_RAIZ . 'novoPais', [
            'nome-pais' => 'África do Sul',
            'sigla' => 'SA',
            'nome' => 'Presidente da África do sul',
            'email' => 'presidente@africadosul.com',
            'senha' => '102030',
            'confirmacao_senha' => '102030'
        ]);

        $this->verificarContem($resposta, 'success');
    }
    
}
