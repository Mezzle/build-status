<?php

return [
    'controllers' => [
        'invokables' => [
            'index' => 'BuildStatus\Controller\IndexController'
        ],
    ],
    'router' => [
        'routes' => [
            'home' => [
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => 'index',
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'default' => [
                        'type'    => 'Segment',
                        'options' => [
                            'route'    => '[:controller[/:action]]',
                            'constraints' => [
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ],
                            'defaults' => [
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'service_manager' => require __DIR__ . '/service.config.php',
    'view_manager' => [
        'display_exceptions'       => true,
        'display_not_found_reason' => true,
        'doctype'                  => 'HTML5',
        'exception_template'       => 'error/index',
        'not_found_template'       => 'error/404',
        'strategies' => [
            'ViewJsonStrategy'
        ],
        'template_map' => [
            'buildstatus/index/index' => __DIR__ . '/../view/buildstatus/index/index.twig',
            'error/404'               => __DIR__ . '/../view/error/404.twig',
            'error/index'             => __DIR__ . '/../view/error/index.twig',
            'layout/layout'           => __DIR__ . '/../view/layout/layout.twig',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
