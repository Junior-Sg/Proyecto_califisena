<?php
require_once "../../Config/database.php";
require_once "../../Models/Admin.php";
$db = (new Database())->conectar();
$model = new Admin($db);
$evaluadores = $model->listarEvaluadores();
$proyectos = $model->listarProyectos();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Asignar Proyecto</title>
  <link rel="stylesheet" href="../../assets/css/admin.css">
</head>
<body>
  <div class="admin-container">
    <h2>📋 Asignar Proyecto a Evaluador</h2>

    <form method="POST" action="../../Controllers/AdminController.php">
      <input type="hidden" name="accion" value="crear_asignacion">

      <label>Seleccionar Evaluador</label>
      <select name="id_evaluador" required>
        <option value="">Seleccione...</option>
        <?php foreach ($evaluadores as $e): ?>
          <option value="<?php echo $e['id_evaluador']; ?>"><?php echo htmlspecialchars($e['nombre']); ?></option>
        <?php endforeach; ?>
      </select>

      <label>Seleccionar Proyecto</label>
      <select name="id_proyecto" required>
        <option value="">Seleccione...</option>
        <?php foreach ($proyectos as $p): ?>
          <option value="<?php echo $p['id_proyecto']; ?>"><?php echo htmlspecialchars($p['nombre_proyecto']); ?></option>
        <?php endforeach; ?>
      </select>

      <button type="submit" class="btn">Asignar</button>
      <a href="index.php" class="btn">Volver</a>
    </form>
  </div>
</body>
</html>

