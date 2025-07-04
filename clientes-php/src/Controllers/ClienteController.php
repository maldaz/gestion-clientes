<?php

namespace App\Controllers;

use App\Models\Cliente;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ClienteController
{
    // Obtener todos los clientes
    public function index(Request $request, Response $response): Response
    {
        $clientes = Cliente::all();
        $response->getBody()->write(json_encode($clientes));
        return $response->withHeader('Content-Type', 'application/json');
    }

    // Obtener un cliente por ID
    public function show(Request $request, Response $response, array $args): Response
    {
        $cliente = Cliente::find($args['id']);
        if (!$cliente) {
            $response->getBody()->write(json_encode(['error' => 'Cliente no encontrado']));
            return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
        }

        $response->getBody()->write(json_encode($cliente));
        return $response->withHeader('Content-Type', 'application/json');
    }

    // Crear un nuevo cliente
    public function store(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();

        $cliente = Cliente::create([
            'nombre' => $data['nombre'] ?? '',
            'correo' => $data['correo'] ?? '',
            'telefono' => $data['telefono'] ?? '',
        ]);

        $response->getBody()->write(json_encode($cliente));
        return $response->withStatus(201)->withHeader('Content-Type', 'application/json');
    }

    // Actualizar un cliente
    public function update(Request $request, Response $response, array $args): Response
    {
        $cliente = Cliente::find($args['id']);
        if (!$cliente) {
            $response->getBody()->write(json_encode(['error' => 'Cliente no encontrado']));
            return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
        }

        $data = $request->getParsedBody();
        $cliente->update($data);

        $response->getBody()->write(json_encode($cliente));
        return $response->withHeader('Content-Type', 'application/json');
    }

    // Eliminar un cliente
    public function destroy(Request $request, Response $response, array $args): Response
    {
        $cliente = Cliente::find($args['id']);
        if (!$cliente) {
            $response->getBody()->write(json_encode(['error' => 'Cliente no encontrado']));
            return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
        }

        $cliente->delete();
        $response->getBody()->write(json_encode(['message' => 'Cliente eliminado']));
        return $response->withHeader('Content-Type', 'application/json');
    }
}
