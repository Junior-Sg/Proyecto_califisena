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
$asignaciones = $admin->listarAsignaciones();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Asignaciones Registradas</title>
  <link rel="stylesheet" href="../../assets/css/admin.css">
</head>
<body>
  <div class="admin-container">
    <h1>👥 Asignaciones</h1>
    <a href="index.php" class="btn">⬅ Volver al Panel</a>

    <table>
      <tr>
        <th>ID</th>
        <th>Evaluador</th>
        <th>Proyecto</th>
        <th>Editar</th>
      </tr>
      <?php foreach ($asignaciones as $a): ?>
      <tr>
        <td><?php echo $a["id_asignacion"]; ?></td>
        <td><?php echo htmlspecialchars($a["evaluador"]); ?></td>
        <td><?php echo htmlspecialchars($a["nombre_proyecto"]); ?></td>
        <td>
          <a href="editar_asignacion.php?id=<?php echo $a['id_asignacion']; ?>" class="btn">✏ Editar</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
</body>
</html>
