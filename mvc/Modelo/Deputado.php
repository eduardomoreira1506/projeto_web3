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
    const INSERIR_VOTO = 'INSERT INTO votos(id_projeto,id_deputado,aprovado) VALUES (?, ?, ?)';
    const BUSCAR_TODOS_VOTOS_PROJETO = 'SELECT COUNT(id_voto) as votosProjeto FROM votos WHERE id_projeto = ?';
    const BUSCAR_TODOS_DEPUTADOS_PAIS = 'SELECT COUNT(id_deputado) as deputadosPais FROM deputados WHERE id_pais = ?';
    const BUSCAR_TODOS_CAMPOS_DEPUTADOS_POR_EMAIL = 'SELECT * FROM deputados WHERE email = ?';

    private $idDeputado;

    public function __construct($nome = null, $email = null, $senhaBruta = null, $idPais = null, $idDeputado = null) {
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
        $comando->bindValue(1, $this->idDeputado, PDO::PARAM_STR);
        $comando->bindValue(2, $idProjeto, PDO::PARAM_STR);
        $comando->bindValue(3, $comentario, PDO::PARAM_STR);
        $comando->execute();
        DW3BancoDeDados::getPdo()->commit();
    }

    public function votar($voto, $idProjeto)
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR_VOTO);
        $comando->bindValue(1, $idProjeto, PDO::PARAM_STR);
        $comando->bindValue(2, $this->idDeputado, PDO::PARAM_STR);
        $comando->bindValue(3, $voto, PDO::PARAM_STR);
        $comando->execute();
        DW3BancoDeDados::getPdo()->commit();

        $sql = DW3BancoDeDados::prepare(self::BUSCAR_TODOS_VOTOS_PROJETO);
        $sql->bindValue(1, $idProjeto, PDO::PARAM_INT);
        $sql->execute();
        $registro = $sql->fetch();
        $quantidadeVotos = $registro['votosProjeto'];

        $sql = DW3BancoDeDados::prepare(self::BUSCAR_TODOS_DEPUTADOS_PAIS);
        $sql->bindValue(1, $this->idPais, PDO::PARAM_INT);
        $sql->execute();
        $registro = $sql->fetch();
        $quantidadeDeputados = $registro['deputadosPais'];

        if($quantidadeVotos == $quantidadeDeputados){
            $projeto = Projeto::buscarProjeto($idProjeto);

            if($projeto->getVotosAprovados() == $projeto->getVotosReprovados()){
                Projeto::atualizar(5, $idProjeto);
                return 'empate';
            }elseif($projeto->getVotosAprovados() > $projeto->getVotosReprovados()){
                Projeto::atualizar(2, $idProjeto);
                return 'aprovado';
            }else{
                Projeto::atualizar(3, $idProjeto);
                return 'reprovado';
            }
        }else{
            return false;
        }
    }

    public function getDeputado($email)
    {
        $sql = DW3BancoDeDados::prepare(self::BUSCAR_TODOS_CAMPOS_DEPUTADOS_POR_EMAIL);
        $sql->bindValue(1, $email, PDO::PARAM_STR);
        $sql->execute();
        $registro = $sql->fetch();
        return $registro;
    }
}
