<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Framework\DW3BancoDeDados;
use \Modelo\Pais;
use \Modelo\Presidente;
use \Modelo\Projeto;
use \Modelo\Deputado;
use \Modelo\Comentario;

class TesteComentario extends Teste
{

	public function testeComentar()
	{
		$brasil = new Pais('Brasil', 'BR');
        $brasil->inserir();
        $idPais = $brasil->getIdPais();

        $tiririca = new Deputado('Tiririca', 'tiririca@brasil.com', '102030', $idPais);
    	$tiririca->inserir();
    	$idDeputado = $tiririca->getIdDeputado();

    	$jairBolsonaro = new Presidente('Jair Bolsonaro', 'presidente@brasil.com', '102030', $idPais);
    	$jairBolsonaro->inserir();
    	$idPresidente = $jairBolsonaro->getIdPresidente();

    	$projeto = new Projeto(null, $idDeputado, $idPais, null, null, 'Título do projeto aqui', 'Descrição do projeto aqui', $idPresidente);
    	$projeto->inserir();

    	$tiririca->comentar($projeto->getIdProjeto(), 'comentário tiririca');
    	$jairBolsonaro->comentar($projeto->getIdProjeto(), 'comentário tiririca');

    	$query = DW3BancoDeDados::query('SELECT * FROM comentarios');
    	$bdComentarios = $query->fetchAll();
    	$this->verificar(count($bdComentarios) == 2);
	}

	public function testeBuscarComentariosDoProjeto()
	{
		$brasil = new Pais('Brasil', 'BR');
        $brasil->inserir();
        $idPais = $brasil->getIdPais();

        $tiririca = new Deputado('Tiririca', 'tiririca@brasil.com', '102030', $idPais);
    	$tiririca->inserir();
    	$idDeputado = $tiririca->getIdDeputado();

    	$jairBolsonaro = new Presidente('Jair Bolsonaro', 'presidente@brasil.com', '102030', $idPais);
    	$jairBolsonaro->inserir();
    	$idPresidente = $jairBolsonaro->getIdPresidente();

    	$projeto = new Projeto(null, $idDeputado, $idPais, null, null, 'Título do projeto aqui', 'Descrição do projeto aqui', $idPresidente);
    	$projeto->inserir();

    	$tiririca->comentar($projeto->getIdProjeto(), 'comentário tiririca');
    	$jairBolsonaro->comentar($projeto->getIdProjeto(), 'comentário tiririca');

    	$comentarios = Comentario::buscarComentarios($projeto->getIdProjeto());
    	$this->verificar(count($comentarios) == 2);
	}

}
