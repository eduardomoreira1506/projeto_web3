<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;
use \Framework\DW3ImagemUpload;

class Pais extends Modelo
{
    const VERIFICACAO_PAIS = 'SELECT id_pais FROM paises WHERE nome = ? OR sigla = ?';
    const INSERIR = 'INSERT INTO paises(nome,sigla) VALUES (?, ?)';

    private $idPais;
    private $nome;
    private $bandeira;
    private $sigla;
    private $presidente;

    public function __construct(
        $nome = null,
        $sigla = null,
        $bandeira = null,
        $idPais = null
    ) {
        $this->nome = $nome;
        $this->bandeira = $bandeira;
        $this->sigla = $sigla;
        $this->idPais = $idPais;
        parent::__construct('paises');
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getSigla()
    {
        return $this->sigla;
    }

    public function getIdPais()
    {
        return $this->idPais;
    }

    public function setPresidente($presidente)
    {
        $this->presidente = $presidente;
    }

    public function getPresidente(){
        return $this->presidente;
    }

    public function buscarTodosPaises()
    {
        $registros = $this->buscarTodos();
        $objetos = [];
        foreach ($registros as $registro) {
            $objetos[] = new Pais(
                $registro['nome'],
                $registro['sigla'],
                null,
                $registro['id_pais']
            );
        }
        return $objetos;
    }

    public function paisExiste($nomePais, $sigla)
    {
        $comando = DW3BancoDeDados::prepare(self::VERIFICACAO_PAIS);
        $comando->bindValue(1, $nomePais, PDO::PARAM_INT);
        $comando->bindValue(2, $sigla, PDO::PARAM_INT);
        $comando->execute();
        $registro = $comando->fetch();

        return $registro;
    }

    public function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->nome, PDO::PARAM_STR);
        $comando->bindValue(2, $this->sigla, PDO::PARAM_STR);
        $comando->execute();
        $this->idPais = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();

        $caminhoCompleto = PASTA_PUBLICO . "img/bandeiras/{$this->idPais}.png";
        DW3ImagemUpload::salvar($this->bandeira, $caminhoCompleto);
    }
}
