<?php

header('Content-Type: application/json');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

$servername = "127.0.0.1";
$username = "root";
$password = "1234";
$database = "Escuela";
$port = 3300;

$conn = new mysqli($servername, $username, $password, $database,$port);

if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['nombre'], $data['apellido'], $data['correo'], $data['telefono'], $data['direccion'])) {
    $stmt = $conn->prepare("INSERT INTO Alumnos (nombre, apellido, correo, telefono, direccion) VALUES (?, ?, ?, ?, ?)");
    
    if ($stmt === false) {
        die(json_encode(["error" => "Error en la consulta: " . $conn->error]));
    }

    $stmt->bind_param("sssss", $data['nombre'], $data['apellido'], $data['correo'], $data['telefono'], $data['direccion']);

    if ($stmt->execute()) {
        echo json_encode(["mensaje" => "Alumno creado"]);
    } else {
        echo json_encode(["error" => "Alumno no creado: " . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(["error" => "Datos incompletos"]);
}

$conn->close();
?>