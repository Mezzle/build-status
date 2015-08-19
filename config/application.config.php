<?php

return [
    // Development time modules
    'modules' => [
        'BuildStatus',
        'ZF\DevelopmentMode',
        'ZfcTwig',
    ],
    'module_listener_options' => [
        'module_paths' => [
            './module',
            './vendor',
        ],
        'config_glob_paths' => [
            'config/autoload/{{,*.}global,{,*.}local}.php',
        ],
    ],
];
