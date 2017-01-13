<?php

return [
    'services' => [
        'redis' => [
            'class'      => '\Owl\Service\Predis',
            'parameters' => [
                'scheme'     => 'tcp',
                'host'       => '127.0.0.1',
                'port'       => 6379,
                'persistent' => true,
                'timeout'    => 3,
            ],
            'options'    => [
                'exception' => true,
            ],
        ],
    ],
    'loggers'  => [
        'default' => [
            'handlers' => [
                // [
                //     'class' => '\Monolog\Handler\ChromePHPHandler',
                //     'level' => 'DEBUG'
                // ],
                // [
                //     'class' => '\Monolog\Handler\FirePHPHandler',
                //     'level' => 'DEBUG'
                // ],
                [
                    'class'     => '\Monolog\Handler\StreamHandler',
                    // 'arguments' => [__DIR__.'/logs/sys-'.date('Y-m-d').'.log'],
                    'arguments' => ['php://output'],
                    'level'     => 'DEBUG',
                ],
            ],
        ],
        'crontab' => [
            'handlers' => [
                [
                    'class'     => '\Monolog\Handler\StreamHandler',
                    // 'arguments' => [__DIR__.'/logs/crontab-'.date('Y-m-d').'.log'],
                    'arguments' => ['php://output'],
                    'level'     => 'DEBUG',
                ],
            ],
        ],
    ],
];
