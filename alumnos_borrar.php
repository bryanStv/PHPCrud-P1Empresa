<?php

header('Content-Type: application/json');

header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: DELETE, OPTIONS");
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

$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id === null) {
    echo json_encode(["error" => "Id incorrecto"]);
    exit();
}

$sql = "DELETE FROM Alumnos WHERE id = ?";

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    echo json_encode(["error" => "Error de la consulta"]);
    exit();
}

$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(["mensaje" => "Alumno eliminado con éxito"]);
} else {
    echo json_encode(["error" => "Error al eliminar el alumno"]);
}

$stmt->close();
$conn->close();

?>