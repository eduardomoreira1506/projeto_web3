<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;
use \Framework\DW3ImagemUpload;

class Projeto extends Modelo 
{
    const BUSCAR_TODOS_DO_PAIS = "SELECT id_projeto,id_deputado,id_pais, DATE_FORMAT(data_criacao,'%d/%m/%Y') AS data_criacao, status, titulo, descricao, DATE_FORMAT(data_resultado,'%d/%m/%Y') AS data_resultado, TIMESTAMPDIFF(MINUTE, data_criacao, NOW()) AS diferenca_em_minutos FROM projetos WHERE id_pais = ? AND status LIKE '%' ? '%' AND (titulo LIKE '%' ? '%' OR descricao LIKE '%' ? '%') ORDER BY id_projeto DESC LIMIT ?, 10";
    const BUSCAR_TODOS = "SELECT id_projeto,id_deputado,id_pais, DATE_FORMAT(data_criacao,'%d/%m/%Y') AS data_criacao, status, titulo, descricao, DATE_FORMAT(data_resultado,'%d/%m/%Y') AS data_resultado, TIMESTAMPDIFF(MINUTE, data_criacao, NOW()) AS diferenca_em_minutos FROM projetos WHERE status LIKE '%' ? '%' AND (titulo LIKE '%' ? '%' OR descricao LIKE '%' ? '%') ORDER BY id_projeto DESC LIMIT ? , 10"; 
    const BUSCAR_PROJETO_PELO_ID = "SELECT (SELECT COUNT(id_voto) FROM votos WHERE id_projeto = ? AND aprovado = 1) as votos_aprovados,(SELECT COUNT(id_voto) FROM votos WHERE id_projeto = ? AND aprovado = 0) as votos_reprovados,(SELECT COUNT(id_comentario) FROM comentarios WHERE id_projeto = ?) as comentarios, presidentes.nome as nomePresidente, paises.nome as nomePais, paises.sigla ,projetos.id_projeto,projetos.id_deputado,projetos.id_pais, DATE_FORMAT(data_criacao,'%d/%m/%Y %H:%i:%s') AS data_criacao, status, titulo, descricao, DATE_FORMAT(data_resultado,'%d/%m/%Y %H:%i:%s') AS data_resultado FROM projetos JOIN paises USING (id_pais) JOIN presidentes USING (id_pais) WHERE id_projeto = ?";
    const INSERIR = 'INSERT INTO projetos(id_deputado,id_pais,titulo,descricao,id_presidente) VALUES (?, ?,?, ?,?)';
    const ATUALIZAR = 'UPDATE projetos SET status = ? WHERE id_projeto = ?';
    const BUSCAR_VOTO = 'SELECT COUNT(id_voto) as voto FROM deputados JOIN votos USING (id_deputado) WHERE id_projeto = ? AND email = ?';

    private $idProjeto;
    private $idDeputado;
    private $idPais;
    private $idPresidente;
    private $dataCriacao;
    private $status;
    private $titulo;
    private $descricao;
    private $imagem;
    private $dataResultado;
    private $tempoFormatado;
    private $pais;
    private $quantidadeComentarios;
    private $votosAprovados;
    private $votosReprovados;

    public function __construct(
        $idProjeto = null,
        $idDeputado = null,
        $idPais = null,
        $dataCriacao = null,
        $status = null,
        $titulo = null,
        $descricao = null,
        $imagem = null,
        $dataResultado = null,
        $votosAprovados = null,
        $votosReprovados = null,
        $idPresidente = null
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
        $this->votosAprovados = $votosAprovados;
        $this->votosReprovados = $votosReprovados;
        $this->idPresidente = $idPresidente;
        parent::__construct('projetos');
    }

    public function getVotosAprovados()
    {
        return $this->votosAprovados;
    }

    public function getVotosReprovados()
    {
        return $this->votosReprovados;
    }

    public function getTempoFormatado()
    {
        return $this->tempoFormatado;
    }

    public function getDescricaoResumida()
    {
        if(strlen($this->descricao) > 200){
            return substr($this->descricao, 0, 200) . '...';
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
            case 4: return "Reprovado pelo presidente";
            case 5: return "Empatado";
        }
    }

    public function getStatusNumero()
    {
        return $this->status;
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

    public function getIdPais()
    {
        return $this->idPais;
    }

    public function getPais()
    {
        return $this->pais;
    }

    public function getQuantidadeComentarios()
    {
        return $this->quantidadeComentarios;
    }

    public function setTempoFormatado($tempoFormatado)
    {
        $this->tempoFormatado = $tempoFormatado;
    }

    public function setQuantidadeComentarios($quantidadeComentarios)
    {
        $this->quantidadeComentarios = $quantidadeComentarios;
    }

    public function setPais($pais)
    {
        $this->pais = $pais;
    }

    public function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $sql = DW3BancoDeDados::prepare(self::INSERIR);
        $sql->bindValue(1, $this->idDeputado, PDO::PARAM_INT);
        $sql->bindValue(2, $this->idPais, PDO::PARAM_INT);
        $sql->bindValue(3, $this->titulo, PDO::PARAM_STR);
        $sql->bindValue(4, $this->descricao, PDO::PARAM_STR);
        $sql->bindValue(5, $this->idPresidente, PDO::PARAM_INT);
        $sql->execute();
        $this->idProjeto = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();

        $caminhoCompleto = PASTA_PUBLICO . "img/projetos/{$this->idProjeto}.png";
        DW3ImagemUpload::salvar($this->imagem, $caminhoCompleto);
    }

