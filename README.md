# PHPCrud-P1Empresa

### El puerto óptimo seria el 3306 pero lo tenía ocupado...
```bash
docker run -p 3300:3306 --name bryanDB -e MYSQL_ROOT_PASSWORD=1234 -d mysql:lts
```

### Reinicializar docker

```bash
docker start bryanDB
```

### Crear la base de datos

```sql
CREATE DATABASE Escuela;

USE Escuela;

CREATE TABLE Alumnos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    apellido VARCHAR(100),
    correo VARCHAR(100) UNIQUE,
    telefono VARCHAR(15),
    direccion VARCHAR(255)
);
```