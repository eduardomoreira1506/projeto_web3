<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Presidente extends Pessoa
{
    const INSERIR = 'INSERT INTO presidentes(id_pais,nome,email,senha) VALUES (?,?, ?, ?)';
    const INSERIR_COMENTARIO = 'INSERT INTO comentarios(id_presidente,id_projeto,comentario) VALUES (?, ?, ?)';
    const BUSCAR_PRESIDENTE = 'SELECT * FROM presidentes WHERE id_presidente = ?';
    const BUSCAR_PRESIDENTE_POR_EMAIL = 'SELECT * FROM presidentes WHERE email = ?';

    private $idPresidente;

    public function __construct($nome = null, $email = null, $senhaBruta = null, $idPais = null, $idPresidente = null) {
        parent::__construct($nome, $email, $senhaBruta, $idPais, 'presidentes');
        $this->idPresidente = $idPresidente;
    }

    public function getIdPresidente()
    {
        return $this->idPresidente;
    }

    public function setIdPresidente($idPresidente)
    {
        $this->idPresidente = $idPresidente;
    }

    public function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->idPais, PDO::PARAM_INT);
        $comando->bindValue(2, $this->nome, PDO::PARAM_STR);
        $comando->bindValue(3, $this->email, PDO::PARAM_STR);
        $comando->bindValue(4, $this->senha, PDO::PARAM_STR);
        $comando->execute();
        $this->idPresidente = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

    public function pegarInformacoes()
    {
        $sql = DW3BancoDeDados::prepare(self::BUSCAR_PRESIDENTE);
        $sql->bindValue(1, $this->idPresidente, PDO::PARAM_INT);
        $sql->execute();
        $registro = $sql->fetch();

        $this->setNome($registro['nome']);
        $this->setEmail($registro['email']);
        $this->setIdPais($registro['id_pais']);
    }   

    public function buscarPresidente($email)
    {
        $sql = DW3BancoDeDados::prepare(self::BUSCAR_PRESIDENTE_POR_EMAIL);
        $sql->bindValue(1, $email, PDO::PARAM_STR);
        $sql->execute();
        $registro = $sql->fetch();

        $presidente = new Presidente(
            $registro['nome'],
            $registro['email'],
            null,
            $registro['id_pais'],
            $registro['id_presidente']
        );

        return $presidente;
    } 

    public function comentar($idProjeto, $comentario)
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR_COMENTARIO);
        $comando->bindValue(1, $this->idPresidente, PDO::PARAM_INT);
        $comando->bindValue(2, $idProjeto, PDO::PARAM_INT);
        $comando->bindValue(3, $comentario, PDO::PARAM_STR);
        $comando->execute();
        DW3BancoDeDados::getPdo()->commit();
    }

}
