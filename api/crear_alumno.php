<?php
require_once("../apis.php");

header("Content-Type: application/json");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $data = json_decode(file_get_contents("php://input"), true);

    if(isset($data['nombre']) && isset($data['apellido']) && isset($data['correo'])
    && isset($data['telefono']) && isset($data['direccion'])) {

        Alumno::addAlumno($data['nombre'],$data['apellido'],$data['correo'],$data['telefono'],$data['direccion']);
        //echo json_encode(["mensaje" => "Alumno agregado correctamente"]);

        if ($resultado) {
            http_response_code(201);
            echo json_encode(["mensaje" => "Alumno agregado correctamente"]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Error al agregar el alumno"]);
        }

    }else{
        http_response_code(400);
        echo json_encode(["error" => "Datos incompletos"]);
    }
} else {
    http_response_code(405);
    echo json_encode(["error" => "Método no permitido"]);
}
?>