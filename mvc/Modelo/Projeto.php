<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;
use \Framework\DW3ImagemUpload;

class Projeto extends Modelo
{
    const BUSCAR_TODOS_DO_PAIS = "SELECT id_projeto,id_deputado,id_pais, DATE_FORMAT(data_criacao,'%d/%m/%Y %H:%i:%s') AS data_criacao, status, titulo, descricao, DATE_FORMAT(data_resultado,'%d/%m/%Y %H:%i:%s') AS data_resultado, DATE_FORMAT(data_criacao,'%d-%m-%Y-%H') AS horario FROM projetos WHERE id_pais = ?";
    const BUSCAR_TODOS = "SELECT id_projeto,id_deputado,id_pais, DATE_FORMAT(data_criacao,'%d/%m/%Y %H:%i:%s') AS data_criacao, status, titulo, descricao, DATE_FORMAT(data_resultado,'%d/%m/%Y %H:%i:%s') AS data_resultado, DATE_FORMAT(data_criacao,'%d-%m-%Y-%H') AS horario FROM projetos";
    const BUSCAR_PROJETO_PELO_ID = "SELECT presidentes.nome as nomePresidente, paises.nome as nomePais, paises.sigla ,id_projeto,id_deputado,projetos.id_pais, DATE_FORMAT(data_criacao,'%d/%m/%Y %H:%i:%s') AS data_criacao, status, titulo, descricao, DATE_FORMAT(data_resultado,'%d/%m/%Y %H:%i:%s') AS data_resultado FROM projetos JOIN paises USING (id_pais) JOIN presidentes USING (id_pais) WHERE id_projeto = ?";
    const INSERIR = 'INSERT INTO projetos(id_deputado,id_pais,titulo,descricao) VALUES (?, ?,?,?)';

    private $idProjeto;
    private $idDeputado;
    private $idPais;
    private $dataCriacao;
    private $status;
    private $titulo;
    private $descricao;
    private $imagem;
    private $dataResultado;
    private $tempoFormatado;
    private $pais;

    public function __construct(
        $idProjeto = null,
        $idDeputado = null,
        $idPais = null,
        $dataCriacao = null,
        $status = null,
        $titulo = null,
        $descricao = null,
        $imagem = null,
        $dataResultado = null
    ) {
        $this->idProjeto = $idProjeto;
        $this->idDeputado = $idDeputado;
        $this->idPais = $idPais;
        $this->dataCriacao = $dataCriacao;
        $this->status = $status;
        $this->titulo = $titulo;
        $this->descricao = $descricao;
        $this->imagem = $imagem;
        $this->dataResultado = $dataResultado;
        parent::__construct('projetos');
    }

    public function setTempoFormatado($tempoFormatado)
    {
        $this->tempoFormatado = $tempoFormatado;
    }

    public function getTempoFormatado()
    {
        return $this->tempoFormatado;
    }

    public function getDescricaoResumida()
    {
        if(strlen($this->descricao) > 300){
            return substr($this->descricao, 0, 300) . '...';
        }

        return $this->descricao;
    }

    public function getDataCriacao()
    {
        return $this->dataCriacao;
    }

    public function getStatus()
    {
        switch($this->status){
            case 0: return "Aguardando aprovação do presidente";
            case 1: return "Em votação";
            case 2: return "Aprovado";
            case 3: return "Reprovado";
        }
    }

