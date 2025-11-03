<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Crear Proyecto</title>
  <link rel="stylesheet" href="../../assets/css/admin.css">
</head>
<body>
  <div class="admin-container">
    <h2>➕ Registrar Nuevo Proyecto</h2>

    <form method="POST" action="../../Controllers/AdminController.php">
      <input type="hidden" name="accion" value="crear_proyecto">

      <input type="text" name="nombre_proyecto" placeholder="Nombre del Proyecto" required>
      <input type="text" name="tipo_participacion" placeholder="Tipo de Participación" required>
      <input type="text" name="regional" placeholder="Regional" required>
      <input type="text" name="centro_formacion" placeholder="Centro de Formación" required>

      <button type="submit" class="btn">Guardar Proyecto</button>
      <a href="index.php" class="btn">Volver</a>
    </form>
  </div>
</body>
</html>
