<?php

$rotas = [
    '/' => [
        'GET' => '\Controlador\PaisControlador#index'
    ],
    '/novoPais' => [
    	'GET' => '\Controlador\PaisControlador#novoPais',
    	'POST' => '\Controlador\PaisControlador#criarNovoPais'
    ],
    '/verificacaoNovoPais' => [
    	'POST' => '\Controlador\PaisControlador#verificarPaisExiste'
    ],
    '/login' => [
        'GET' => '\Controlador\PessoaControlador#login',
        'POST' => '\Controlador\PessoaControlador#fazerLogin'
    ],
    '/verificacaoEmail' => [
        'POST' => '\Controlador\PessoaControlador#verificarEmailExiste'
    ],
    '/projetos' => [
        'GET' => '\Controlador\ProjetoControlador#index'
    ],
    '/sair' => [
        'GET' => '\Controlador\PessoaControlador#logoff'
    ],
    '/pais/?' => [
        'GET' => '\Controlador\ProjetoControlador#filtrarPais'
    ],
    '/painel' => [
        'GET' => '\Controlador\Controlador#painel'
    ],
    '/novoDeputado' => [
        'GET' => '\Controlador\PessoaControlador#novoDeputado',
        'POST' => '\Controlador\PessoaControlador#cadastrarNovoDeputado'
    ],
    '/verificacaoEmailNaoExiste' => [
        'POST' => '\Controlador\PessoaControlador#verificacaoEmailNaoExiste'
    ],
    '/novoProjeto' => [
        'GET' => '\Controlador\ProjetoControlador#novoProjeto',
        'POST' => '\Controlador\ProjetoControlador#criarNovoProjeto'
    ],
    '/projeto/?' => [
        'GET' => '\Controlador\ProjetoControlador#projeto',
    ],
];
