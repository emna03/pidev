<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/xdebug' => [[['_route' => '_profiler_xdebug', '_controller' => 'web_profiler.controller.profiler::xdebugAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
        '/' => [[['_route' => 'app_hello_world', '_controller' => 'App\\Controller\\HelloWorldController::index'], null, null, null, false, false, null]],
        '/lampadaire' => [[['_route' => 'app_lampadaire_index', '_controller' => 'App\\Controller\\LampadaireController::index'], null, ['GET' => 0], null, true, false, null]],
        '/lampadaire/new' => [[['_route' => 'app_lampadaire_new', '_controller' => 'App\\Controller\\LampadaireController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/lampadaire/citoyen/lampadaires' => [[['_route' => 'citizen_lampadaire_index', '_controller' => 'App\\Controller\\LampadaireController::citizenIndex'], null, ['GET' => 0], null, false, false, null]],
        '/quartier' => [[['_route' => 'app_quartier_index', '_controller' => 'App\\Controller\\QuartierController::index'], null, ['GET' => 0], null, true, false, null]],
        '/quartier/new' => [[['_route' => 'app_quartier_new', '_controller' => 'App\\Controller\\QuartierController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                    .'|wdt/([^/]++)(*:57)'
                    .'|profiler/(?'
                        .'|font/([^/\\.]++)\\.woff2(*:98)'
                        .'|([^/]++)(?'
                            .'|/(?'
                                .'|search/results(*:134)'
                                .'|router(*:148)'
                                .'|exception(?'
                                    .'|(*:168)'
                                    .'|\\.css(*:181)'
                                .')'
                            .')'
                            .'|(*:191)'
                        .')'
                    .')'
                .')'
                .'|/lampadaire/(?'
                    .'|([^/]++)(?'
                        .'|(*:228)'
                        .'|/edit(*:241)'
                        .'|(*:249)'
                    .')'
                    .'|citoyen/lampadaires/([^/]++)(*:286)'
                .')'
                .'|/quartier/(?'
                    .'|([^/]++)(?'
                        .'|/edit(*:324)'
                        .'|(*:332)'
                    .')'
                    .'|show(?'
                        .'|\\-all(*:353)'
                        .'|/([^/]++)(*:370)'
                    .')'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        38 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        98 => [[['_route' => '_profiler_font', '_controller' => 'web_profiler.controller.profiler::fontAction'], ['fontName'], null, null, false, false, null]],
        134 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        148 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        168 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception_panel::body'], ['token'], null, null, false, false, null]],
        181 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception_panel::stylesheet'], ['token'], null, null, false, false, null]],
        191 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
        228 => [[['_route' => 'app_lampadaire_show', '_controller' => 'App\\Controller\\LampadaireController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        241 => [[['_route' => 'app_lampadaire_edit', '_controller' => 'App\\Controller\\LampadaireController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        249 => [[['_route' => 'app_lampadaire_delete', '_controller' => 'App\\Controller\\LampadaireController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        286 => [[['_route' => 'citizen_lampadaire_show', '_controller' => 'App\\Controller\\LampadaireController::citizenShow'], ['id'], ['GET' => 0], null, false, true, null]],
        324 => [[['_route' => 'app_quartier_edit', '_controller' => 'App\\Controller\\QuartierController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        332 => [[['_route' => 'app_quartier_delete', '_controller' => 'App\\Controller\\QuartierController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        353 => [[['_route' => 'app_quartier_show_all', '_controller' => 'App\\Controller\\QuartierController::showAll'], [], ['GET' => 0], null, false, false, null]],
        370 => [
            [['_route' => 'app_quartier_show', '_controller' => 'App\\Controller\\QuartierController::show'], ['id'], ['GET' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
