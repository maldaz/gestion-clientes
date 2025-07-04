<?php

use Slim\Routing\RouteCollectorProxy;
use App\Middleware\JwtMiddleware;
use Illuminate\Support\Facades\DB;
use App\Controllers\PedidoController;
use App\Controllers\ClienteController;

$app->get('/api/clientes', [ClienteController::class, 'index']);
$app->get('/api/clientes/{id}', [ClienteController::class, 'show']);
$app->post('/api/clientes', [ClienteController::class, 'store']);
$app->put('/api/clientes/{id}', [ClienteController::class, 'update']);
$app->delete('/api/clientes/{id}', [ClienteController::class, 'destroy']);

$app->group('/api/pedidos', function () {
    $this->get('', [PedidoController::class, 'index']);
    $this->get('/{id}', [PedidoController::class, 'show']);
    $this->post('', [PedidoController::class, 'store']);
    $this->put('/{id}', [PedidoController::class, 'update']);
    $this->delete('/{id}', [PedidoController::class, 'destroy']);
});
