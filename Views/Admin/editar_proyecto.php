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

$proyecto = $admin->obtenerProyectoPorId($id);
if (!$proyecto) {
    die("Proyecto no encontrado.");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Proyecto</title>
  <link rel="stylesheet" href="../../assets/css/admin.css">
</head>
<body>
  <div class="admin-container">
    <h1>✏ Editar Proyecto</h1>

    <form method="POST" action="../../Controllers/AdminController.php">
      <input type="hidden" name="accion" value="editar_proyecto">
      <input type="hidden" name="id_proyecto" value="<?php echo $proyecto['id_proyecto']; ?>">

      <label>Nombre del Proyecto</label>
      <input type="text" name="nombre_proyecto" value="<?php echo htmlspecialchars($proyecto['nombre_proyecto']); ?>" required>

      <label>Tipo de Participación</label>
      <input type="text" name="tipo_participacion" value="<?php echo htmlspecialchars($proyecto['tipo_participacion']); ?>" required>

      <label>Regional</label>
      <input type="text" name="regional" value="<?php echo htmlspecialchars($proyecto['regional']); ?>" required>

      <label>Centro de Formación</label>
      <input type="text" name="centro_formacion" value="<?php echo htmlspecialchars($proyecto['centro_formacion']); ?>" required>

      <button type="submit">💾 Guardar Cambios</button>
      <a href="index.php" class="btn">⬅ Volver</a>
    </form>
  </div>
</body>
</html>

