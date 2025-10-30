<?php
session_start();
if (!isset($_SESSION["id_evaluador"])) {
    header("Location: login.php");
    exit;
}
// hola 
require_once "../Config/database.php";
require_once "../Models/Proyecto.php";

$db = (new Database())->conectar();
$proyectoModel = new Proyecto($db);
$proyectos = $proyectoModel->listarPorEvaluador($_SESSION["id_evaluador"]);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Calificar Proyecto - SENA</title>
  <link rel="stylesheet" href="../assets/css/vista.css">
  <link rel="stylesheet" href="../assets/css/header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

  <!-- encabezado de header.php -->
  <header class="main-header">
    <div class="header-left">
      <a href="perfil.php" class="profile-circle" title="Ver Perfil">
        <i class="fa-solid fa-user"></i>
      </a>
      <div>
        <h1>Calificación de Proyectos</h1>
        <p>Bienvenido, <strong><?php echo htmlspecialchars($_SESSION["nombre"]); ?></strong></p>
      </div>
    </div>
    <div class="header-right">
      <button class="logout-btn" onclick="confirmarLogout()">Cerrar Sesión</button>
    </div>
  </header>

  <div class="calificar-container">
    <form method="POST" action="../Controllers/CalificacionController.php">
      <label for="id_proyecto">Proyecto:</label>
      <select name="id_asignacion" id="id_asignacion" required>
        <option value="">Seleccione...</option>
        <?php foreach ($proyectos as $p): ?>
          <option value="<?php echo $p['id_asignacion']; ?>">
            <?php echo $p['nombre_proyecto'] . " - Estado: " . $p['estado']; ?>
          </option>
        <?php endforeach; ?>
      </select>

      <input type="number" name="dominio_tematico" placeholder="Dominio temático (10)" min="0" max="10" required>
      <input type="number" name="formato_poster" placeholder="Formato del póster (10)" min="0" max="10" required>
      <input type="number" name="creatividad_diseno" placeholder="Creatividad y diseño (5)" min="0" max="5" required>
      <input type="number" name="introduccion" placeholder="Introducción (10)" min="0" max="10" required>
      <input type="number" name="planteamiento_problema" placeholder="Planteamiento del problema (15)" min="0" max="15" required>
      <input type="number" name="objetivos" placeholder="Objetivos (10)" min="0" max="10" required>

      <button type="submit">Guardar Calificación</button>
    </form>

    <div class="actions">
      <a href="perfil.php" class="btn">Ver Perfil</a>
      <a href="exportar_excel.php?id_evaluador=<?php echo $_SESSION['id_evaluador']; ?>" class="btn">Exportar a Excel</a>
    </div>
  </div>

  <script>
  function confirmarLogout() {
    Swal.fire({
      title: '¿Desea cerrar sesión?',
      text: "Tu sesión se cerrará y volverás al inicio de sesión.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Sí, cerrar sesión',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "../Controllers/logout.php";
      }
    });
  }
  </script>

</body>
</html>


