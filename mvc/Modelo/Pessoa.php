<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Pessoa extends Modelo
{
    protected $nome;
    protected $email;
    protected $senhaBruta;
    protected $senha;

    public function __construct($nome, $email, $senhaBruta, $tabelaBanco) {
        $this->nome = $nome;
        $this->email = $email;
        $this->senhaBruta = $senhaBruta;
        $this->senha = password_hash($senhaBruta, PASSWORD_BCRYPT);
        parent::__construct($tabelaBanco);
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getEmail()
    {
        return $this->email;
    }
    
}
