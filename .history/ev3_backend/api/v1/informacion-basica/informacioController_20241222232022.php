<?php
require_once 'config/bd.php';

function getInformacionBasica() {
    $conn = getDbConnection();
    $sql = "SELECT * FROM informacion_basica WHERE status = 1";
    $stmt = $conn->query($sql);

    $informacion = [];
    while ($row = $stmt->fetch()) {
        $informacion[] = $row;
    }
    return $informacion;
}

function updateInformacionBasica() {
    $conn = getDbConnection();
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data['id'];
    $url_logo = $data['url_logo'];
    $nombre_empresa = $data['nombre_empresa'];
    $descripcion = $data['descripcion'];
    $palabras_clave = $data['palabras_clave'];
    $menu_principal = $data['menu_principal'];

    $sql = "UPDATE informacion_basica SET url_logo = :url_logo, nombre_empresa = :nombre_empresa, descripcion = :descripcion, palabras_clave = :palabras_clave, menu_principal = :menu_principal WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':url_logo', $url_logo);
    $stmt->bindParam(':nombre_empresa', $nombre_empresa);
    $stmt->bindParam(':descripcion', $descripcion);
    $stmt->bindParam(':palabras_clave', $palabras_clave);
    $stmt->bindParam(':menu_principal', $menu_principal);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        return ['message' => 'Información actualizada correctamente'];
    } else {
        return ['error' => 'Error: ' . $stmt->errorInfo()[2]];
    }
}

function disableInformacionBasica() {
    $conn = getDbConnection();
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data['id'];

    $sql = "UPDATE informacion_basica SET status = 0 WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        return ['message' => 'Información deshabilitada correctamente'];
    } else {
        return ['error' => 'Error: ' . $stmt->errorInfo()[2]];
    }
}

function enableInformacionBasica() {
    $conn = getDbConnection();
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data['id'];

    $sql = "UPDATE informacion_basica SET status = 1 WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        return ['message' => 'Información habilitada correctamente'];
    } else {
        return ['error' => 'Error: ' . $stmt->errorInfo()[2]];
    }
}