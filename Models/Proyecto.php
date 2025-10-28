<?php
class Proyecto {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // esta funcion es para caalificar porque es mas fachero asi
    public function listarPorEvaluador($id_evaluador) {
        $query = "
            SELECT 
                p.id_proyecto, 
                p.nombre_proyecto, 
                p.regional, 
                p.centro_formacion,
                p.estado, 
                a.id_asignacion
            FROM asignaciones a
            INNER JOIN proyectos p ON a.id_proyecto = p.id_proyecto
            WHERE a.id_evaluador = :id_evaluador
              AND a.id_asignacion NOT IN (SELECT id_asignacion FROM calificaciones)
            ORDER BY p.nombre_proyecto ASC
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_evaluador", $id_evaluador, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //  esta funcion es para perfil porque si no pregunten 
    public function listarTodosPorEvaluador($id_evaluador) {
        $query = "
            SELECT 
                p.id_proyecto,
                p.nombre_proyecto,
                p.regional,
                p.centro_formacion,
                a.id_asignacion,
                CASE WHEN c.id_calificacion IS NOT NULL THEN 1 ELSE 0 END AS calificado
            FROM asignaciones a
            INNER JOIN proyectos p ON a.id_proyecto = p.id_proyecto
            LEFT JOIN calificaciones c ON c.id_asignacion = a.id_asignacion
            WHERE a.id_evaluador = :id_evaluador
            ORDER BY calificado ASC, p.nombre_proyecto ASC
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_evaluador", $id_evaluador, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

