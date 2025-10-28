<?php
require_once "../Config/database.php";

$db = (new Database())->conectar();

// Filtro dinámico
$where = "";
$params = [];

if (isset($_GET["id_evaluador"])) {
    $where = "WHERE e.id_evaluador = :id_evaluador";
    $params[":id_evaluador"] = $_GET["id_evaluador"];
} elseif (isset($_GET["id_proyecto"])) {
    $where = "WHERE p.id_proyecto = :id_proyecto";
    $params[":id_proyecto"] = $_GET["id_proyecto"];
}

// Encabezados Excel
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=Calificaciones_SENA_" . date('Ymd_His') . ".xls");

$query = "
    SELECT 
        e.nombre AS evaluador,
        p.nombre_proyecto,
        p.regional,
        p.centro_formacion,
        c.dominio_tematico,
        c.formato_poster,
        c.creatividad_diseno,
        c.introduccion,
        c.planteamiento_problema,
        c.objetivos,
        c.total,
        c.fecha_calificacion
    FROM calificaciones c
    INNER JOIN asignaciones a ON c.id_asignacion = a.id_asignacion
    INNER JOIN evaluadores e ON a.id_evaluador = e.id_evaluador
    INNER JOIN proyectos p ON a.id_proyecto = p.id_proyecto
    $where
    ORDER BY e.nombre ASC
";

$stmt = $db->prepare($query);
$stmt->execute($params);

// Generar tabla
echo "<table border='1' style='border-collapse:collapse; width:100%; font-family:Segoe UI;'>";
echo "<tr style='background-color:#0c6c3c; color:white;'>
        <th>Evaluador</th>
        <th>Proyecto</th>
        <th>Regional</th>
        <th>Centro Formación</th>
        <th>Dominio</th>
        <th>Formato</th>
        <th>Creatividad</th>
        <th>Introducción</th>
        <th>Problema</th>
        <th>Objetivos</th>
        <th>Total</th>
        <th>Fecha</th>
      </tr>";

while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>
            <td>{$r['evaluador']}</td>
            <td>{$r['nombre_proyecto']}</td>
            <td>{$r['regional']}</td>
            <td>{$r['centro_formacion']}</td>
            <td>{$r['dominio_tematico']}</td>
            <td>{$r['formato_poster']}</td>
            <td>{$r['creatividad_diseno']}</td>
            <td>{$r['introduccion']}</td>
            <td>{$r['planteamiento_problema']}</td>
            <td>{$r['objetivos']}</td>
            <td>{$r['total']}</td>
            <td>{$r['fecha_calificacion']}</td>
          </tr>";
}
echo "</table>";
?>



