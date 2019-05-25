<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Pais;
use \Framework\DW3BancoDeDados;

class TestePais extends Teste
{
	public function testeCriarPais()
	{
        $brasil = new Pais('Brasil', 'BR');
        $brasil->inserir();
        $query = DW3BancoDeDados::query('SELECT * FROM paises');
        $bdPaises = $query->fetchAll();
        $this->verificar(count($bdPaises) == 1);
    }

    public function testeBuscarTodosPaises()
    {
        $brasil = new Pais('Brasil', 'BR');
        $brasil->inserir();
        $mexico = new Pais('Mexico', 'MX');
        $mexico->inserir();
        $peru = new Pais('Peru', 'PR');
        $peru->inserir();

        $paises = $peru->buscarTodosPaises();
        $this->verificar(count($paises) == 3);
    }

}
