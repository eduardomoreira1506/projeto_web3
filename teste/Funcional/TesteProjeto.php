<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Framework\DW3BancoDeDados;
use \Framework\DW3Sessao;


class TesteProjeto extends Teste
{

    public function testeAcessar()
    {
        $resposta = $this->get(URL_RAIZ . 'projeto/1');
        $this->verificarContem($resposta, 'Comentar');
    }

    public function testeCriarLogado()
    {
        DW3Sessao::set('logado', true);

        $resposta = $this->post(URL_RAIZ . 'novoProjeto', [
            'titulo' => 'Título do projeto aqui',
            'descricao' => 'Descrição do projeto aquiiiiii'
        ]);

        $this->verificarContem($resposta, 'success');
    }

    public function testeCriarDeslogado()
    {
        $resposta = $this->post(URL_RAIZ . 'novoProjeto', [
            'titulo' => 'Título do projeto aqui',
            'descricao' => 'Descrição do projeto aquiiiiii'
        ]);

        $this->verificarContem($resposta, 'error');
    }

    public function testeListagem()
    {
        $resposta = $this->get(URL_RAIZ . 'projetos');
        $this->verificarContem($resposta, 'filtro-projetos');
    }
    
}
