<?php
class Calificacion {
    private $conn;
    private $table = "calificaciones";

    public function __construct($db) {
        $this->conn = $db;
    }

   public function guardar($data) {
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
        ":pertinencia_impacto" => $data["pertinencia_impacto"], // ✅ Nuevo
        ":metodologia" => $data["metodologia"],
        ":resultados" => $data["resultados"],
        ":bibliografia" => $data["bibliografia"],
        ":total" => $data["total"],
        ":estado" => $data["estado"]
    ]);


        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            ":id_asignacion" => $data["id_asignacion"],
            ":dominio_tematico" => $data["dominio_tematico"],
            ":formato_poster" => $data["formato_poster"],
            ":creatividad_diseno" => $data["creatividad_diseno"],
            ":introduccion" => $data["introduccion"],
            ":planteamiento_problema" => $data["planteamiento_problema"],
            ":objetivos" => $data["objetivos"],
            ":referente_teorico" => $data["referente_teorico"],
            ":metodologia" => $data["metodologia"],
            ":resultados" => $data["resultados"],
            ":bibliografia" => $data["bibliografia"],
            ":total" => $data["total"],
            ":estado" => $data["estado"]
        ]);
    }
}
?>




