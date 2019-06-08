<?php
namespace Controlador;

use \Framework\DW3Controlador;
use \Framework\DW3Sessao;

abstract class Controlador extends DW3Controlador
{
    protected function verificarLogin()
    {
    	$usuario = DW3Sessao::get('logado');
    	
        if ($usuario) {
        	return true;
        }else{
        	$this->redirecionar(URL_RAIZ);
        }
    }

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

}
