<?php
session_start();
if (!isset($_SESSION["id_evaluador"]) || $_SESSION["id_evaluador"] != 76) {
    echo "<script>alert('Acceso restringido'); window.location='../Views/login.php';</script>";
    exit;
}

require_once "../Config/database.php";
$db = (new Database())->conectar();

// Consulta: agrupa las dos calificaciones
$query = "
    SELECT 
        p.nombre_proyecto,
        p.regional,
        p.centro_formacion,
        GROUP_CONCAT(e.nombre SEPARATOR ' + ') AS evaluadores,
        SUM(c.dominio_tematico) AS dominio_tematico,
        SUM(c.creatividad_diseno) AS creatividad_diseno,
        SUM(c.planteamiento_problema) AS planteamiento_problema,
        SUM(c.pertinencia_impacto) AS pertinencia_impacto,
        SUM(c.objetivos) AS objetivos,
        SUM(c.metodologia) AS metodologia,
        SUM(c.resultados) AS resultados,
        SUM(c.bibliografia) AS bibliografia,
        SUM(c.total) AS total_suma,  
        ROUND((SUM(c.total) / 2), 2) AS resultado_final
    FROM calificaciones c
    INNER JOIN asignaciones a ON c.id_asignacion = a.id_asignacion
    INNER JOIN evaluadores e ON a.id_evaluador = e.id_evaluador
    INNER JOIN proyectos p ON a.id_proyecto = p.id_proyecto
    GROUP BY p.id_proyecto
    ORDER BY p.nombre_proyecto ASC
";

$stmt = $db->prepare($query);
$stmt->execute();

// Headers Excel
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=Consolidado_Calificaciones_SENA.xls");
header("Pragma: no-cache");
header("Expires: 0");

// Diseño Excel
echo "
<html>
<head>
<meta charset='UTF-8'>
<style>
th { background:#0C6C3C; color:white; font-weight:bold; padding:6px; }
td { border:1px solid #bbb; padding:5px; text-align:center; }
tr:nth-child(even) { background:#EAF3ED; }
</style>
</head>
<body>
<h2 style='text-align:center; color:#0C6C3C;'>Consolidado de Calificaciones - SENA</h2>

<table border='1'>
<tr>
    <th>Proyecto</th>
    <th>Regional</th>
    <th>Centro</th>
    <th>Evaluadores</th>
    <th>Dominio</th>
    <th>Creatividad</th>
    <th>Problema</th>
    <th>Pertinencia / Impacto</th>
    <th>Objetivos</th>
    <th>Metodología</th>
    <th>Resultados</th>
    <th>Bibliografía</th>
    <th>Suma Total</th>
    <th>Resultado Final</th>
</tr>
";

while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>
        <td>{$r['nombre_proyecto']}</td>
        <td>{$r['regional']}</td>
        <td>{$r['centro_formacion']}</td>
        <td>{$r['evaluadores']}</td>
        <td>{$r['dominio_tematico']}</td>
        <td>{$r['creatividad_diseno']}</td>
        <td>{$r['planteamiento_problema']}</td>
        <td>{$r['pertinencia_impacto']}</td>
        <td>{$r['objetivos']}</td>
        <td>{$r['metodologia']}</td>
        <td>{$r['resultados']}</td>
        <td>{$r['bibliografia']}</td>
        <td><b>{$r['total_suma']}</b></td>
        <td><b>{$r['resultado_final']}</b></td>
    </tr>";
}

echo "</table></body></html>";
exit;
?>