    public function setPais($pais)
    {
        $this->pais = $pais;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function getDataResultado()
    {
        return $this->dataResultado;
    }

    public function getIdProjeto()
    {
        return $this->idProjeto;
    }

    public function setIdPais($idPais)
    {
        $this->idPais = $idPais;
    }

    public function getIdPais()
    {
        return $this->idPais;
    }

    public function getPais()
    {
        return $this->pais;
    }

    public function buscarProjeto($idProjeto)
    {
        $sql = DW3BancoDeDados::prepare(self::BUSCAR_PROJETO_PELO_ID);
        $sql->bindValue(1, $idProjeto, PDO::PARAM_INT);
        $sql->execute();
        $registro = $sql->fetch();

        $projeto = new Projeto(
            $registro['id_projeto'],
            $registro['id_deputado'],
            $registro['id_pais'],
            $registro['data_criacao'],
            $registro['status'],
            $registro['titulo'],
            $registro['descricao'],
            null,
            $registro['data_resultado']
        );

        $pais = new Pais(
            $registro['nomePais'],
            $registro['sigla']
        );

        $projeto->setPais($pais);

        $presidente = new Presidente($registro['nomePresidente']);
        $projeto->getPais()->setPresidente($presidente);

        return $projeto;
    }

    public function buscarTodosProjetos()
    {
        $sql = DW3BancoDeDados::prepare(self::BUSCAR_TODOS);
        $sql->bindValue(1, $this->idPais, PDO::PARAM_INT);
        $sql->execute();
        $registros = $sql->fetchAll();
        $objetos = [];

        foreach ($registros as $registro) {
            $projeto = new Projeto(
                $registro['id_projeto'],
                $registro['id_deputado'],
                $registro['id_pais'],
                $registro['data_criacao'],
                $registro['status'],
                $registro['titulo'],
                $registro['descricao'],
                null,
                $registro['data_resultado']
            );
            
            $dataAtual = mktime();
            $diaAtual = date("d", $dataAtual);
            $mesAtual = date("m", $dataAtual);
            $anoAtual = date("Y", $dataAtual);
            $horaAtual = date("h", $dataAtual);

            $arrayDataRegistro = explode("-", $registro['horario']);
            $diaRegistro = $arrayDataRegistro[0];
            $mesRegistro = $arrayDataRegistro[1];
            $anoRegistro = $arrayDataRegistro[2];
            $horarioRegistro = $arrayDataRegistro[3];

            if($diaAtual == $diaRegistro && $mesAtual == $mesRegistro && $anoAtual == $anoRegistro){
                $projeto->setTempoFormatado($horaAtual - $horarioRegistro . ' hora(s) atrás');
            }elseif($mesAtual == $mesRegistro){
                $projeto->setTempoFormatado($diaAtual - $diaRegistro . ' dia(s) atrás');
            }elseif($anoAtual == $anoRegistro){
                $meses = $mesAtual - $mesRegistro;

                if($diaAtual > $diaRegistro){
                    $projeto->setTempoFormatado(($diaAtual - $diaRegistro) + ($meses * 30) . ' dias atrás');
                }else{
                    $projeto->setTempoFormatado(($diaRegistro - $diaAtual) + ($meses * 30) . ' dias atrás');
                }
            }else{
                $anos = $anoAtual = $anoRegistro;

                if($mesAtual > $mesRegistro){
                    $projeto->setTempoFormatado($anos . ' anos e' + ($mesAtual - $mesRegistro ) * 30 . ' dias atrás');
                }else{
                    $projeto->setTempoFormatado($anos . ' anos e' + ($mesRegistro - $mesAtual) * 30 . ' dias atrás');
                }
            }

            $objetos[] = $projeto;
        }

        return $objetos;
    }

    public function buscarTodosProjetosDoPais()
    {
        $sql = DW3BancoDeDados::prepare(self::BUSCAR_TODOS_DO_PAIS);
        $sql->bindValue(1, $this->idPais, PDO::PARAM_INT);
        $sql->execute();
        $registros = $sql->fetchAll();
        $objetos = [];

        foreach ($registros as $registro) {
            $projeto = new Projeto(
                $registro['id_projeto'],
                $registro['id_deputado'],
                $registro['id_pais'],
                $registro['data_criacao'],
                $registro['status'],
                $registro['titulo'],
                $registro['descricao'],
                null,
                $registro['data_resultado']
            );
            

            $dataAtual = mktime();
            $diaAtual = date("d", $dataAtual);
            $mesAtual = date("m", $dataAtual);
            $anoAtual = date("Y", $dataAtual);
            $horaAtual = date("h", $dataAtual);

            $arrayDataRegistro = explode("-", $registro['horario']);
            $diaRegistro = $arrayDataRegistro[0];
            $mesRegistro = $arrayDataRegistro[1];
            $anoRegistro = $arrayDataRegistro[2];
            $horarioRegistro = $arrayDataRegistro[3];

            if($diaAtual == $diaRegistro && $mesAtual == $mesRegistro && $anoAtual == $anoRegistro){
                $projeto->setTempoFormatado($horaAtual - $horarioRegistro . ' hora(s) atrás');
            }elseif($mesAtual == $mesRegistro){
                $projeto->setTempoFormatado($diaAtual - $diaRegistro . ' dia(s) atrás');
            }elseif($anoAtual == $anoRegistro){
                $meses = $mesAtual - $mesRegistro;

                if($diaAtual > $diaRegistro){
                    $projeto->setTempoFormatado(($diaAtual - $diaRegistro) + ($meses * 30) . ' dias atrás');
                }else{
                    $projeto->setTempoFormatado(($diaRegistro - $diaAtual) + ($meses * 30) . ' dias atrás');
                }
            }else{
                $anos = $anoAtual = $anoRegistro;

                if($mesAtual > $mesRegistro){
                    $projeto->setTempoFormatado($anos . ' anos e' + ($mesAtual - $mesRegistro ) * 30 . ' dias atrás');
                }else{
                    $projeto->setTempoFormatado($anos . ' anos e' + ($mesRegistro - $mesAtual) * 30 . ' dias atrás');
                }
            }

            $objetos[] = $projeto;
        }

        return $objetos;
    }

    public function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $sql = DW3BancoDeDados::prepare(self::INSERIR);
        $sql->bindValue(1, $this->idDeputado, PDO::PARAM_STR);
        $sql->bindValue(2, $this->idPais, PDO::PARAM_STR);
        $sql->bindValue(3, $this->titulo, PDO::PARAM_STR);
        $sql->bindValue(4, $this->descricao, PDO::PARAM_STR);
        $sql->execute();
        $this->idProjeto = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();

        $caminhoCompleto = PASTA_PUBLICO . "img/projetos/{$this->idProjeto}.png";
        DW3ImagemUpload::salvar($this->imagem, $caminhoCompleto);
    }

}
