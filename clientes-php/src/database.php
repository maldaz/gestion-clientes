<?php

use Illuminate\Database\Capsule\Manager as Capsule;

require_once __DIR__ . '/../vendor/autoload.php'; // Ajusta la ruta según tu estructura

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'sqlsrv',  // Para SQL Server
    'host'      => getenv('DB_HOST') ?: 'localhost',
    'database'  => getenv('DB_DATABASE') ?: 'nombre_bd',
    'username'  => getenv('DB_USERNAME') ?: 'usuario',
    'password'  => getenv('DB_PASSWORD') ?: 'contraseña',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

// Opcional: para que Eloquent use el "query builder"
$capsule->setAsGlobal();

// Inicializar Eloquent ORM
$capsule->bootEloquent();
