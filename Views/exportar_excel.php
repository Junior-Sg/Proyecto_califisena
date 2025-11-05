<?php
require_once "../Config/database.php";

$db = (new Database())->conectar();

// --- Filtro dinámico ---
$where = "";
$params = [];

if (isset($_GET["id_evaluador"])) {
    $where = "WHERE e.id_evaluador = :id_evaluador";
    $params[":id_evaluador"] = $_GET["id_evaluador"];
} elseif (isset($_GET["id_proyecto"])) {
    $where = "WHERE p.id_proyecto = :id_proyecto";
    $params[":id_proyecto"] = $_GET["id_proyecto"];
}

// --- Encabezados Excel ---
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=Calificaciones_SENA_" . date('Ymd_His') . ".xls");
header("Pragma: no-cache");
header("Expires: 0");

// --- Consulta con todos los campos ---
$query = "
    SELECT 
        e.nombre AS evaluador,
        p.nombre_proyecto,
        p.tipo_participacion,
        p.regional,
        p.centro_formacion,
        c.dominio_tematico,
        c.formato_poster,
        c.creatividad_diseno,
        c.introduccion,
        c.planteamiento_problema,
        c.objetivos,
        c.referente_teorico,
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
    ORDER BY e.nombre ASC
";

$stmt = $db->prepare($query);
$stmt->execute($params);

// --- Diseño HTML con estilo verde SENA ---
echo "
<html>
<head>
<meta charset='UTF-8'>
<style>
body {
  font-family: 'Segoe UI', Arial, sans-serif;
  background-color: #ffffff;
  color: #333;
}

.header-container {
  text-align: center;
  margin-top: 10px;
  margin-bottom: 20px;
}

.logo {
  width: 90px;
  display: block;
  margin: 0 auto 10px auto;
}

.titulo-reporte {
  font-size: 22px;
  font-weight: bold;
  color: #0C6C3C;
  text-align: center;
  margin: 5px auto;
  border-bottom: 3px solid #0C6C3C;
  display: inline-block;
  padding-bottom: 5px;
}

table {
  width: 95%;
  margin: auto;
  border-collapse: collapse;
  font-size: 13px;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

th {
  background-color: #0C6C3C;
  color: white;
  padding: 8px;
  text-align: center;
  font-weight: 600;
  border: 1px solid #d1e0d4;
}

td {
  border: 1px solid #d1e0d4;
  padding: 6px;
  text-align: center;
}

tr:nth-child(even) {
  background-color: #EAF3ED;
}

tr:hover {
  background-color: #CFE8D9;
}

tfoot td {
  font-weight: bold;
  background-color: #CDE4D3;
}
</style>
</head>
<body>

<div class='header-container'>
  <img src='https://upload.wikimedia.org/wikipedia/commons/1/1a/Logo_SENA.svg' class='logo' alt='Logo SENA'>
  <div class='titulo-reporte'>📊 Reporte de Calificaciones - SENA</div>
</div>

<table border='1'>
<tr>
    <th>Evaluador</th>
    <th>Proyecto</th>
    <th>Tipo Participación</th>
    <th>Regional</th>
    <th>Centro de Formación</th>
    <th>Dominio Temático</th>
    <th>Formato Póster</th>
    <th>Creatividad y Diseño</th>
    <th>Introducción</th>
    <th>Planteamiento del Problema</th>
    <th>Objetivos</th>
    <th>Referente Teórico</th>
    <th>Metodología</th>
    <th>Resultados</th>
    <th>Bibliografía</th>
    <th>Total</th>
    <th>Estado</th>
    <th>Fecha Calificación</th>
</tr>
";

// --- Cuerpo dinámico ---
while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>
        <td>".htmlspecialchars($r['evaluador'])."</td>
        <td>".htmlspecialchars($r['nombre_proyecto'])."</td>
        <td>".htmlspecialchars($r['tipo_participacion'])."</td>
        <td>".htmlspecialchars($r['regional'])."</td>
        <td>".htmlspecialchars($r['centro_formacion'])."</td>
        <td>{$r['dominio_tematico']}</td>
        <td>{$r['formato_poster']}</td>
        <td>{$r['creatividad_diseno']}</td>
        <td>{$r['introduccion']}</td>
        <td>{$r['planteamiento_problema']}</td>
        <td>{$r['objetivos']}</td>
        <td>{$r['referente_teorico']}</td>
        <td>{$r['metodologia']}</td>
        <td>{$r['resultados']}</td>
        <td>{$r['bibliografia']}</td>
        <td><b>{$r['total']}</b></td>
        <td><b>".htmlspecialchars($r['estado'])."</b></td>
        <td>{$r['fecha_calificacion']}</td>
    </tr>";
}

echo "
</table>
</body>
</html>";
exit;
?>







