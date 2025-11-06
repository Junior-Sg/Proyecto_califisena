<?php
session_start();
if (!isset($_SESSION["id_evaluador"])) {
    header("Location: login.php");
    exit;
}

require_once "../Config/database.php";
require_once "../Models/Proyecto.php";

$db = (new Database())->conectar();
$proyectoModel = new Proyecto($db);
$proyectos = $proyectoModel->listarTodosPorEvaluador($_SESSION["id_evaluador"]);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Perfil del Evaluador - SENA</title>
  <link rel="stylesheet" href="../assets/css/header.css">
  <link rel="stylesheet" href="../assets/css/vista.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

  <!-- Header -->
  <header class="main-header">
    <div class="header-left">
      <a href="perfil.php" class="profile-circle" title="Ver Perfil">
        <i class="fa-solid fa-user"></i>
      </a>
      <div>
        <h1 class="titulo-perfil">Perfil del Evaluador</h1>
        <p>Bienvenido, <strong><?php echo htmlspecialchars($_SESSION["nombre"]); ?></strong></p>
      </div>
    </div>
    <div class="header-right">
      <?php if ($_SESSION["id_evaluador"] == 76): ?>
        <a href="admin/index.php" class="btn" style="background-color:#0c6c3c;">🛠 Módulo Admin</a>
      <?php endif; ?>
      <button class="logout-btn" onclick="confirmarLogout()">Cerrar Sesión</button>
    </div>
  </header>

  <div class="perfil-container">
    <p><strong>Nombre:</strong> <?php echo htmlspecialchars($_SESSION["nombre"]); ?></p>
    <p><strong>ID Evaluador:</strong> <?php echo $_SESSION["id_evaluador"]; ?></p>

    <h3>Proyectos Asignados</h3>

    <table>
      <tr>
        <th>ID</th>
        <th>Proyecto</th>
        <th>Tipo Participación</th>
        <th>Regional</th>
        <!-- para definir el cambio que pidieron el si es poster, stan o ponencia  -->
        <th>Tipo proyecto</th>
        <th>Centro de Formación</th>
        <th>Estado</th>
        <th>Acción</th>
        <th>Exportar</th>
      </tr>

      <?php foreach ($proyectos as $p): ?>
        <tr>
          <td><?php echo $p["id_proyecto"]; ?></td>
          <td><?php echo htmlspecialchars($p["nombre_proyecto"]); ?></td>
          <td><?php echo htmlspecialchars($p["regional"]); ?></td>
          <td><?php echo htmlspecialchars($p["centro_formacion"]); ?></td>
          <td>
          <?php if ($p["calificado"]): ?>
              <span style="color:green; font-weight:bold;">✅ Calificado</span>
            <?php else: ?>
              <span style="color:#b22222; font-weight:bold;">⛔ Pendiente</span>
            <?php endif; ?>

  </form>
</td>
          <td>
            <?php if (!$p["calificado"]): ?>
              <a href="calificar.php?id_proyecto=<?php echo $p['id_proyecto']; ?>" class="btn">Calificar</a>
            <?php else: ?>
              <button class="btn" style="background-color:#888; cursor:not-allowed;" disabled>Calificado</button>
            <?php endif; ?>
          </td>
          <td>
            <a href="exportar_excel.php?id_proyecto=<?php echo $p['id_proyecto']; ?>" title="Exportar solo este proyecto">
              <i class="fa-solid fa-file-excel" style="color:#1d6f42; font-size:20px;"></i>
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>

    <div class="actions">
      <a href="calificar.php" class="btn">Volver a Calificar</a>
      <a href="exportar_excel.php?id_evaluador=<?php echo $_SESSION['id_evaluador']; ?>" class="btn">Exportar Todo</a>
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
         cancelButtonText: 'Cancelar',
         width: '90%',
         customClass: {
         popup: 'swal-responsive'
     }
   });
  }
  </script>

</body>
<?php include 'footer.php'; ?>
</html>





