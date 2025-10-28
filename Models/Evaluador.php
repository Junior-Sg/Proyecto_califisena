<?php
class Evaluador {
    private $conn;
    private $table = "evaluadores";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function verificarLogin($usuario, $contrasena) {
        $query = "SELECT * FROM {$this->table} WHERE usuario = :usuario";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":usuario", $usuario);
        $stmt->execute();
        $evaluador = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($evaluador && $evaluador['contrasena_hash'] == $contrasena) {
            return $evaluador;
        }
        return false;
    }
}
?>



