<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION["id_evaluador"])) {
    header("Location: login.php");
    exit;
}
?>

<link rel="stylesheet" href="../assets/css/header.css">
<script src="https://kit.fontawesome.com/a2e0d5f6d8.js" crossorigin="anonymous"></script>

<header class="main-header">
  <div class="header-left">
    <div class="profile-circle">
      <i class="fa-solid fa-user"></i>
    </div>
    <div>
      <h1>Calificación de Proyectos</h1>
      <p>Bienvenido, <strong><?php echo htmlspecialchars($_SESSION["nombre"]); ?></strong></p>
    </div>
  </div>

  <div class="header-right">
    <button class="logout-btn" onclick="confirmarLogout()">Cerrar Sesión</button>
  </div>
</header>

<script>
function confirmarLogout() {
  const confirmacion = confirm("¿Está seguro de cerrar la sesión?");
  if (confirmacion) {
    window.location.href = "../Controllers/logout.php";
  }
}
</script>






