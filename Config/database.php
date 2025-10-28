<?php
class Database {
    private $host = "localhost";
    private $db_name = "evaluacion_proyecto_sena";
    private $username = "root";
    private $password = "";
    public $conn;

    public function conectar() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name}",
                $this->username,
                $this->password
            );
            $this->conn->exec("set names utf8");
            // si no quieren el mensaje solo quiten esto no me jodan el codigo
            echo "✅ Conexión exitosa a la base de datos.";
        } catch (PDOException $exception) {
            echo "❌ Error de conexión: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>


