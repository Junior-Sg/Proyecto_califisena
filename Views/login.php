<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Ingreso Evaluadores - SENA</title>
  <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
  <div class="login-container">
    <h2>Ingreso Evaluadores</h2>
    <form method="POST" action="../Controllers/LoginController.php">
      <input type="text" name="usuario" placeholder="Usuario" required>
      <input type="password" name="contrasena" placeholder="Contraseña" required>
      <button type="submit">Ingresar</button>
    </form>
  </div>
</body>
</html>


