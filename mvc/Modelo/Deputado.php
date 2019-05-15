<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Deputado extends Pessoa
{
    const INSERIR = 'INSERT INTO deputados(id_pais,nome,email,senha) VALUES (?, ?, ?, ?)';

    private $idDeputado;

    public function __construct($nome, $email, $senhaBruta, $idPais = null, $idDeputado = null) {
        parent::__construct($nome, $email, $senhaBruta, $idPais, 'deputados');
        $this->idDeputado = $idDeputado;
    }

    public function getIdDeputado()
    {
        return $this->idDeputado;
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
        $this->idDeputado = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }
    
}
