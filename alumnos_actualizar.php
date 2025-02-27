<?php

header('Content-Type: application/json');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST,PATCH, OPTIONS");
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

if (isset($data['id'],$data['nombre'], $data['apellido'], $data['correo'], $data['telefono'], $data['direccion'])) {
    $id = (int)$data['id'];
    $direccion = (string)$data['direccion'];
    $stmt = $conn->prepare("UPDATE Alumnos SET nombre = ?, apellido = ?, correo = ?, telefono = ?, direccion = ? WHERE id = ?");
    
    if ($stmt === false) {
        die(json_encode(["error" => "Error en la consulta: " . $conn->error]));
    }

    $stmt->bind_param("sssssi", $data['nombre'], $data['apellido'], $data['correo'], $data['telefono'], $direccion,$id);

    if ($stmt->execute()) {
        echo json_encode(["mensaje" => "Alumno Actualizado"]);
    } else {
        echo json_encode(["error" => "Alumno no actualizado: " . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(["error" => "Datos incompletos"]);
}

$conn->close();
?>