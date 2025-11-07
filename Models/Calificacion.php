<?php
class Calificacion {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    //  VERIFICAR SI YA EXISTE CALIFICACIÓN
    public function existeCalificacion($id_asignacion) {
        $query = "SELECT COUNT(*) FROM calificaciones WHERE id_asignacion = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id_asignacion]);
        return $stmt->fetchColumn() > 0;
    }

    //  VERIFICAR SI YA EXISTE CALIFICACIÓN DE PONENCIA
    public function existeCalificacionPonencia($id_asignacion) {
        $query = "SELECT COUNT(*) FROM calificaciones_ponencia WHERE id_asignacion = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id_asignacion]);
        return $stmt->fetchColumn() > 0;
    }

    //  OBTENER TIPO DE PARTICIPACIÓN DEL PROYECTO
    public function obtenerTipoProyecto($id_proyecto) {
        $query = "SELECT tipo_participacion FROM proyectos WHERE id_proyecto = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id_proyecto]);
        return $stmt->fetchColumn();
    }

    //  OBTENER CALIFICACIONES NORMALES PARA EXPORTAR
    public function obtenerCalificacionesNormales($id_evaluador = null, $id_proyecto = null) {
        $where = "";
        $params = [];

        if ($id_proyecto) {
            $where = "WHERE p.id_proyecto = :id_proyecto";
            $params[":id_proyecto"] = $id_proyecto;
        } elseif ($id_evaluador) {
            $where = "WHERE e.id_evaluador = :id_evaluador";
            $params[":id_evaluador"] = $id_evaluador;
        }

        $query = "
            SELECT 
                p.id_proyecto,
                p.nombre_proyecto, 
                p.regional, 
                p.centro_formacion,
                p.tipo_participacion,
                GROUP_CONCAT(e.nombre SEPARATOR ' + ') AS evaluadores,
                COUNT(DISTINCT e.id_evaluador) AS cantidad_evaluadores,
                SUM(c.dominio_tematico) AS dominio_tematico, 
                SUM(c.creatividad_diseno) AS creatividad_diseno, 
                SUM(c.planteamiento_problema) AS planteamiento_problema, 
                SUM(c.pertinencia_impacto) AS pertinencia_impacto, 
                SUM(c.objetivos) AS objetivos, 
                SUM(c.metodologia) AS metodologia, 
                SUM(c.resultados) AS resultados, 
                SUM(c.bibliografia) AS bibliografia, 
                SUM(c.total) AS total_suma,
                ROUND((SUM(c.total) / COUNT(DISTINCT e.id_evaluador)), 2) AS resultado_final
            FROM calificaciones c 
            INNER JOIN asignaciones a ON c.id_asignacion = a.id_asignacion 
            INNER JOIN evaluadores e ON a.id_evaluador = e.id_evaluador 
            INNER JOIN proyectos p ON a.id_proyecto = p.id_proyecto 
            $where
            GROUP BY p.id_proyecto 
            ORDER BY p.nombre_proyecto ASC 
        ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //  OBTENER CALIFICACIONES PONENCIA PARA EXPORTAR
    public function obtenerCalificacionesPonencia($id_evaluador = null, $id_proyecto = null) {
        $where = "";
        $params = [];

        if ($id_proyecto) {
            $where = "WHERE p.id_proyecto = :id_proyecto";
            $params[":id_proyecto"] = $id_proyecto;
        } elseif ($id_evaluador) {
            $where = "WHERE e.id_evaluador = :id_evaluador";
            $params[":id_evaluador"] = $id_evaluador;
        }

        $query = "
            SELECT 
                p.id_proyecto,
                p.nombre_proyecto, 
                p.regional, 
                p.centro_formacion,
                p.tipo_participacion,
                GROUP_CONCAT(e.nombre SEPARATOR ' + ') AS evaluadores,
                COUNT(DISTINCT e.id_evaluador) AS cantidad_evaluadores,
                SUM(cp.pon_titulo_presentacion) AS titulo_presentacion, 
                SUM(cp.pon_planteamiento_justificacion) AS planteamiento_justificacion, 
                SUM(cp.pon_objetivos) AS objetivos, 
                SUM(cp.pon_marco_teorico) AS marco_teorico, 
                SUM(cp.pon_metodologia) AS metodologia, 
                SUM(cp.pon_resultados_analisis) AS resultados_analisis, 
                SUM(cp.pon_conclusiones_aportes) AS conclusiones_aportes, 
                SUM(cp.pon_impacto_aplicabilidad) AS impacto_aplicabilidad, 
                SUM(cp.pon_innovacion_creatividad) AS innovacion_creatividad, 
                SUM(cp.pon_presentacion_oral) AS presentacion_oral, 
                SUM(cp.pon_manejo_publico) AS manejo_publico, 
                SUM(cp.pon_apoyo_visual) AS apoyo_visual, 
                SUM(cp.pon_total) AS total_suma,
                ROUND((SUM(cp.pon_total) / COUNT(DISTINCT e.id_evaluador)), 2) AS resultado_final
            FROM calificaciones_ponencia cp 
            INNER JOIN asignaciones a ON cp.id_asignacion = a.id_asignacion 
            INNER JOIN evaluadores e ON a.id_evaluador = e.id_evaluador 
            INNER JOIN proyectos p ON a.id_proyecto = p.id_proyecto 
            $where
            GROUP BY p.id_proyecto 
            ORDER BY p.nombre_proyecto ASC 
        ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function guardar($data) {
        try {
            $query = "INSERT INTO calificaciones 
            (id_asignacion, dominio_tematico, creatividad_diseno, planteamiento_problema, objetivos, pertinencia_impacto, metodologia, resultados, bibliografia, total, estado, fecha_calificacion)
            VALUES (:id_asignacion, :dominio_tematico, :creatividad_diseno, :planteamiento_problema, :objetivos, :pertinencia_impacto, :metodologia, :resultados, :bibliografia, :total, :estado, NOW())";

            $stmt = $this->conn->prepare($query);

            return $stmt->execute([
                ":id_asignacion" => $data["id_asignacion"],
                ":dominio_tematico" => $data["dominio_tematico"],
                ":creatividad_diseno" => $data["creatividad_diseno"],
                ":planteamiento_problema" => $data["planteamiento_problema"],
                ":objetivos" => $data["objetivos"],
                ":pertinencia_impacto" => $data["pertinencia_impacto"],
                ":metodologia" => $data["metodologia"],
                ":resultados" => $data["resultados"],
                ":bibliografia" => $data["bibliografia"],
                ":total" => $data["total"],
                ":estado" => $data["estado"]
            ]);
        } catch (PDOException $e) {
            error_log("Error DB en guardar(): " . $e->getMessage());
            return false;
        }
    }

    public function guardarPonencia($data) {
        try {
            $query = "INSERT INTO calificaciones_ponencia 
            (id_asignacion, pon_titulo_presentacion, pon_planteamiento_justificacion, pon_objetivos, pon_marco_teorico, pon_metodologia, pon_resultados_analisis, pon_conclusiones_aportes, pon_impacto_aplicabilidad, pon_innovacion_creatividad, pon_presentacion_oral, pon_manejo_publico, pon_apoyo_visual, pon_total, pon_estado, fecha_calificacion)
            VALUES (:id_asignacion, :pon_titulo_presentacion, :pon_planteamiento_justificacion, :pon_objetivos, :pon_marco_teorico, :pon_metodologia, :pon_resultados_analisis, :pon_conclusiones_aportes, :pon_impacto_aplicabilidad, :pon_innovacion_creatividad, :pon_presentacion_oral, :pon_manejo_publico, :pon_apoyo_visual, :pon_total, :pon_estado, NOW())";

            $stmt = $this->conn->prepare($query);

            return $stmt->execute([
                ":id_asignacion" => $data["id_asignacion"],
                ":pon_titulo_presentacion" => $data["pon_titulo_presentacion"],
                ":pon_planteamiento_justificacion" => $data["pon_planteamiento_justificacion"],
                ":pon_objetivos" => $data["pon_objetivos"],
                ":pon_marco_teorico" => $data["pon_marco_teorico"],
                ":pon_metodologia" => $data["pon_metodologia"],
                ":pon_resultados_analisis" => $data["pon_resultados_analisis"],
                ":pon_conclusiones_aportes" => $data["pon_conclusiones_aportes"],
                ":pon_impacto_aplicabilidad" => $data["pon_impacto_aplicabilidad"],
                ":pon_innovacion_creatividad" => $data["pon_innovacion_creatividad"],
                ":pon_presentacion_oral" => $data["pon_presentacion_oral"],
                ":pon_manejo_publico" => $data["pon_manejo_publico"],
                ":pon_apoyo_visual" => $data["pon_apoyo_visual"],
                ":pon_total" => $data["pon_total"],
                ":pon_estado" => $data["pon_estado"]
            ]);
        } catch (PDOException $e) {
            error_log("Error DB en guardarPonencia(): " . $e->getMessage());
            return false;
        }
    }
}
?>