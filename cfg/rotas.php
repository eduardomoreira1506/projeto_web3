<?php

$rotas = [
    '/' => [
        'GET' => '\Controlador\PaisControlador#index',
    ],
    '/novoPais' => [
    	'GET' => '\Controlador\PaisControlador#novoPais',
    	'POST' => '\Controlador\PaisControlador#criarNovoPais',
    ],
    '/verificacaoNovoPais' => [
    	'POST' => '\Controlador\PaisControlador#verificarPaisExiste',
    ],
];
