<?php
require_once(__DIR__ ."/../conexion.php");
require_once(__DIR__ ."/../model/User.php");

class User_controller extends Conexion {
    public function create (User $user) {

        $connection = $this->connect();
        $sql = "INSERT INTO User (username, email, password, Role_id) 
        VALUES ('{$user->username}', '{$user->email}', '{$user->password}', '{$user->Role_id}')";
        
        $result = $connection->query($sql);

        return $result;
    }
    public function update(User $usuario) {
        $conexión = $this->connect();
        $actualizaciones = [];
    
        if ($usuario->username !== null) {
            $actualizaciones[] = "username='{$usuario->username}'";
        }
    
        if ($usuario->email !== null) {
            $actualizaciones[] = "email='{$usuario->email}'";
        }
    
        if ($usuario->password !== null) {
            $actualizaciones[] = "password='{$usuario->password}'";
        }
    
        if (!empty($actualizaciones)) {
            $sql = "UPDATE User SET " . implode(', ', $actualizaciones) . " WHERE id='{$usuario->id}'";
            $resultado = $conexión->query($sql);
    
            if ($resultado) {
                header('Location: ../users_registered.php');
            } else {
                echo "Error al actualizar al usuario";
            }
        }
    }
    
    
    public function delete (User $user) {
        $connection = $this->connect();
        $sql = "DELETE FROM User Where id='{$user->id}'";
        $result = $connection->query($sql);
        return $result;
    }

    public function GetID($id) {
        $connection = $this->connect();
        $sql = "SELECT * FROM User WHERE id='{$id}'";
        $result = $connection->query($sql);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user = new User();
            $user->id = $row['id'];
            $user->username = $row['username'];
            $user->password = $row['password'];
            $user->email = $row['email'];
    
            return $user;
        } else {
            return null;
        }
    }
    
}

?>