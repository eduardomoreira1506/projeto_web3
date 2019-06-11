<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Pessoa extends Modelo
{
    const BUSCAR_DEPUTADOS_POR_EMAIL = 'SELECT id_pais,nome,email,senha FROM deputados WHERE email = ?';
    const BUSCAR_PRESIDENTES_POR_EMAIL = 'SELECT id_pais,nome,email,senha FROM presidentes WHERE email = ?';

    protected $nome;
    protected $email;
    protected $senhaBruta;
    protected $senha;
    protected $idPais;
    private $tipo;

    public function __construct($nome, $email, $senhaBruta, $idPais, $tabelaBanco) {
        $this->nome = $nome;
        $this->email = $email;
        $this->senhaBruta = $senhaBruta;
        $this->idPais = $idPais;
        $this->senha = password_hash($senhaBruta, PASSWORD_BCRYPT);
        parent::__construct($tabelaBanco);
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function getIdPais()
    {
        return $this->idPais;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setIdPais($idPais)
    {
        $this->idPais = $idPais;
    }

    public function pessoaExiste($email)
    {
        $sql = DW3BancoDeDados::prepare(self::BUSCAR_PRESIDENTES_POR_EMAIL);
        $sql->bindValue(1, $email, PDO::PARAM_STR);
        $sql->execute();
        $registro = $sql->fetch();

        if($registro){
            return true;
        }else{
            $sql = DW3BancoDeDados::prepare(self::BUSCAR_DEPUTADOS_POR_EMAIL);
            $sql->bindValue(1, $email, PDO::PARAM_STR);
            $sql->execute();
            $registro = $sql->fetch();

            return $registro;
        }
    }

    public static function fazerLogin($email)
    {
        $sql = DW3BancoDeDados::prepare(self::BUSCAR_PRESIDENTES_POR_EMAIL);
        $sql->bindValue(1, $email, PDO::PARAM_STR);
        $sql->execute();
        $registro = $sql->fetch();
        $tipo = 0;

        $pessoa = null;

        if(!$registro){
            $sql = DW3BancoDeDados::prepare(self::BUSCAR_DEPUTADOS_POR_EMAIL);
            $sql->bindValue(1, $email, PDO::PARAM_STR);
            $sql->execute();
            $registro = $sql->fetch();
            $tipo = 1;
        }

        if($registro){
            $pessoa = new Pessoa(
                $registro['nome'],
                $registro['email'],
                '',
                $registro['id_pais'],
                ''
            );

            $pessoa->senha = $registro['senha'];
            $pessoa->tipo = $tipo;
        }

        return $pessoa;
    }
    
}
