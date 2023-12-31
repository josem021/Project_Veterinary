<?php
require_once("../controller/user.controller.php");
require_once("../controller/mascota.controller.php");
require_once("../controller/raza.controller.php");
require_once("../model/Raza.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nombre = $_POST["nombre"];
  $tipoMascota_id = $_POST["TipoMascota_id"];
  $raza_nombre = $_POST["raza"];
  $fechaNacimiento = $_POST["fechaNacimiento"];

  $mascota = new Mascota();
  $connection = new Conexion();
  $razaController = new RazaController();
  $mascotaController = new MascotaController();

  $mascota->nombre = $nombre;
  $mascota->FechaNacimiento = $fechaNacimiento;

  $raza_exists = $mascotaController->razaExistsNombre($raza_nombre);

  if (!$raza_exists) {
    $nuevaRaza = new Raza();
    $nuevaRaza->nombre = $raza_nombre;
    $nuevaRaza->TipoMascota_id = $tipoMascota_id;
    $razaController->create($nuevaRaza); 
    $mascota->Raza_id = $nuevaRaza->id;
  } else {
    $nuevaRaza = new Raza();
    $nuevaRaza->nombre = $raza_nombre;
    $nuevaRaza->TipoMascota_id = $tipoMascota_id;
    $razaController->create($nuevaRaza);
    $mascota->Raza_id = $nuevaRaza->id;
  }

  $mascota->TipoMascota_id = $tipoMascota_id; 

  if (!isset($_SESSION["User_id"])) {
    header("Location: ../login.php");
    exit;
  } else {
    $user_id = $_SESSION["User_id"];
  }

  $mascota->User_id = $user_id;

  $mascotaController->create($mascota);

  header("Location: mascotaIndex.php");
}
?>