<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ingreso Evaluadores - CALIFISENA</title>
  <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
  <div class="container">
    <!-- SECCIÓN IZQUIERDA -->
    <div class="login-section">
      <div class="rhombus-background">
        <div class="rhombus rh1"></div>
        <div class="rhombus rh2"></div>
        <div class="rhombus rh3"></div>
        <div class="rhombus rh4"></div>
        <div class="rhombus rh5"></div>
      </div>

      <div class="login-content">
        <div class="welcome-title">Bienvenidos a <b>CALIFISENA</b></div>
        <h1>Ingreso<br>Evaluadores</h1>

        <form method="POST" action="../Controllers/LoginController.php">
          <input type="text" name="usuario" placeholder="Usuario" required>
          <input type="password" name="contrasena" placeholder="Contraseña" required>
          <button type="submit">Ingresar</button>
        </form>
      </div>
    </div>

    <!-- SECCIÓN DERECHA -->
    <div class="event-section">
      <div class="event-content">
        <img src="../assets/img/semillreo.jpg" alt="Semilleros de Investigación 2025" class="event-image">
      </div>
    </div>
  </div>
</body>
</html>


