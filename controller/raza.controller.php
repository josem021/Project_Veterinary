<?php
require_once(__DIR__ ."/../conexion.php");
require_once(__DIR__ ."/../model/Raza.php");
require_once(__DIR__ ."/../model/Vacuna.php");

class RazaController extends Conexion {

    public function create (Raza $raza) {
        $connection = $this->connect();
        $sql= "INSERT INTO Raza (nombre, TipoMascota_id)
        VALUES ('{$raza->nombre}', '{$raza->TipoMascota_id}')";
        $result = $connection->query($sql);

        $inserted_id = $connection->insert_id;
        $raza->id = $inserted_id;

        return $result;
    }
    public function update(Raza $raza) {
        $connection = $this->connect();
        $sql = "UPDATE Raza SET nombre = '{$raza->nombre}' WHERE id = {$raza->id}";
        $result = $connection->query($sql);
        return $result;
    }
 
    public function delete (Raza $raza) {
        $connection = $this->connect();
        $sql= "DELETE FROM Raza WHERE id = '{$raza->id}'";
        $result = $connection->query($sql);
        return $result;
    }
    public function read () {
        $connection = $this->connect();
        $razas = [];
    
        $sql = "SELECT * FROM Raza";
        $result = $connection->query($sql);
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $raza = new Raza();
                $raza->id = $row["id"];
                $raza->nombre = $row["nombre"];
                $raza->TipoMascota_id = $row["TipoMascota_id"];
                $razas[] = $raza;
            }
        }
    
        return $razas;
    }
    public function getRazaPorNombre($raza_nombre) {
        $connection = $this->connect();
        $raza_nombre = $connection->real_escape_string($raza_nombre);
        $sql = "SELECT * FROM raza WHERE nombre = '{$raza_nombre}'";
        $result = $connection->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $raza = new Raza();
            $raza->id = $row["id"];
            $raza->nombre = $row["nombre"];
            $raza->TipoMascota_id = $row["TipoMascota_id"];
            return $raza;
        } else {
            return null;
        }
    } 
    public function getById($id) {
        $connection = $this->connect();
        $sql = "SELECT * FROM Raza WHERE id = '{$id}'";
        $result = $connection->query($sql);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $raza = new Raza();
            $raza->id = $row["id"];
            $raza->nombre = $row["nombre"];
            $raza->TipoMascota_id = $row["TipoMascota_id"];
            return $raza;
        } else {
            return null;
        }
    }    
    public function getIdByName($nombre) {
        $connection = $this->connect();
        $sql = "SELECT id FROM Raza WHERE nombre = '{$nombre}'";
        $result = $connection->query($sql);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row["id"];
        } else {
            return null;
        }
    }    
}
?>