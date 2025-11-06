<?php
session_start();
if (!isset($_SESSION["id_evaluador"]) || $_SESSION["id_evaluador"] != 76) {
    header("Location: ../perfil.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel Admin - CALIFISENA</title>
  <link rel="stylesheet" href="../../assets/css/admin.css">
</head>
<body>
  <div class="admin-container">
    <h1>🛠 Panel Administrativo</h1>
    <p>Bienvenido, <strong><?php echo htmlspecialchars($_SESSION["nombre"]); ?></strong></p>

    <div class="actions">
      <a href="crear_proyecto.php" class="btn">➕ Crear Proyecto</a>
      <a href="crear_evaluador.php" class="btn">➕ Nuevo Evaluador</a>
      <a href="ver_evaluadores.php" class="btn">➕ Ver/evaluadores</a>
      <a href="crear_asignacion.php" class="btn">📋 Asignar Proyecto</a>
      <a href="ver_proyectos.php" class="btn">🗂 Ver / Editar Proyectos</a>
      <a href="ver_asignaciones.php" class="btn">👥 Ver / Editar Asignaciones</a>
      <a href="" class="btn">👥 Exportar calificaciones</a>
      <a href="../perfil.php" class="btn">⬅ Volver al Perfil</a>
    </div>
  </div>
</body>
</html>


