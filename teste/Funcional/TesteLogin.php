<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Framework\DW3BancoDeDados;
use \Framework\DW3Sessao;


class TesteLogin extends Teste
{
    
	public function testeAcessar()
    {
        $resposta = $this->get(URL_RAIZ . 'login');
        $this->verificarContem($resposta, 'sistema de votações');
    }

    public function testeAcessarLogado()
    {
        DW3Sessao::set('logado', true);
        $resposta = $this->get(URL_RAIZ . 'login');
        $this->verificarNaoContem($resposta, 'sistema de votações');
    }

    public function testeDeslogar()
    {
        DW3Sessao::set('logado', true);
        $resposta = $this->get(URL_RAIZ . 'sair');
        $resposta = $this->get(URL_RAIZ . 'login');
        $this->verificarContem($resposta, 'sistema de votações');
    }
    
}
