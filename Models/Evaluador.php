<?php
class Evaluador {
    private $conn;
    private $table = "evaluadores";

    public function __construct($db) {
        $this->conn = $db;
    }

    // ✅ Versión para contraseñas sin encriptar
    public function verificarLogin($usuario, $contrasena) {
        $query = "SELECT * FROM {$this->table} WHERE usuario = :usuario AND contrasena_hash = :contrasena";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":usuario", $usuario);
        $stmt->bindParam(":contrasena", $contrasena);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
        // ✅ Crear nuevo evaluador
    public function crearEvaluador($data) {
        $query = "INSERT INTO {$this->table} (nombre, usuario, contrasena_hash) 
                  VALUES (:nombre, :usuario, :contrasena_hash)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nombre", $data["nombre"]);
        $stmt->bindParam(":usuario", $data["usuario"]);
        $stmt->bindParam(":contrasena_hash", $data["contrasena_hash"]);

        return $stmt->execute();
    }

    // ✅ Listar todos los evaluadores
    public function listarEvaluadores() {
        $query = "SELECT id_evaluador, nombre, usuario FROM {$this->table}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}

?>




