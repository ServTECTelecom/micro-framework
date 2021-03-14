<?php
// https://book.cakephp.org/phinx/0/en/migrations.html

$conf = require_once __DIR__ . "/app/database.php";

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/storage/database/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/storage/database/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'production' => [
            'adapter' => 'mysql',
            'host' => 'localhost',
            'name' => 'production_db',
            'user' => 'root',
            'pass' => '',
            'port' => '3306',
            'charset' => 'utf8',
        ],
        'development' => [
            'adapter' => $conf['driver'],
            'host' => $conf['mysql']['host'],
            'name' => $conf['mysql']['database'],
            'user' => $conf['mysql']['user'],
            'pass' => $conf['mysql']['pass'],
            'port' => '3306',
            'charset' => $conf['mysql']['charset'],
        ],
        'testing' => [
            'adapter' => 'mysql',
            'host' => 'localhost',
            'name' => 'testing_db',
            'user' => 'root',
            'pass' => '',
            'port' => '3306',
            'charset' => 'utf8',
        ]
    ],
    'version_order' => 'creation'
];
