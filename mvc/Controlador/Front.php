<?php
namespace Controlador;

class Front extends Controlador
{
    public function index()
    {
        $this->visao('front/index.php');
    }
}
