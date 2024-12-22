<?php
require_once 'config/bd.php';
require_once 'config/auth.php';

// Token  GET
$token_GET = '12345';

function handle_estilo_visual_get() {
    global $token_GET;
    $headers = getallheaders();
    $client_token = isset($headers['Authorization']) ? $headers['Authorization'] : null;
    if ($client_token !== 'Bearer ' . $token_GET) {
        header('HTTP/1.1 403 Forbidden');
        echo json_encode(['error' => 'Token inválido GET']);
        exit;
    }
    // Aquí se implementa la lógica de GET estilo-visual
    $conn = getDbConnection();
    $sql = "SELECT * FROM estilo_visual";
    $stmt = $conn->query($sql);

    $estilo_visual = [];
    while ($row = $stmt->fetch()) {
        $estilo_visual[] = $row;
    }
    echo json_encode($estilo_visual);
}

// Token  POST
$token_POST = '23456';

function handle_estilo_visual_post() {
    global $token_POST;
    $headers = getallheaders();
    $client_token = isset($headers['Authorization']) ? $headers['Authorization'] : null;
    if ($client_token !== 'Bearer ' . $token_POST) {
        header('HTTP/1.1 403 Forbidden');
        echo json_encode(['error' => 'Token inválido POST']);
        exit;
    }
    // Aquí se implementa la lógica de POST estilo-visual
    $conn = getDbConnection();
    $data = json_decode(file_get_contents("php://input"), true);
    $name = $data['name'];
    $description = $data['description'];

    $sql = "INSERT INTO estilo_visual (name, description) VALUES (:name, :description)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Estilo visual agregado correctamente']);
    } else {
        echo json_encode(['error' => 'Error: ' . $stmt->errorInfo()[2]]);
    }
}

// Token  PUT
$token_PUT = '34567';

function handle_estilo_visual_put() {
    global $token_PUT;
    $headers = getallheaders();
    $client_token = isset($headers['Authorization']) ? $headers['Authorization'] : null;
    if ($client_token !== 'Bearer ' . $token_PUT) {
        header('HTTP/1.1 403 Forbidden');
        echo json_encode(['error' => 'Token inválido PUT']);
        exit;
    }
    // Aquí se implementa la lógica de PUT estilo-visual
    $conn = getDbConnection();
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data['id'];
    $name = $data['name'];
    $description = $data['description'];

    $sql = "UPDATE estilo_visual SET name = :name, description = :description WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Estilo visual actualizado correctamente']);
    } else {
        echo json_encode(['error' => 'Error: ' . $stmt->errorInfo()[2]]);
    }
}

// Token  DELETE
$token_DELETE = '45678';

function handle_estilo_visual_delete() {
    global $token_DELETE;
    $headers = getallheaders();
    $client_token = isset($headers['Authorization']) ? $headers['Authorization'] : null;
    if ($client_token !== 'Bearer ' . $token_DELETE) {
        header('HTTP/1.1 403 Forbidden');
        echo json_encode(['error' => 'Token inválido DELETE']);
        exit;
    }
    // Aquí se implementa la lógica de DELETE estilo-visual
    $conn = getDbConnection();
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data['id'];

    $sql = "DELETE FROM estilo_visual WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Estilo visual eliminado correctamente']);
    } else {
        echo json_encode(['error' => 'Error: ' . $stmt->errorInfo()[2]]);
    }
}

// Token  PATCH
$token_PATCH = '56789';

function handle_estilo_visual_patch() {
    global $token_PATCH;
    $headers = getallheaders();
    $client_token = isset($headers['Authorization']) ? $headers['Authorization'] : null;
    if ($client_token !== 'Bearer ' . $token_PATCH) {
        header('HTTP/1.1 403 Forbidden');
        echo json_encode(['error' => 'Token inválido PATCH']);
        exit;
    }
    // Aquí se implementa la lógica de PATCH estilo-visual
    $conn = getDbConnection();
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data['id'];
    $status = $data['status'];

    $sql = "UPDATE estilo_visual SET status = :status WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Estilo visual actualizado correctamente']);
    } else {
        echo json_encode(['error' => 'Error: ' . $stmt->errorInfo()[2]]);
    }
}
?>