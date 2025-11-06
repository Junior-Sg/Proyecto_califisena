<?php
require_once "../Config/database.php";

$db = (new Database())->conectar();

// --- FILTRO DINÁMICO ---
$where = "";
$params = [];

if (isset($_GET["id_proyecto"])) {
    // Exportar solo ese proyecto con sus calificaciones
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
header("Content-Type: application/vnd.ms-excel");
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
$max_evaluadores = 2; // Por defecto

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
    
    // Actualizar el máximo de evaluadores si encontramos uno con 3
    if (count($proyectos[$id]["evaluadores"]) > $max_evaluadores) {
        $max_evaluadores = count($proyectos[$id]["evaluadores"]);
    }
}

// --- FUNCIÓN PARA LIMPIAR CARACTERES ---
function limpiarParaExcel($texto) {
    if (empty($texto)) return '';
    
    // Convertir caracteres especiales
    $texto = iconv('UTF-8', 'Windows-1252//TRANSLIT', $texto);
    
    // Si aún hay problemas, reemplazar manualmente
    $buscar = ['á', 'é', 'í', 'ó', 'ú', 'ñ', 'Á', 'É', 'Í', 'Ó', 'Ú', 'Ñ', 'ü', 'Ü'];
    $reemplazar = ['a', 'e', 'i', 'o', 'u', 'n', 'A', 'E', 'I', 'O', 'U', 'N', 'u', 'U'];
    $texto = str_replace($buscar, $reemplazar, $texto);
    
    return $texto;
}

// --- DISEÑO SENA ---
echo '
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
    <title>Reporte Calificaciones SENA</title>
    <style>
        table { width:95%; border-collapse:collapse; margin:auto; font-family:Arial; }
        th { background:#0C6C3C; color:white; padding:6px; font-size:12px; }
        td { border:1px solid #ccc; padding:5px; text-align:center; font-size:11px; }
        tr:nth-child(even) { background:#EAF3ED; }
        .titulo { text-align:center; font-size:20px; font-weight:bold; color:#0C6C3C; margin-bottom:15px; font-family:Arial; }
    </style>
</head>
<body>

<div class="titulo">Reporte de Calificaciones - SENA</div>

<table border="1">
<tr>
    <th>Proyecto</th>
    <th>Tipo</th>
    <th>Regional</th>
    <th>Centro</th>
    <th>Evaluador(es)</th>
';

// Generar columnas dinámicamente según la cantidad máxima de evaluadores
for ($i = 1; $i <= $max_evaluadores; $i++) {
    echo "    <th>Total Evaluador $i</th>\n";
}

echo '    <th>Resultado Final (Promedio)</th>
</tr>
';

foreach ($proyectos as $p) {
    // Limpiar textos para Excel
    $nombre = limpiarParaExcel($p['info']['nombre']);
    $tipo = limpiarParaExcel($p['info']['tipo']);
    $regional = limpiarParaExcel($p['info']['regional']);
    $centro = limpiarParaExcel($p['info']['centro']);
    
    $evaluadores = array_map('limpiarParaExcel', $p["evaluadores"]);
    $evaluadores_str = implode(" + ", $evaluadores);

    // Calcular promedio según cantidad de evaluadores
    $cantidad_evaluadores = count($p["totales"]);
    $suma_total = array_sum($p["totales"]);
    $final = round($suma_total / $cantidad_evaluadores, 2);

    echo "<tr>
        <td>{$nombre}</td>
        <td>{$tipo}</td>
        <td>{$regional}</td>
        <td>{$centro}</td>
        <td><b>{$evaluadores_str}</b></td>";

    // Mostrar totales de cada evaluador
    for ($i = 0; $i < $max_evaluadores; $i++) {
        if ($i < $cantidad_evaluadores) {
            echo "<td>{$p['totales'][$i]}</td>";
        } else {
            echo "<td></td>"; // Celda vacía si no hay evaluador
        }
    }

    echo "<td><b>{$final}</b></td>
    </tr>";
}

echo "</table></body></html>";
exit;
?>






