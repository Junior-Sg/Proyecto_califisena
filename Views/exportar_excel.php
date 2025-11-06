<?php
require_once "../Config/database.php";

$db = (new Database())->conectar();

// --- FILTRO DINÁMICO ---
$where = "";
$params = [];

if (isset($_GET["id_proyecto"])) {
    // Exportar solo ese proyecto con sus dos calificaciones
    $where = "WHERE p.id_proyecto = :id_proyecto";
    $params[":id_proyecto"] = $_GET["id_proyecto"];
    $modo = "proyecto";

} elseif (isset($_GET["id_evaluador"]) && $_GET["id_evaluador"] == 75) {
    // Exportar todo (solo admin evaluador 75)
    $modo = "todos";

} else {
    // Exportar solo mis calificaciones individuales
    $where = "WHERE e.id_evaluador = :id_evaluador";
    $params[":id_evaluador"] = $_GET["id_evaluador"];
    $modo = "individual";
}

// --- ENCABEZADOS ---
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=Calificaciones_SENA_" . date('Ymd_His') . ".xls");
header("Pragma: no-cache");
header("Expires: 0");

$query = "
    SELECT 
        c.id_asignacion,
        e.nombre AS evaluador,
        p.id_proyecto,
        p.nombre_proyecto,
        p.tipo_participacion,
        p.regional,
        p.centro_formacion,
        c.dominio_tematico,
        c.creatividad_diseno,
        c.planteamiento_problema,
        c.objetivos,
        c.pertinencia_impacto,
        c.metodologia,
        c.resultados,
        c.bibliografia,
        c.total,
        c.estado,
        c.fecha_calificacion
    FROM calificaciones c
    INNER JOIN asignaciones a ON c.id_asignacion = a.id_asignacion
    INNER JOIN evaluadores e ON a.id_evaluador = e.id_evaluador
    INNER JOIN proyectos p ON a.id_proyecto = p.id_proyecto
    $where
    ORDER BY p.nombre_proyecto ASC, e.nombre ASC
";

$stmt = $db->prepare($query);
$stmt->execute($params);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


// --- AGRUPAR POR PROYECTO PARA SACAR PROMEDIO FINAL ---
$proyectos = [];

foreach ($rows as $r) {
    $id = $r["id_proyecto"];

    if (!isset($proyectos[$id])) {
        $proyectos[$id] = [
            "info" => [
                "nombre" => $r["nombre_proyecto"],
                "tipo" => $r["tipo_participacion"],
                "regional" => $r["regional"],
                "centro" => $r["centro_formacion"]
            ],
            "evaluadores" => [],
            "totales" => []
        ];
    }

    $proyectos[$id]["evaluadores"][] = $r["evaluador"];
    $proyectos[$id]["totales"][] = $r["total"];
}


// --- DISEÑO SENA ---
echo "
<html>
<head>
<meta charset='UTF-8'>
<style>
table { width:95%; border-collapse:collapse; margin:auto; font-family:'Segoe UI'; }
th { background:#0C6C3C; color:white; padding:6px; }
td { border:1px solid #ccc; padding:5px; text-align:center; }
tr:nth-child(even) { background:#EAF3ED; }
.titulo { text-align:center; font-size:20px; font-weight:bold; color:#0C6C3C; margin-bottom:15px; }
</style>
</head>
<body>

<div class='titulo'>📊 Reporte de Calificaciones - SENA</div>

<table border='1'>
<tr>
    <th>Proyecto</th>
    <th>Tipo</th>
    <th>Regional</th>
    <th>Centro</th>
    <th>Evaluador(es)</th>
    <th>Total Evaluador 1</th>
    <th>Total Evaluador 2</th>
    <th>Resultado Final (Promedio)</th>
</tr>
";

foreach ($proyectos as $p) {

    $evaluadores = implode(" + ", $p["evaluadores"]);

    $t1 = $p["totales"][0] ?? 0;
    $t2 = $p["totales"][1] ?? 0;
    $final = ($t1 + $t2) / 2;

    echo "<tr>
        <td>{$p['info']['nombre']}</td>
        <td>{$p['info']['tipo']}</td>
        <td>{$p['info']['regional']}</td>
        <td>{$p['info']['centro']}</td>
        <td><b>{$evaluadores}</b></td>
        <td>{$t1}</td>
        <td>{$t2}</td>
        <td><b>{$final}</b></td>
    </tr>";
}

echo "</table></body></html>";
exit;
?>









