<?php

return [
    'db' => [
        
        'dsn'      => 'mysql:host=localhost;dbname=tickets;charset=utf8mb4',
        'user'     => 'root',
        'password' => '',          
        'options'  => [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ],
    ],
];
