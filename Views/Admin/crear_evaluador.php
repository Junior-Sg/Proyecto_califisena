<?php
session_start();
//  if (!isset($_SESSION["id_admin"])) { header("Location: ../login.php"); exit; }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Evaluador</title>
  <link rel="stylesheet" href="../../assets/css/admin.css">
</head>
<body>

  <div class="admin-container">
    <h1>Registrar Nuevo Evaluador</h1>

    <form action="../../Controllers/EvaluadorController.php" method="POST">
      <label for="nombre">Nombre Completo:</label>
      <input type="text" id="nombre" name="nombre" placeholder="Ej. Carlos Pérez" required>

      <label for="usuario">Usuario:</label>
      <input type="text" id="usuario" name="usuario" placeholder="Ej. cperez" required>

      <label for="contrasena">Contraseña:</label>
      <input type="text" id="contrasena" name="contrasena" placeholder="Escribe una contraseña" required>

      <div class="actions">
        <button type="submit">Registrar Evaluador</button>
        <a href="index.php" class="btn">Volver</a>
      </div>
    </form>
  </div>

</body>
</html>
