<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Presidente extends Pessoa
{
    const INSERIR = 'INSERT INTO presidentes(id_pais,nome,email,senha) VALUES (?,?, ?, ?)';

    private $idPresidente;

    public function __construct($nome, $email = null, $senhaBruta = null, $idPais = null, $idPresidente = null) {
        parent::__construct($nome, $email, $senhaBruta, $idPais, 'presidentes');
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
        $comando->bindValue(1, $this->idPais, PDO::PARAM_STR);
        $comando->bindValue(2, $this->nome, PDO::PARAM_STR);
        $comando->bindValue(3, $this->email, PDO::PARAM_STR);
        $comando->bindValue(4, $this->senha, PDO::PARAM_STR);
        $comando->execute();
        $this->idPresidente = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }
    
}
