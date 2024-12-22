<?php

// Productos-servicios API

// Token  GET
$token_GET = '12345';

function handle_productos-servicios_get() {
    global $token_GET;
    $headers = getallheaders();
    $client_token = isset($headers['Authorization']) ? $headers['Authorization'] : null;
    if ($client_token !== $token_GET) {
        header('HTTP/1.1 403 Forbidden');
        echo json_encode(['error' => 'Token inválido  GET']);
        exit;
    }
    // Aquí se implementa la lógica de GET  productos-servicios
    echo json_encode(['message' => 'GET en productos-servicios ejecutado correctamente']);
}

// Token  POST
$token_POST = '23456';

function handle_productos-servicios_post() {
    global $token_POST;
    $headers = getallheaders();
    $client_token = isset($headers['Authorization']) ? $headers['Authorization'] : null;
    if ($client_token !== $token_POST) {
        header('HTTP/1.1 403 Forbidden');
        echo json_encode(['error' => 'Token inválido  POST']);
        exit;
    }
    // Aquí se implementa la lógica de POST  productos-servicios
    echo json_encode(['message' => 'POST en productos-servicios ejecutado correctamente']);
}

// Token  PUT
$token_PUT = '34567';

function handle_productos-servicios_put() {
    global $token_PUT;
    $headers = getallheaders();
    $client_token = isset($headers['Authorization']) ? $headers['Authorization'] : null;
    if ($client_token !== $token_PUT) {
        header('HTTP/1.1 403 Forbidden');
        echo json_encode(['error' => 'Token inválido  PUT']);
        exit;
    }
    // Aquí se implementa la lógica de PUT  productos-servicios
    echo json_encode(['message' => 'PUT en productos-servicios ejecutado correctamente']);
}

// Token  DELETE
$token_DELETE = '45678';

function handle_productos-servicios_delete() {
    global $token_DELETE;
    $headers = getallheaders();
    $client_token = isset($headers['Authorization']) ? $headers['Authorization'] : null;
    if ($client_token !== $token_DELETE) {
        header('HTTP/1.1 403 Forbidden');
        echo json_encode(['error' => 'Token inválido  DELETE']);
        exit;
    }
    // Aquí se implementa la lógica de DELETE  productos-servicios
    echo json_encode(['message' => 'DELETE en productos-servicios ejecutado correctamente']);
}

// Token  PATCH
$token_PATCH = '56789';

function handle_productos-servicios_patch() {
    global $token_PATCH;
    $headers = getallheaders();
    $client_token = isset($headers['Authorization']) ? $headers['Authorization'] : null;
    if ($client_token !== $token_PATCH) {
        header('HTTP/1.1 403 Forbidden');
        echo json_encode(['error' => 'Token inválido  PATCH']);
        exit;
    }
    // Aquí se implementa la lógica de PATCH  productos-servicios
    echo json_encode(['message' => 'PATCH en productos-servicios ejecutado correctamente']);
}

?>