<?php

class DB{
    private $servername = "127.0.0.1";
    private $username = "root";
    private $password = "1234";
    private $database = "Escuela";
    private $port = 3300;

    public function getConnection(){
        $host = "mysql:host=" . $this->servername.";port=".$this->port.";dbname=".$this->database.";";

        try{
            $connection = new PDO($host, $this->username, $this->password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        }catch(PDOException $e){
            die("Error de conexión: " . $e->getMessage());
        }
    }

}

?>