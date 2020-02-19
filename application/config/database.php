<?php

return [

    'connections' => [
        'mysql' => [
            'host' => getenv('DB_HOST'),
            'port' => getenv('DB_PORT'),
            'user' => getenv('DB_USERNAME'),
            'password' => getenv('DB_PASSWORD'),
            'db_name' => getenv('DB_DATABASE')
        ],

        'pgsql' => [
            'host' => getenv('DB_HOST'),
            'port' => getenv('DB_PORT'),
            'user' => getenv('DB_USERNAME'),
            'password' => getenv('DB_PASSWORD'),
            'db_name' => getenv('DB_DATABASE')
        ],
    ]
];