<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Comentario extends Modelo
{
    const BUSCAR_TODOS_PELO_PROJETO = "SELECT id_comentario, id_presidente, id_projeto, id_deputado, comentario, DATE_FORMAT(data_comentario,'%d/%m/%Y %H:%i:%s') AS data_comentario FROM comentarios WHERE id_projeto = ? ORDER BY id_comentario DESC";

    private $idComentario;
    private $comentario;
    private $dataComentario;
    private $pessoa;

    public function __construct($comentario, $idComentario = null, $dataComentario, $pessoa = null) {
        $this->idComentario = $idComentario;
        $this->comentario = $comentario;
        $this->dataComentario = $dataComentario;
        $this->pessoa = $pessoa;
        parent::__construct('comentarios');
    }

    public function getPessoa()
    {
        return $this->pessoa;
    }

    public function getDataComentario()
    {
        return $this->dataComentario;
    }

    public function getComentario()
    {
        return $this->comentario;
    }

    public static function buscarComentarios($idProjeto)
    {
        $sql = DW3BancoDeDados::prepare(self::BUSCAR_TODOS_PELO_PROJETO);
        $sql->bindValue(1, $idProjeto, PDO::PARAM_INT);
        $sql->execute();
        $registros = $sql->fetchAll();
        $objetos = [];

        foreach ($registros as $registro) {
            if($registro['id_deputado'] != null && $registro['id_deputado'] != ""){
                $pessoa = Deputado::buscarDeputadoPeloId($registro['id_deputado']);
            }else{
                $pessoa = Presidente::buscarPresidente($registro['id_presidente']);
            }

            $comentario = new Comentario(
                $registro['comentario'],
                $registro['id_comentario'],
                $registro['data_comentario'],
                $pessoa
            );

            $objetos[] = $comentario;
        }

        return $objetos;
    }
}
