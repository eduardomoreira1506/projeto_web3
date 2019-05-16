<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Deputado extends Pessoa
{
    const INSERIR = 'INSERT INTO deputados(id_pais,nome,email,senha) VALUES (?, ?, ?, ?)';
    const BUSCAR_DEPUTADO = 'SELECT * FROM deputados WHERE id_deputado = ?';
    const BUSCAR_DEPUTADO_POR_EMAIL = 'SELECT * FROM deputados WHERE email = ?';
    const INSERIR_COMENTARIO = 'INSERT INTO comentarios(id_deputado,id_projeto,comentario) VALUES (?, ?, ?)';

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

    public function setIdDeputado($idDeputado)
    {
        $this->idDeputado = $idDeputado;
    }

    public function pegarInformacoes()
    {
       $sql = DW3BancoDeDados::prepare(self::BUSCAR_DEPUTADO);
       $sql->bindValue(1, $this->idDeputado, PDO::PARAM_INT);
       $sql->execute();
       $registro = $sql->fetch();

       $this->setNome($registro['nome']);
       $this->setEmail($registro['email']);
       $this->setIdPais($registro['id_pais']);
    }
    
    public function buscarDeputado($email)
    {
        $sql = DW3BancoDeDados::prepare(self::BUSCAR_DEPUTADO_POR_EMAIL);
        $sql->bindValue(1, $email, PDO::PARAM_INT);
        $sql->execute();
        $registro = $sql->fetch();

        $deputado = new Deputado(
            $registro['nome'],
            $registro['email'],
            null,
            $registro['id_pais'],
            $registro['id_deputado']
        );

        return $deputado;
    }

    public function comentar($idProjeto, $comentario)
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR_COMENTARIO);
        $comando->bindValue(1, $this->idPresidente, PDO::PARAM_STR);
        $comando->bindValue(2, $idProjeto, PDO::PARAM_STR);
        $comando->bindValue(3, $comentario, PDO::PARAM_STR);
        $comando->execute();
        DW3BancoDeDados::getPdo()->commit();
    }
}
