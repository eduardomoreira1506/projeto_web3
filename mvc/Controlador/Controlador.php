<?php
namespace Controlador;

use \Framework\DW3Controlador;
use \Framework\DW3Sessao;

abstract class Controlador extends DW3Controlador
{
    protected function estaLogado()
    {
    	$usuario = DW3Sessao::get('usuario');
    	
        if ($usuario == null) {
        	return false;
        }else{
        	return true;
        }
    }
}
