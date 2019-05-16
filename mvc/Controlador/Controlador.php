<?php
namespace Controlador;

use \Framework\DW3Controlador;
use \Framework\DW3Sessao;
use \Modelo\Pessoa;

class Controlador extends DW3Controlador
{
    protected function estaLogado()
    {
    	$usuario = DW3Sessao::get('logado');
    	
        if ($usuario) {
        	return true;
        }else{
        	return false;
        }
    }

    protected function getIdPaisSessao()
    {
        $idPaisSessao = DW3Sessao::get('idPais');
        return $idPaisSessao;
    }

    protected function getTipoSessao()
    {
        $tipoSessao = DW3Sessao::get('tipo');
        return $tipoSessao;
    }

    protected function getEmailSessao()
    {
        $emailSessao = DW3Sessao::get('email');
        return $emailSessao;
    }

    protected function getNomeSessao()
    {
        $nomeSessao = DW3Sessao::get('nome');
        return $nomeSessao;
    }

    public function painel()
    {
        $logado = $this->estaLogado();
        $tipoSessao = $this->getTipoSessao();

        $informacoes = [
            'scripts' => [],
            'logado' => $logado,
            'tipo' => $tipoSessao,
        ];

        if($logado){
            $emailSessao = $this->getEmailSessao();
            $pessoa = Pessoa::fazerLogin($emailSessao);
            $nomePessoa = $pessoa->getNome();
            $nomePessoa = explode(" ", $nomePessoa);
            $nomePessoa = $nomePessoa[0];

            $mesesDoAno = ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'];
            $diasDaSemana = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'];

            $dataAtual = mktime();
            $mesAtual = $mesesDoAno[floatval(date('m', $dataAtual)) - 1];
            $diaAtual = date("d", $dataAtual);
            $anoAtual = date("Y", $dataAtual);
            $diaDaSemana = $diasDaSemana[floatval(date("w", $dataAtual))];
            $dataAtual = "$diaDaSemana, $diaAtual de $mesAtual de $anoAtual";

            $informacoes['nomePessoa'] = $nomePessoa;
            $informacoes['dataAtual'] = $dataAtual;
            $this->visao('dashboard/index.php', $informacoes);
        }else{
            $this->redirecionar(URL_RAIZ);
        }
    }

}
