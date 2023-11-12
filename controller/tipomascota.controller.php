<?php
require_once(__DIR__ ."/../conexion.php");
require_once(__DIR__ ."/../model/TipoMascota.php");

class TipoMascotaController extends Conexion {
    public function create (TipoMascota $tipoMascota) {
        $connection = $this->connect(); 
        $sql = "INSERT INTO TipoMascota (nombre, EdadAdulto)
        VALUES ('{$tipoMascota->nombre}', '{$tipoMascota->EdadAdulto}'
        ";
        $result = $connection->query($sql);
        return $result;
    }
    public function update (TipoMascota $tipoMascota) {
        $connection = $this->connect();
        $sql = "UPDATE TipoMascota SET nombre = '{$tipoMascota->nombre}', '{$tipoMascota->EdadAdulto}'
        WHERE id = {$tipoMascota->id}'";

        $result = $connection->query($sql);
        return $result;
    }
    public function delete (TipoMascota $tipoMascota) {
        $connection = $this->connect();
        $sql = "DELETE FROM TipoMascota WHERE id = '{$tipoMascota->id}'";
        $result = $connection->query($sql);
        return $result;
    }
    public function read () {
        $connection = $this->connect();
        $tipoMascotas = [];

        $sql = "SELECT * FROM TipoMascota";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $tipoMascota = new TipoMascota();
                $tipoMascota->id = $row["id"];
                $tipoMascota->nombre = $row["nombre"];
                $tipoMascota->EdadAdulto = $row["EdadAdulto"];
                $tipoMascotas[] = $tipoMascota;
            }
        }
        return $tipoMascotas;

    }
}
?>