<?php
/**
 * Lib Redis
 * @package lib-redis
 * @version 0.0.1
 */

return [
    '__name' => 'lib-redis',
    '__version' => '0.0.1',
    '__git' => 'git@github.com:getphun/lib-redis.git',
    '__license' => 'MIT',
    '__author' => [
        'name' => 'Iqbal Fauzi',
        'email' => 'iqbalfawz@gmail.com',
        'website' => 'https://iqbalfn.com/'
    ],
    '__files' => [
        'modules/lib-redis' => ['install', 'update', 'remove']
    ],
    '__dependencies' => [
        'required' => [],
        'optional' => []
    ],
    '__inject' => [
        [
            'name' => 'libRedis',
            'question' => 'lib-redis app config',
            'children' => [
        		[
        			'name' => [
                        'question' => 'New redis connection name',
                        'rule'     => 'any'
                    ],
                    'children' => [
                        [
                            'name' => 'socket',
                            'question' => 'Connection socket',
                            'rule' => 'any'
                        ],
                        [
                            'name' => 'host',
                            'question' => 'Connection hostname',
                            'default' => '127.0.0.1',
                            'rule' => 'any'
                        ],
                        [
                            'name' => 'port',
                            'question' => 'Connection port number',
                            'default' => '6379',
                            'rule' => 'any'
                        ],
                        [
                            'name' => 'password',
                            'question' => 'Connection password',
                            'rule' => 'any'
                        ],
                        [
                            'name' => 'db',
                            'question' => 'DB Index',
                            'rule' => 'number'
                        ],
                        [
                            'name' => 'prefix',
                            'question' => 'Key prefix',
                            'rule' => 'any'
                        ]
                    ]
        		]
            ]
        ]
    ],
    'autoload' => [
        'classes' => [
            'LibRedis\\Library' => [
                'type' => 'file',
                'base' => 'modules/lib-redis/library'
            ],
            'LibRedis\\Server' => [
                'type' => 'file',
                'base' => 'modules/lib-redis/server'
            ]
        ]
    ],
    'server' => [
        'lib-redis' => [
            'Redis' => 'LibRedis\\Server\\PHP::redis'
        ]
    ]
];