<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Framework\DW3BancoDeDados;
use \Modelo\Pais;
use \Modelo\Presidente;
use \Modelo\Projeto;

class TestePresidente extends Teste
{

	private $idPais;

    /* Roda antes de cada teste */
    public function antes()
    {
        $brasil = new Pais('Brasil', 'BR');
        $brasil->inserir();
        $this->idPais = $brasil->getIdPais();
    }

    public function testeInserirPresidente()
    {
    	$jairBolsonaro = new Presidente('Jair Bolsonaro', 'presidente@brasil.com', '102030', $this->idPais);
    	$jairBolsonaro->inserir();
    	$query = DW3BancoDeDados::query('SELECT * FROM presidentes');
    	$bdPresidentes = $query->fetchAll();
    	$this->verificar(count($bdPresidentes) == 1);
    }

    public function testePegarInformacoesDoBanco()
    {
    	$jairBolsonaro = new Presidente('Jair Bolsonaro', 'presidente@brasil.com', '102030', $this->idPais);
    	$jairBolsonaro->inserir();
    	$idPresidente = $jairBolsonaro->getIdPresidente();

    	$jairBolsonaro2 = new Presidente(null, null, null, null, $idPresidente);
    	$jairBolsonaro2->pegarInformacoes();
    	$this->verificar($jairBolsonaro->getNome() === $jairBolsonaro2->getNome());
    }

    public function testeBuscar()
    {
    	$jairBolsonaro = new Presidente('Jair Bolsonaro', 'presidente@brasil.com', '102030', $this->idPais);
    	$jairBolsonaro->inserir();

    	$jairBolsonaro2 = Presidente::buscarPresidente($jairBolsonaro->getEmail());
    	$this->verificar($jairBolsonaro->getNome() === $jairBolsonaro2->getNome());
    }

}
