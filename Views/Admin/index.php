<?php
session_start();

// Solo el evaluador con ID 76 puede entrar aquí
if (!isset($_SESSION["id_evaluador"]) || $_SESSION["id_evaluador"] != 76) {
    header("Location: ../calificar.php");
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

      <!-- Crear Proyecto -->
      <a href="crear_proyecto.php" class="btn">➕ Crear Proyecto</a>
      <a href="crear_evaluador.php" class="btn">➕ Nuevo Evaluador</a>
      <a href="ver_evaluadores.php" class="btn">➕ Ver/evaluadores</a>

      <!-- Crear Asignación -->
      <a href="crear_asignacion.php" class="btn">📋 Asignar Proyecto</a>

      <!-- Ver y Editar proyectos -->
      <a href="ver_proyectos.php" class="btn">🗂 Ver / Editar Proyectos</a>

      <!-- Ver y Editar asignaciones -->
      <a href="ver_asignaciones.php" class="btn">👥 Ver / Editar Asignaciones</a>
      <!-- Exportar todas las calificaciones (Solo Admin) -->
      <a href="../../Controllers/exportar_todo.php" class="btn" style="background:#146531;">
        📥 Exportar Todas las Calificaciones
      </a>
      <a href="../../Controllers/ExportarPoster.php" class="btn" style="background:#146531;">
        📥 Exportar Todas las Calificaciones ponencia
      </a>

      <!-- Cerrar sesión -->
      <a href="../../Controllers/logout.php" class="btn" style="background:#a33;">
        🚪 Cerrar Sesión
      </a>
    </div>
  </div>
</body>
</html>



