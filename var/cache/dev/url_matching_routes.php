<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/' => [[['_route' => 'index_HTML', '_controller' => 'App\\Controller\\ControllerHtml::Index'], null, ['GET' => 0], null, false, false, null]],
        '/api/contatos' => [
            [['_route' => 'AddContato_API', '_controller' => 'App\\Controller\\ContatosController::NovoContato'], null, ['POST' => 0], null, true, false, null],
            [['_route' => 'listarContato_API', '_controller' => 'App\\Controller\\ContatosController::buscarContatos'], null, ['GET' => 0], null, true, false, null],
        ],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/api/contatos/([^/]++)(?'
                    .'|(*:67)'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        67 => [
            [['_route' => 'listarUmContato_API', '_controller' => 'App\\Controller\\ContatosController::buscarUmContato'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'editarUmContato_API', '_controller' => 'App\\Controller\\ContatosController::editarContato'], ['id'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'excluirUmContato_API', '_controller' => 'App\\Controller\\ContatosController::excluirContato'], ['id'], ['DELETE' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
