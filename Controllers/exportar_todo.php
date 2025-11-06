<?php 
session_start(); 
if (!isset($_SESSION["id_evaluador"]) || $_SESSION["id_evaluador"] != 76) { 
    echo "<script>alert('Acceso restringido'); window.location='../Views/login.php';</script>"; 
    exit; 
} 
require_once "../Config/database.php"; 
$db = (new Database())->conectar(); 

// Consulta corregida: contar evaluadores reales por proyecto
$query = " 
    SELECT 
        p.id_proyecto,
        p.nombre_proyecto, 
        p.regional, 
        p.centro_formacion, 
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
    GROUP BY p.id_proyecto 
    ORDER BY p.nombre_proyecto ASC 
"; 

$stmt = $db->prepare($query); 
$stmt->execute(); 

// Headers Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Consolidado_Calificaciones_SENA.xls"); 
header("Pragma: no-cache"); 
header("Expires: 0"); 

echo '<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
    <title>Consolidado Calificaciones SENA</title>
    <style>
        th { 
            background:#0C6C3C; 
            color:white; 
            font-weight:bold; 
            padding:6px; 
            font-family: Arial;
            font-size: 12px;
        } 
        td { 
            border:1px solid #bbb; 
            padding:5px; 
            text-align:center; 
            font-family: Arial;
            font-size: 11px;
        } 
        tr:nth-child(even) { 
            background:#EAF3ED; 
        }
    </style> 
</head> 
<body> 
    <table border="1" cellpadding="3" cellspacing="0" width="100%"> 
    <tr> 
        <th>Proyecto</th> 
        <th>Regional</th> 
        <th>Centro</th> 
        <th>Evaluadores</th> 
        <th>Cant. Eval</th>
        <th>Dominio</th> 
        <th>Creatividad</th> 
        <th>Problema</th> 
        <th>Pertinencia / Impacto</th> 
        <th>Objetivos</th> 
        <th>Metodologia</th> 
        <th>Resultados</th> 
        <th>Bibliografia</th> 
        <th>Suma Total</th> 
        <th>Resultado Final</th> 
    </tr> 
'; 

while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) { 
    // Limpiar y formatear los textos
    $nombre_proyecto = iconv('UTF-8', 'Windows-1252//TRANSLIT', $r['nombre_proyecto']);
    $regional = iconv('UTF-8', 'Windows-1252//TRANSLIT', $r['regional']);
    $centro_formacion = iconv('UTF-8', 'Windows-1252//TRANSLIT', $r['centro_formacion']);
    $evaluadores = iconv('UTF-8', 'Windows-1252//TRANSLIT', $r['evaluadores']);
    
    echo "<tr> 
        <td>{$nombre_proyecto}</td> 
        <td>{$regional}</td> 
        <td>{$centro_formacion}</td> 
        <td>{$evaluadores}</td> 
        <td>{$r['cantidad_evaluadores']}</td>
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