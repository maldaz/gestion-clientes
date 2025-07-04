<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Pedido;
use App\Models\Cliente;

class PedidoController
{
    // Listar todos los pedidos
    public function index(Request $request, Response $response): Response
    {
        $pedidos = Pedido::with('cliente')->get();
        $response->getBody()->write(json_encode($pedidos));
        return $response->withHeader('Content-Type', 'application/json');
    }

    // Obtener un pedido por ID
    public function show(Request $request, Response $response, array $args): Response
    {
        $pedido = Pedido::with('cliente')->find($args['id']);
        if (!$pedido) {
            $response->getBody()->write(json_encode(['error' => 'Pedido no encontrado']));
            return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
        }
        $response->getBody()->write(json_encode($pedido));
        return $response->withHeader('Content-Type', 'application/json');
    }

    // Crear un nuevo pedido
    public function store(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();

        $pedido = Pedido::create([
            'cliente_id' => $data['cliente_id'],
            'descripcion' => $data['descripcion'],
            'estado' => $data['estado'],
            'fecha' => $data['fecha']
        ]);

        $response->getBody()->write(json_encode(['message' => 'Pedido creado', 'pedido' => $pedido]));
        return $response->withStatus(201)->withHeader('Content-Type', 'application/json');
    }

    // Actualizar un pedido existente
    public function update(Request $request, Response $response, array $args): Response
    {
        $pedido = Pedido::find($args['id']);
        if (!$pedido) {
            $response->getBody()->write(json_encode(['error' => 'Pedido no encontrado']));
            return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
        }

        $data = $request->getParsedBody();
        $pedido->update($data);

        $response->getBody()->write(json_encode(['message' => 'Pedido actualizado', 'pedido' => $pedido]));
        return $response->withHeader('Content-Type', 'application/json');
    }

    // Eliminar un pedido
    public function destroy(Request $request, Response $response, array $args): Response
    {
        $pedido = Pedido::find($args['id']);
        if (!$pedido) {
            $response->getBody()->write(json_encode(['error' => 'Pedido no encontrado']));
            return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
        }

        $pedido->delete();
        $response->getBody()->write(json_encode(['message' => 'Pedido eliminado']));
        return $response->withHeader('Content-Type', 'application/json');
    }
}
