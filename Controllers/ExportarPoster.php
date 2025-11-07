<?php 
session_start(); 
if (!isset($_SESSION["id_evaluador"]) || $_SESSION["id_evaluador"] != 76) { 
    echo "<script>alert('Acceso restringido'); window.location='../Views/login.php';</script>"; 
    exit; 
} 
require_once "../Config/database.php"; 
$db = (new Database())->conectar(); 

// Consulta SOLO para calificaciones ponencia
$query = " 
    SELECT 
        p.id_proyecto,
        p.nombre_proyecto, 
        p.tipo_participacion,
        p.regional, 
        p.centro_formacion, 
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
    WHERE p.tipo_participacion = 'Ponencia'  -- ✅ SOLO PONENCIAS
    GROUP BY p.id_proyecto 
    ORDER BY p.nombre_proyecto ASC 
"; 

$stmt = $db->prepare($query); 
$stmt->execute(); 

// Headers Excel
header("Content-Type: application/vnd.ms-excel; charset=Windows-1252");
header("Content-Disposition: attachment; filename=Consolidado_Ponencias_SENA_" . date('Ymd_His') . ".xls"); 
header("Pragma: no-cache"); 
header("Expires: 0"); 

echo '<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=Windows-1252">
    <title>Consolidado Calificaciones Ponencias SENA</title>
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
        <th>Tipo Participacion</th>
        <th>Regional</th> 
        <th>Centro</th> 
        <th>Evaluadores</th> 
        <th>Cant. Eval</th>
        <th>Titulo Presentacion</th> 
        <th>Planteamiento Justificacion</th> 
        <th>Objetivos</th> 
        <th>Marco Teorico</th> 
        <th>Metodologia</th> 
        <th>Resultados Analisis</th> 
        <th>Conclusiones Aportes</th> 
        <th>Impacto Aplicabilidad</th> 
        <th>Innovacion Creatividad</th> 
        <th>Presentacion Oral</th> 
        <th>Manejo Publico</th> 
        <th>Apoyo Visual</th> 
        <th>Suma Total</th> 
        <th>Resultado Final</th> 
    </tr> 
'; 

while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) { 
    // Limpiar y formatear los textos
    $nombre_proyecto = limpiarTexto($r['nombre_proyecto']);
    $tipo_participacion = limpiarTexto($r['tipo_participacion']);
    $regional = limpiarTexto($r['regional']);
    $centro_formacion = limpiarTexto($r['centro_formacion']);
    $evaluadores = limpiarTexto($r['evaluadores']);
    
    echo "<tr> 
        <td>{$nombre_proyecto}</td> 
        <td>{$tipo_participacion}</td>
        <td>{$regional}</td> 
        <td>{$centro_formacion}</td> 
        <td>{$evaluadores}</td> 
        <td>{$r['cantidad_evaluadores']}</td>
        <td>{$r['titulo_presentacion']}</td> 
        <td>{$r['planteamiento_justificacion']}</td> 
        <td>{$r['objetivos']}</td> 
        <td>{$r['marco_teorico']}</td> 
        <td>{$r['metodologia']}</td> 
        <td>{$r['resultados_analisis']}</td> 
        <td>{$r['conclusiones_aportes']}</td> 
        <td>{$r['impacto_aplicabilidad']}</td> 
        <td>{$r['innovacion_creatividad']}</td> 
        <td>{$r['presentacion_oral']}</td> 
        <td>{$r['manejo_publico']}</td> 
        <td>{$r['apoyo_visual']}</td> 
        <td><b>{$r['total_suma']}</b></td> 
        <td><b>{$r['resultado_final']}</b></td> 
    </tr>"; 
} 

echo "</table></body></html>"; 
exit; 

// FUNCIÓN PARA LIMPIAR TEXTO
function limpiarTexto($texto) {
    if (empty($texto)) return '';
    
    $caracteresEspeciales = [
        'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u',
        'Á' => 'A', 'É' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ú' => 'U',
        'ñ' => 'n', 'Ñ' => 'N', 'ü' => 'u', 'Ü' => 'U'
    ];
    
    $texto = strtr($texto, $caracteresEspeciales);
    $texto = preg_replace('/[^\x20-\x7E]/', '', $texto);
    
    return trim($texto);
}
?>