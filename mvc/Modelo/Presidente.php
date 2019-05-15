<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Presidente extends Pessoa
{
    const INSERIR = 'INSERT INTO presidentes(nome,email,senha) VALUES (?, ?, ?)';

    private $idPresidente;

    public function __construct($nome, $email, $senhaBruta, $idPresidente = null) {
        parent::__construct($nome, $email, $senhaBruta, 'presidentes');
        $this->idPresidente = $idPresidente;
    }

    public function getIdPresidente()
    {
        return $this->idPresidente;
    }

    public function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->nome, PDO::PARAM_STR);
        $comando->bindValue(2, $this->email, PDO::PARAM_STR);
        $comando->bindValue(3, $this->senha, PDO::PARAM_STR);
        $comando->execute();
        $this->idPresidente = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }
    
}
