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

$id = $_GET["id"] ?? null;
if (!$id) {
    header("Location: index.php");
    exit;
}

$asignacion = $admin->obtenerAsignacionPorId($id);
$evaluadores = $admin->listarEvaluadores();
$proyectos = $admin->listarProyectos();

if (!$asignacion) {
    die("Asignación no encontrada.");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Asignación</title>
  <link rel="stylesheet" href="../../assets/css/admin.css">
</head>
<body>
  <div class="admin-container">
    <h1>✏ Editar Asignación</h1>

    <form method="POST" action="../../Controllers/AdminController.php">
      <input type="hidden" name="accion" value="editar_asignacion">
      <input type="hidden" name="id_asignacion" value="<?php echo $asignacion['id_asignacion']; ?>">

      <label>Evaluador</label>
      <select name="id_evaluador" required>
        <option value="">Seleccione...</option>
        <?php foreach ($evaluadores as $e): ?>
          <option value="<?php echo $e['id_evaluador']; ?>" <?php if ($asignacion['id_evaluador'] == $e['id_evaluador']) echo 'selected'; ?>>
            <?php echo htmlspecialchars($e['nombre']); ?>
          </option>
        <?php endforeach; ?>
      </select>

      <label>Proyecto</label>
      <select name="id_proyecto" required>
        <option value="">Seleccione...</option>
        <?php foreach ($proyectos as $p): ?>
          <option value="<?php echo $p['id_proyecto']; ?>" <?php if ($asignacion['id_proyecto'] == $p['id_proyecto']) echo 'selected'; ?>>
            <?php echo htmlspecialchars($p['nombre_proyecto']); ?>
          </option>
        <?php endforeach; ?>
      </select>

      <button type="submit">💾 Guardar Cambios</button>
      <a href="index.php" class="btn">⬅ Volver</a>
    </form>
  </div>
</body>
</html>
