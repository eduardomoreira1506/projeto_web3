<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Framework\DW3BancoDeDados;
use \Modelo\Pais;
use \Modelo\Presidente;

class TesteRaiz extends Teste
{
	public function testeAcessarDeslogado()
    {
        $resposta = $this->get(URL_RAIZ);
        $this->verificar(strpos($resposta['html'], 'Qual país') !== false);
    }

    public function testeAcessarLogado()
    {
    	$brasil = new Pais('Brasil', 'BR');
    	$brasil->inserir();

    	$bolsonaro = new Presidente('Jair Bolsonaro', 'bolsonaro@brasil.com', '102030', $brasil->getIdPais());
    	$bolsonaro->inserir();

        $resposta = $this->post(URL_RAIZ . 'login', [
            'email' => 'bolsonaro@brasil.com',
            'senha' => '102030'
        ]);
        $resposta = $this->get(URL_RAIZ);
        $this->verificar(strpos($resposta['html'], 'Qual país') !== true);
    }
    
}
