<?php
namespace Modelo;

use \PDO;
use \Framework\DW3Modelo;
use \Framework\DW3BancoDeDados;


abstract class Modelo extends DW3Modelo
{
	protected $tabela;

	public function __construct($tabela)
	{
		$this->tabela = $tabela;
	}

	protected function buscarTodos()
	{
		$sql = 'SELECT * FROM ' . $this->tabela;
        $registros = DW3BancoDeDados::query($sql);
        return $registros;
	}
}