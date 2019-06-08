<?php

namespace Controlador;

use \Modelo\Pessoa;

class PainelControlador extends Controlador
{

    public function painel()
    {
        $this->verificarLogin();
        $tipoSessao = $this->getTipoSessao();

        $informacoes = [
            'scripts' => [],
            'tipo' => $tipoSessao,
        ];

        $emailSessao = $this->getEmailSessao();
        $pessoa = Pessoa::fazerLogin($emailSessao);
        $nomePessoa = $pessoa->getNome();
        $nomePessoa = explode(" ", $nomePessoa);
        $nomePessoa = $nomePessoa[0];

        $mesesDoAno = ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'];
        $diasDaSemana = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'];

        $dataAtual = time();
        $mesAtual = $mesesDoAno[floatval(date('m', $dataAtual)) - 1];
        $diaAtual = date("d", $dataAtual);
        $anoAtual = date("Y", $dataAtual);
        $diaDaSemana = $diasDaSemana[floatval(date("w", $dataAtual))];
        $dataAtual = "$diaDaSemana, $diaAtual de $mesAtual de $anoAtual";

        $informacoes['nomePessoa'] = $nomePessoa;
        $informacoes['dataAtual'] = $dataAtual;
        $this->visao('dashboard/index.php', $informacoes);
    }

}
