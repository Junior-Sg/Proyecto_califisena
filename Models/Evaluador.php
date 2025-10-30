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
}
?>




