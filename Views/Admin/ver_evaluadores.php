<?php
require_once "../../Controllers/EvaluadorController.php";
$controller = new EvaluadorController();
$evaluadores = $controller->listarEvaluadores();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Lista de Evaluadores</title>
  <link rel="stylesheet" href="../../assets/css/admin.css">
</head>
<body>

  <div class="admin-container">
    <h1>Lista de Evaluadores</h1>

    <div class="actions">
      <a href="crear_evaluador.php" class="btn">➕ Nuevo Evaluador</a>
      <a href="index.php" class="btn">⬅ Volver</a>
    </div>

    <?php if (!empty($evaluadores)): ?>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Usuario</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($evaluadores as $e): ?>
            <tr>
              <td><?= htmlspecialchars($e['id_evaluador']) ?></td>
              <td><?= htmlspecialchars($e['nombre']) ?></td>
              <td><?= htmlspecialchars($e['usuario']) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p class="error">No hay evaluadores registrados todavía.</p>
    <?php endif; ?>
  </div>

</body>
</html>