    public static function buscarProjeto($idProjeto)
    {
        $sql = DW3BancoDeDados::prepare(self::BUSCAR_PROJETO_PELO_ID);
        $sql->bindValue(1, $idProjeto, PDO::PARAM_INT);
        $sql->bindValue(2, $idProjeto, PDO::PARAM_INT);
        $sql->bindValue(3, $idProjeto, PDO::PARAM_INT);
        $sql->bindValue(4, $idProjeto, PDO::PARAM_INT);
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
            $registro['data_resultado'],
            $registro['votos_aprovados'],
            $registro['votos_reprovados']
        );

        $pais = new Pais(
            $registro['nomePais'],
            $registro['sigla']
        );

        $projeto->setQuantidadeComentarios($registro['comentarios']);
        $projeto->setPais($pais);

        $presidente = new Presidente($registro['nomePresidente']);
        $projeto->getPais()->setPresidente($presidente);

        return $projeto;
    }

    public static function buscarTodosProjetosDoPais($idPais)
    {
        $sql = DW3BancoDeDados::prepare(self::BUSCAR_TODOS_DO_PAIS);
        $sql->bindValue(1, $idPais, PDO::PARAM_INT);
        $sql->bindValue(2, '', PDO::PARAM_STR); 
        $sql->bindValue(3, '', PDO::PARAM_STR);
        $sql->bindValue(4, '', PDO::PARAM_STR);
        $sql->bindValue(5, 0, PDO::PARAM_INT);
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

            $diferencaEmMinutos = $registro['diferenca_em_minutos'];
            if($diferencaEmMinutos < 60){
                $projeto->setTempoFormatado("$diferencaEmMinutos minuto(s) atrás");
            }elseif($diferencaEmMinutos < 1440){
                $diferencaEmHoras = round($diferencaEmMinutos / 60);
                $projeto->setTempoFormatado("$diferencaEmHoras hora(s) atrás");
            }else{
                $diferencaEmDias = round($diferencaEmMinutos / 1440);
                $projeto->setTempoFormatado("$diferencaEmDias dia(s) atrás");
            }

            $objetos[] = $projeto;
        }

        return $objetos;
    }

    public static function buscarTodosProjetos()
    {
        $sql = DW3BancoDeDados::prepare(self::BUSCAR_TODOS);
        $sql->bindValue(1, '', PDO::PARAM_STR);
        $sql->bindValue(2, '', PDO::PARAM_STR);
        $sql->bindValue(3, '', PDO::PARAM_STR);
        $sql->bindValue(4, 0, PDO::PARAM_INT);
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
            
            $diferencaEmMinutos = $registro['diferenca_em_minutos'];
            if($diferencaEmMinutos < 60){
                $projeto->setTempoFormatado("$diferencaEmMinutos minuto(s) atrás");
            }elseif($diferencaEmMinutos < 1440){
                $diferencaEmHoras = round($diferencaEmMinutos / 60);
                $projeto->setTempoFormatado("$diferencaEmHoras hora(s) atrás");
            }else{
                $diferencaEmDias = round($diferencaEmMinutos / 1440);
                $projeto->setTempoFormatado("$diferencaEmDias dia(s) atrás");
            }

            $objetos[] = $projeto;
        }

        return $objetos;
    }

    public static function atualizar($status, $idProjeto)
    {
        $comando = DW3BancoDeDados::prepare(self::ATUALIZAR);
        $comando->bindValue(1, $status, PDO::PARAM_STR);
        $comando->bindValue(2, $idProjeto, PDO::PARAM_INT);
        $comando->execute();
    }

    public static function getVotosDeputadoProjeto($idProjeto, $email)
    {
        $sql = DW3BancoDeDados::prepare(self::BUSCAR_VOTO);
        $sql->bindValue(1, $idProjeto, PDO::PARAM_INT);
        $sql->bindValue(2, $email, PDO::PARAM_STR);
        $sql->execute();
        $registro = $sql->fetch();

        return $registro['voto'];
    }

    public static function buscaProjetosPais($idPais, $palavraChave, $filtro, $paginacao)
    {
        $sql = DW3BancoDeDados::prepare(self::BUSCAR_TODOS_DO_PAIS);
        $sql->bindValue(1, $idPais, PDO::PARAM_INT);
        $sql->bindValue(2, $filtro, PDO::PARAM_STR); 
        $sql->bindValue(3, $palavraChave, PDO::PARAM_STR);
        $sql->bindValue(4, $palavraChave, PDO::PARAM_STR);
        $sql->bindValue(5, intval($paginacao), PDO::PARAM_INT);
        $sql->execute();
        $registros = $sql->fetchAll();
        return $registros;
    }

    public static function buscaProjetos($palavraChave, $filtro, $paginacao)
    {
        $sql = DW3BancoDeDados::prepare(self::BUSCAR_TODOS); 
        $sql->bindValue(1, $filtro, PDO::PARAM_STR);
        $sql->bindValue(2, $palavraChave, PDO::PARAM_STR); 
        $sql->bindValue(3, $palavraChave, PDO::PARAM_STR);
        $sql->bindValue(4, intval($paginacao), PDO::PARAM_INT);
        $sql->execute();
        $registros = $sql->fetchAll();
        return $registros;
    }

}
