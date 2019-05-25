<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Framework\DW3BancoDeDados;
use \Framework\DW3Sessao;


class TesteRaiz extends Teste
{
    
	public function testeAcessarDeslogado()
    {
        $resposta = $this->get(URL_RAIZ);
        $this->verificar(strpos($resposta['html'], 'Qual país') !== false);
    }

    public function testeAcessarLogado()
    {
    	DW3Sessao::set('logado', true);
        $resposta = $this->get(URL_RAIZ);
        $this->verificar(strpos($resposta['html'], 'Qual país') === false);
    }

    public function testeAcessarLogadoDepoisDeslogar()
    {
        DW3Sessao::set('logado', true);
        $resposta = $this->get(URL_RAIZ);
        $this->verificar(strpos($resposta['html'], 'Qual país') === false);
        DW3Sessao::deletar('logado');
        $resposta = $this->get(URL_RAIZ);
        $this->verificar(strpos($resposta['html'], 'Qual país') !== false);
    }
    
}
