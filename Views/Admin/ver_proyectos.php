<?php
session_start();
if (!isset($_SESSION["id_evaluador"]) || $_SESSION["id_evaluador"] != 76) {
    header("Location: ../perfil.php");
    exit;
}

require_once "../../Config/database.php";
require_once "../../Models/Admin.php";

$db = (new Database())->conectar();
$admin = new Admin($db);
$proyectos = $admin->listarProyectos();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Proyectos Registrados</title>
  <link rel="stylesheet" href="../../assets/css/admin.css">
</head>
<body>
  <div class="admin-container">
    <h1>📁 Proyectos Registrados</h1>
    <a href="index.php" class="btn">⬅ Volver al Panel</a>

    <table>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Tipo Participación</th>
        <th>Regional</th>
        <th>Centro Formación</th>
        <th>Editar</th>
      </tr>
      <?php foreach ($proyectos as $p): ?>
      <tr>
        <td><?php echo $p["id_proyecto"]; ?></td>
        <td><?php echo htmlspecialchars($p["nombre_proyecto"]); ?></td>
        <td><?php echo htmlspecialchars($p["tipo_participacion"]); ?></td>
        <td><?php echo htmlspecialchars($p["regional"]); ?></td>
        <td><?php echo htmlspecialchars($p["centro_formacion"]); ?></td>
        <td>
          <a href="editar_proyecto.php?id=<?php echo $p['id_proyecto']; ?>" class="btn">✏ Editar</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
</body>
</html>
