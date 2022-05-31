<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=' . $_ENV['DB_HOST']. ';dbname=' . $_ENV['DB_NAME'],
    'username' => $_ENV['DB_USERNAME'],
    'password' => $_ENV['DB_PASSWORD'],
    'charset' => 'utf8mb4',

    // 'class' => 'yii\db\Connection',
//    'dsn' => 'mysql:host=localhost;dbname=test_app_api',
//    'username' => 'test_app_api',
//    'password' => 'test_app_api',
//    'charset' => 'utf8',
];
