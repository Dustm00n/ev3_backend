<?php
require_once 'config/bd.php';
require_once 'config/auth.php';

// Token  GET
$token_GET = '12345';

function handle_productos_servicios_get() {
    global $token_GET;
    $headers = getallheaders();
    $client_token = isset($headers['Authorization']) ? $headers['Authorization'] : null;
    if ($client_token !== 'Bearer ' . $token_GET) {
        header('HTTP/1.1 403 Forbidden');
        echo json_encode(['error' => 'Token inválido GET']);
        exit;
    }
    // Aquí se implementa la lógica de GET productos-servicios
    $conn = getDbConnection();
    $sql = "SELECT * FROM productos_servicios";
    $stmt = $conn->query($sql);

    $productos_servicios = [];
    while ($row = $stmt->fetch()) {
        $productos_servicios[] = $row;
    }
    echo json_encode($productos_servicios);
}

// Token  POST
$token_POST = '23456';

function handle_productos_servicios_post() {
    global $token_POST;
    $headers = getallheaders();
    $client_token = isset($headers['Authorization']) ? $headers['Authorization'] : null;
    if ($client_token !== 'Bearer ' . $token_POST) {
        header('HTTP/1.1 403 Forbidden');
        echo json_encode(['error' => 'Token inválido POST']);
        exit;
    }
    // Aquí se implementa la lógica de POST productos-servicios
    $conn = getDbConnection();
    $data = json_decode(file_get_contents("php://input"), true);
    $name = $data['name'];
    $description = $data['description'];
    $price = $data['price'];

    $sql = "INSERT INTO productos_servicios (name, description, price) VALUES (:name, :description, :price)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':price', $price);

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Producto/Servicio agregado correctamente']);
    } else {
        echo json_encode(['error' => 'Error: ' . $stmt->errorInfo()[2]]);
    }
}

// Token  PUT
$token_PUT = '34567';

function handle_productos_servicios_put() {
    global $token_PUT;
    $headers = getallheaders();
    $client_token = isset($headers['Authorization']) ? $headers['Authorization'] : null;
    if ($client_token !== 'Bearer ' . $token_PUT) {
        header('HTTP/1.1 403 Forbidden');
        echo json_encode(['error' => 'Token inválido PUT']);
        exit;
    }
    // Aquí se implementa la lógica de PUT productos-servicios
    $conn = getDbConnection();
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data['id'];
    $name = $data['name'];
    $description = $data['description'];
    $price = $data['price'];

    $sql = "UPDATE productos_servicios SET name = :name, description = :description, price = :price WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Producto/Servicio actualizado correctamente']);
    } else {
        echo json_encode(['error' => 'Error: ' . $stmt->errorInfo()[2]]);
    }
}

// Token  DELETE
$token_DELETE = '45678';

function handle_productos_servicios_delete() {
    global $token_DELETE;
    $headers = getallheaders();
    $client_token = isset($headers['Authorization']) ? $headers['Authorization'] : null;
    if ($client_token !== 'Bearer ' . $token_DELETE) {
        header('HTTP/1.1 403 Forbidden');
        echo json_encode(['error' => 'Token inválido DELETE']);
        exit;
    }
    // Aquí se implementa la lógica de DELETE productos-servicios
    $conn = getDbConnection();
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data['id'];

    $sql = "DELETE FROM productos_servicios WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Producto/Servicio eliminado correctamente']);
    } else {
        echo json_encode(['error' => 'Error: ' . $stmt->errorInfo()[2]]);
    }
}

// Token  PATCH
$token_PATCH = '56789';

function handle_productos_servicios_patch() {
    global $token_PATCH;
    $headers = getallheaders();
    $client_token = isset($headers['Authorization']) ? $headers['Authorization'] : null;
    if ($client_token !== 'Bearer ' . $token_PATCH) {
        header('HTTP/1.1 403 Forbidden');
        echo json_encode(['error' => 'Token inválido PATCH']);
        exit;
    }
    // Aquí se implementa la lógica de PATCH productos-servicios
    $conn = getDbConnection();
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data['id'];
    $status = $data['status'];

    $sql = "UPDATE productos_servicios SET status = :status WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Producto/Servicio actualizado correctamente']);
    } else {
        echo json_encode(['error' => 'Error: ' . $stmt->errorInfo()[2]]);
    }
}
?>