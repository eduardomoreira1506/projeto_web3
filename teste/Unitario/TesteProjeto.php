<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Framework\DW3BancoDeDados;
use \Modelo\Pais;
use \Modelo\Presidente;
use \Modelo\Projeto;
use \Modelo\Deputado;

class TesteProjeto extends Teste
{

	private $idPais;
	private $idDeputado;
	private $idPresidente;

    /* Roda antes de cada teste */
    public function antes()
    {
        $brasil = new Pais('Brasil', 'BR');
        $brasil->inserir();
        $this->idPais = $brasil->getIdPais();

        $tiririca = new Deputado('Tiririca', 'tiririca@brasil.com', '102030', $this->idPais);
    	$tiririca->inserir();
    	$this->idDeputado = $tiririca->getIdDeputado();

    	$jairBolsonaro = new Presidente('Jair Bolsonaro', 'presidente@brasil.com', '102030', $this->idPais);
    	$jairBolsonaro->inserir();
    	$this->idPresidente = $jairBolsonaro->getIdPresidente();
    }  

    /* Professor, nesses testes acontece alguns erros, porém é no upload de imagens que segundo os requisitos do projeto não é necessário testar */ 
    public function testeInserir()
    {
    	$projeto = new Projeto(null, $this->idDeputado, $this->idPais, null, null, 'Título do projeto aqui', 'Descrição do projeto aqui', $this->idPresidente);
    	$projeto->inserir();
    	$query = DW3BancoDeDados::query('SELECT * FROM projetos');
    	$bdProjetos = $query->fetchAll();
    	$this->verificar(count($bdProjetos) == 1);
    }

    public function testeBuscarPeloId()
    {
    	$projeto = new Projeto(null, $this->idDeputado, $this->idPais, null, null, 'Título do projeto aqui', 'Descrição do projeto aqui', $this->idPresidente);
    	$projeto->inserir();
    	$idProjeto = $projeto->getIdProjeto();

    	$projeto2 = Projeto::buscarProjeto($idProjeto);
    	$this->verificar($projeto->getDescricao() == $projeto2->getDescricao());
    }

    public function testeBucarTodosProjetos()
    {
    	$projeto = new Projeto(null, $this->idDeputado, $this->idPais, null, null, 'Título do projeto aqui', 'Descrição do projeto aqui', $this->idPresidente);
    	$projeto->inserir();
    	$projeto2 = new Projeto(null, $this->idDeputado, $this->idPais, null, null, 'Título do projeto aqui', 'Descrição do projeto aqui', $this->idPresidente);
    	$projeto2->inserir();
    	$projeto3 = new Projeto(null, $this->idDeputado, $this->idPais, null, null, 'Título do projeto aqui', 'Descrição do projeto aqui', $this->idPresidente);
    	$projeto3->inserir();

    	$query = DW3BancoDeDados::query('SELECT * FROM projetos');
    	$bdProjetos = $query->fetchAll();
    	$this->verificar(count($bdProjetos) == 3);
    }

    public function testeAcessarTodosProjetosDoPais()
    {
    	$projeto = new Projeto(null, $this->idDeputado, $this->idPais, null, null, 'Título do projeto aqui', 'Descrição do projeto aqui', $this->idPresidente);
    	$projeto->inserir();
    	$projeto2 = new Projeto(null, $this->idDeputado, $this->idPais, null, null, 'Título do projeto aqui', 'Descrição do projeto aqui', $this->idPresidente);
    	$projeto2->inserir();
    	$projeto3 = new Projeto(null, $this->idDeputado, $this->idPais, null, null, 'Título do projeto aqui', 'Descrição do projeto aqui', $this->idPresidente);
    	$projeto3->inserir();

    	$estadosUnidos = new Pais('Estados Unidos', 'US');
        $estadosUnidos->inserir();
        $idPais = $estadosUnidos->getIdPais();

        $tiriricaAmericano = new Deputado('Tiririca', 'tiririca@eua.com', '102030', $idPais);
    	$tiriricaAmericano->inserir();
    	$idDeputado = $tiriricaAmericano->getIdDeputado();

    	$donaldTrump = new Presidente('Donald Trump', 'presidente@eua.com', '102030', $idPais);
    	$donaldTrump->inserir();
    	$idPresidente = $donaldTrump->getIdPresidente();

    	$projetoEstadosUnidos = new Projeto(null, $idDeputado, $idPais, null, null, 'Título do projeto aqui', 'Descrição do projeto aqui', $idPresidente);
    	$projetoEstadosUnidos->inserir();

    	$projetosBrasil = $projeto3->buscarTodosProjetosDoPais();
    	$this->verificar(count($projetosBrasil) == 3);

    	$projetosEstadosUnidos = $projetoEstadosUnidos->buscarTodosProjetosDoPais();
    	$this->verificar(count($projetosEstadosUnidos) == 1);
    }

    public function testeBuscarPalavraChave()
    {
    	$projeto = new Projeto(null, $this->idDeputado, $this->idPais, null, null, 'Título do projeto aqui', 'Descrição do projeto aqui', $this->idPresidente);
    	$projeto->inserir();
    	$projeto2 = new Projeto(null, $this->idDeputado, $this->idPais, null, null, 'Outro título de projeto aqui', 'Descrição do projeto aqui', $this->idPresidente);
    	$projeto2->inserir();

    	$projetos = Projeto::buscarProjetosPalavraChave('projeto');
    	$this->verificar(count($projetos) == 2);
    	$projetos = Projeto::buscarProjetosPalavraChave('Outro');
    	$this->verificar(count($projetos) == 1);
    }

    public function testeAtualizar()
    {
    	$projeto = new Projeto(null, $this->idDeputado, $this->idPais, null, null, 'Título do projeto aqui', 'Descrição do projeto aqui', $this->idPresidente);
    	$projeto->inserir();

    	Projeto::atualizar(3, $projeto->getIdProjeto());
    	$projeto = Projeto::buscarProjetosPalavraChave('projeto');
    	$this->verificar($projeto[0]['status'] == 3);
    }

}
