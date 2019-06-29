<?php

$rotas = [
    '/' => [
        'GET' => '\Controlador\PaisControlador#index'
    ],
    '/pais' => [
    	'GET' => '\Controlador\PaisControlador#criar',
    	'POST' => '\Controlador\PaisControlador#armazenar'
    ],
    '/login' => [
        'GET' => '\Controlador\PessoaControlador#index',
        'POST' => '\Controlador\PessoaControlador#armazenar'
    ],
    '/projetos' => [
        'GET' => '\Controlador\ProjetoControlador#index',
        'POST' => '\Controlador\ProjetoControlador#paginacao'
    ],
    '/sair' => [
        'GET' => '\Controlador\PessoaControlador#destruir'
    ],
    '/pais/?' => [
        'GET' => '\Controlador\ProjetoControlador#filtrarPais'
    ],
    '/painel' => [
        'GET' => '\Controlador\PainelControlador#index'
    ],
    '/deputado' => [
        'GET' => '\Controlador\DeputadoControlador#index',
        'POST' => '\Controlador\DeputadoControlador#armazenar'
    ],
    '/projeto' => [
        'GET' => '\Controlador\ProjetoControlador#novoProjeto',
        'POST' => '\Controlador\ProjetoControlador#armazenar'
    ],
    '/projeto/?' => [
        'GET' => '\Controlador\ProjetoControlador#projeto',
    ],
    '/comentario' => [
        'POST' => '\Controlador\ComentarioControlador#armazenar',
    ],
    '/votar' => [
        'POST' => '\Controlador\VotoControlador#armazenar'
    ],
    '/busca' => [
        'POST' => '\Controlador\ProjetoControlador#busca'
    ],
    '/alterarStatusProjeto' => [
        'POST' => '\Controlador\ProjetoControlador#alterarStatusProjeto'
    ],
    '/verificacaoEmail' => [
        'POST' => '\Controlador\PessoaControlador#verificarEmailExiste'
    ],
    '/verificacaoEmailNaoExiste' => [
        'POST' => '\Controlador\PessoaControlador#verificacaoEmailNaoExiste'
    ],
    '/verificacaoNovoPais' => [
        'POST' => '\Controlador\PaisControlador#verificarPaisExiste'
    ],
];
