<?php
class Proyecto {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    //  Proyectos pendientes de calificar (para calificar.php)
    public function listarPorEvaluador($id_evaluador) {
        $query = "
            SELECT 
                p.id_proyecto, 
                p.nombre_proyecto, 
                p.tipo_participacion,
                p.regional, 
                p.centro_formacion,
                a.id_asignacion
            FROM asignaciones a
            INNER JOIN proyectos p ON a.id_proyecto = p.id_proyecto
            WHERE a.id_evaluador = :id_evaluador
              AND a.id_asignacion NOT IN (
                   SELECT id_asignacion FROM calificaciones
                   UNION
                   SELECT id_asignacion FROM calificaciones_ponencia
                )
            ORDER BY p.nombre_proyecto ASC
        ";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_evaluador", $id_evaluador, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //  Proyectos asignados (para perfil.php)
    public function listarTodosPorEvaluador($id_evaluador) {
        $query = "
            SELECT 
                p.id_proyecto,
                p.nombre_proyecto,
                p.tipo_participacion,
                p.regional,
                p.centro_formacion,
                a.id_asignacion,
                CASE 
                  WHEN c.id_calificacion IS NOT NULL 
                     OR cp.id_calificacion_ponencia IS NOT NULL 
                  THEN 1 ELSE 0 
                END AS calificado
            FROM asignaciones a
            INNER JOIN proyectos p ON a.id_proyecto = p.id_proyecto
            LEFT JOIN calificaciones c ON c.id_asignacion = a.id_asignacion
            LEFT JOIN calificaciones_ponencia cp ON cp.id_asignacion = a.id_asignacion
            WHERE a.id_evaluador = :id_evaluador
            ORDER BY calificado ASC, p.nombre_proyecto ASC
        ";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_evaluador", $id_evaluador, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //  Obtener datos del proyecto (para mostrar info si se requiere)
    public function obtenerProyectoPorAsignacion($id_asignacion) {
        $query = "
            SELECT 
                p.id_proyecto,
                p.nombre_proyecto,
                p.tipo_participacion,
                p.regional,
                p.centro_formacion
            FROM asignaciones a
            INNER JOIN proyectos p ON a.id_proyecto = p.id_proyecto
            WHERE a.id_asignacion = :id_asignacion
            LIMIT 1
        ";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_asignacion", $id_asignacion, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
