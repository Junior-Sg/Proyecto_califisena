<?php
class Admin {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    /* === 📋 PROYECTOS === */
    public function listarProyectos() {
        $query = "SELECT * FROM proyectos ORDER BY id_proyecto ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerProyectoPorId($id) {
        $query = "SELECT * FROM proyectos WHERE id_proyecto = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function crearProyecto($data) {
        $query = "INSERT INTO proyectos (nombre_proyecto, tipo_participacion, regional, centro_formacion, fecha_creacion)
                  VALUES (:nombre_proyecto, :tipo_participacion, :regional, :centro_formacion, NOW())";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($data);
    }

    public function editarProyecto($id, $data) {
        $query = "UPDATE proyectos SET 
                    nombre_proyecto = :nombre_proyecto,
                    tipo_participacion = :tipo_participacion,
                    regional = :regional,
                    centro_formacion = :centro_formacion
                  WHERE id_proyecto = :id_proyecto";
        $stmt = $this->conn->prepare($query);
        $data[":id_proyecto"] = $id;
        return $stmt->execute($data);
    }

    /* === 👥 ASIGNACIONES === */
    public function listarAsignaciones() {
        $query = "SELECT 
                    a.id_asignacion,
                    e.nombre AS evaluador,
                    p.nombre_proyecto
                  FROM asignaciones a
                  INNER JOIN evaluadores e ON a.id_evaluador = e.id_evaluador
                  INNER JOIN proyectos p ON a.id_proyecto = p.id_proyecto
                  ORDER BY a.id_asignacion ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerAsignacionPorId($id) {
        $query = "SELECT * FROM asignaciones WHERE id_asignacion = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function crearAsignacion($data) {
        $query = "INSERT INTO asignaciones (id_evaluador, id_proyecto, fecha_asignacion)
                  VALUES (:id_evaluador, :id_proyecto, NOW())";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($data);
    }

    public function editarAsignacion($id, $data) {
        $query = "UPDATE asignaciones 
                  SET id_evaluador = :id_evaluador,
                      id_proyecto = :id_proyecto
                  WHERE id_asignacion = :id_asignacion";
        $stmt = $this->conn->prepare($query);
        $data[":id_asignacion"] = $id;
        return $stmt->execute($data);
    }

    /* === 🔹 Listar Evaluadores para seleccionar === */
    public function listarEvaluadores() {
        $query = "SELECT id_evaluador, nombre FROM evaluadores ORDER BY nombre ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>





