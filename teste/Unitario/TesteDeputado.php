<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Framework\DW3BancoDeDados;
use \Modelo\Pais;
use \Modelo\Deputado;

class TesteDeputado extends Teste
{
	private $idPais;

    /* Roda antes de cada teste */
    public function antes()
    {
        $brasil = new Pais('Brasil', 'BR');
        $brasil->inserir();
        $this->idPais = $brasil->getIdPais();
    }

    public function testeInserirDeputado()
    {
    	$tiririca = new Deputado('Tiririca', 'tiririca@brasil.com', '102030', $this->idPais);
    	$tiririca->inserir();
    	$query = DW3BancoDeDados::query('SELECT * FROM deputados');
    	$bdDeputados = $query->fetchAll();
    	$this->verificar(count($bdDeputados) == 1);
    }

    public function testePegarInformacoesDoBanco()
    {
    	$tiririca = new Deputado('Tiririca', 'tiririca@brasil.com', '102030', $this->idPais);
    	$tiririca->inserir();
    	$idDeputado = $tiririca->getIdDeputado();

    	$tiririca2 = new Deputado(null, null, null, null, $idDeputado);
    	$tiririca2->pegarInformacoes();
    	$this->verificar($tiririca->getNome() === $tiririca2->getNome());
    }

    public function testeBuscar()
    {
    	$tiririca = new Deputado('Tiririca', 'tiririca@brasil.com', '102030', $this->idPais);
    	$tiririca->inserir();

    	$tiririca2 = Deputado::buscarDeputado($tiririca->getEmail());
    	$this->verificar($tiririca->getNome() === $tiririca2->getNome());
    }

}
