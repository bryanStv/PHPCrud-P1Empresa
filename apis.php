<?php
require_once("./conexion/conn.php");

class Alumno{
    public static function getAlumnos(){
        $db = new DB();
        $conectar = $db->getConnection();

        
    }

    public static function addAlumno($nombre,$apellido,$correo,$telefono,$direccion){
        $db = new DB();
        $conectar = $db->getConnection();

        $stmt = $conectar->prepare("INSERT INTO Alumnos (nombre,apellido,correo,telefono,direccion)"
        . "VALUES (:nombre,:apellido,:correo,:telefono,:direccion)");

        $stmt->bindParam(':nombre',$nombre);
        $stmt->bindParam(':apellido',$apellido);
        $stmt->bindParam(':correo',$correo);
        $stmt->bindParam(':telefono',$telefono);
        $stmt->bindParam(':direccion',$direccion);

        if($stmt->execute()){
            header("HTTP/1.1 201 Alumno creado");
            return true;
        }else{
            header("HTTP/1.1 404 Alumno no creado");
            return false;
        }
    }
}

?>