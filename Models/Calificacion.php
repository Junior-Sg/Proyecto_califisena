<?php
class Calificacion {
    private $conn;
    private $table = "calificaciones";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function guardar($data) {
        $query = "INSERT INTO {$this->table} 
                 (id_asignacion, dominio_tematico, formato_poster, creatividad_diseno, introduccion, 
                  planteamiento_problema, objetivos, total, fecha_calificacion)
                  VALUES (:id_asignacion, :dominio_tematico, :formato_poster, :creatividad_diseno, 
                          :introduccion, :planteamiento_problema, :objetivos, :total, NOW())";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            ":id_asignacion" => $data["id_asignacion"],
            ":dominio_tematico" => $data["dominio_tematico"],
            ":formato_poster" => $data["formato_poster"],
            ":creatividad_diseno" => $data["creatividad_diseno"],
            ":introduccion" => $data["introduccion"],
            ":planteamiento_problema" => $data["planteamiento_problema"],
            ":objetivos" => $data["objetivos"],
            ":total" => $data["total"]
        ]);
    }
}
?>



