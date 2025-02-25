<?php

//echo "Hola Mundo";

header('Content-Type: application/json');

header("Access-Control-Allow-Origin: *"); // Permitir cualquier origen (ajusta según sea necesario)
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

$sql = "SELECT * FROM Alumnos";

$result = $conn->query($sql);

$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$conn->close();

/*foreach ($data as $alumno) {
    echo $alumno['Nombre'] . " " . $alumno['Apellido'];
}*/

echo json_encode($data);

?>
