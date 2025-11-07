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
$proyectos = $proyectoModel->listarPorEvaluador($_SESSION["id_evaluador"]);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Calificar Proyecto - SENA</title>
  <link rel="stylesheet" href="../assets/css/calificar.css">
  <link rel="stylesheet" href="../assets/css/header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    #form-ponencia { display: none; }
    /* Mejoras visuales para los formularios */
    .form-section {
      background: #f8f9fa;
      padding: 20px;
      border-radius: 10px;
      margin: 15px 0;
      border: 1px solid #e9ecef;
    }
    .form-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 15px;
      margin-bottom: 15px;
    }
    .form-full-width {
      grid-column: 1 / -1;
    }
    .form-actions {
      text-align: center;
      margin-top: 20px;
    }
    .btn-submit {
      background: #0C6C3C;
      color: white;
      padding: 12px 30px;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
      font-weight: bold;
    }
    .btn-submit:hover {
      background: #09552f;
    }
    .select-project {
      width: 100%;
      padding: 12px;
      border: 1px solid #ddd;
      border-radius: 5px;
      font-size: 14px;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>

<header class="main-header">
  <div class="header-left">
    <a href="perfil.php" class="profile-circle">
      <i class="fa-solid fa-user"></i>
    </a>
    <div>
      <h1 class="perfil">Calificación de Proyectos</h1>
      <p>Bienvenido, <strong><?php echo htmlspecialchars($_SESSION["nombre"]); ?></strong></p>
    </div>
  </div>
  <div class="header-right">
    <button class="logout-btn" onclick="confirmarLogout()">Cerrar Sesión</button>
  </div>
</header>

<div class="calificar-container">

    <!-- ✅ Selección del proyecto -->
    <label for="id_asignacion"><strong>Seleccione el proyecto a calificar:</strong></label>
    <select name="id_asignacion" id="id_asignacion" class="select-project" required>
      <option value="">-- Seleccione un proyecto --</option>
      <?php foreach ($proyectos as $p): ?>
        <option value="<?php echo $p['id_asignacion']; ?>" data-tipo="<?php echo $p['tipo_participacion']; ?>">
          <?php echo $p['nombre_proyecto'] . " (" . $p['tipo_participacion'] . ") - " . $p['regional']; ?>
        </option>
      <?php endforeach; ?>
    </select>

    <!-- ✅ FORMULARIO NORMAL (POSTER/SEMILLERO) -->
    <div class="form-section" id="form-normal">
      <h3 style="text-align: center; color: #0C6C3C; margin-bottom: 20px;">📊 Calificación para Póster/Semillero</h3>
      <form method="POST" action="../Controllers/CalificacionController.php">
        <input type="hidden" name="id_asignacion" id="id_normal">
        <input type="hidden" name="tipo" value="normal">

        <div class="form-grid">
          <input type="number" name="dominio_tematico" placeholder="Dominio temático y exposición oral (máx. 10)" min="0" max="10" required>
          <input type="number" name="creatividad_diseno" placeholder="Creatividad y diseño del póster (máx. 15)" min="0" max="15" required>
          <input type="number" name="planteamiento_problema" placeholder="Planteamiento del problema (máx. 15)" min="0" max="15" required>
          <input type="number" name="pertinencia_impacto" placeholder="Pertinencia e Impacto (máx. 10)" min="0" max="10" required>
          <input type="number" name="objetivos" placeholder="Objetivos del proyecto (máx. 10)" min="0" max="10" required>
          <input type="number" name="metodologia" placeholder="Metodología (máx. 15)" min="0" max="15" required>
          <input type="number" name="resultados" placeholder="Resultados (máx. 20)" min="0" max="20" required>
          <input type="number" name="bibliografia" placeholder="Bibliografía (máx. 10)" min="0" max="10" required>
        </div>

        <div class="form-full-width">
          <label for="estado_proyecto"><strong>Estado del Proyecto:</strong></label>
          <select name="estado_proyecto" style="width: 100%; padding: 10px; margin-top: 5px;" required>
            <option value="En curso">En curso</option>
            <option value="Finalizado">Finalizado</option>
          </select>
        </div>

        <div class="form-actions">
          <button type="submit" class="btn-submit">💾 Guardar Calificación</button>
        </div>
      </form>
    </div>

    <!-- ✅ FORMULARIO PONENCIA -->
    <div class="form-section" id="form-ponencia">
      <h3 style="text-align: center; color: #0C6C3C; margin-bottom: 20px;">🎤 Calificación para Ponencia</h3>
      <form method="POST" action="../Controllers/CalificacionController.php">
        <input type="hidden" name="id_asignacion" id="id_ponencia">
        <input type="hidden" name="tipo" value="ponencia">

        <div class="form-grid">
          <input type="number" name="titulo_presentacion" placeholder="Título y presentación (5)" min="0" max="5" required>
          <input type="number" name="planteamiento_justificacion" placeholder="Planteamiento y justificación (10)" min="0" max="10" required>
          <input type="number" name="objetivos" placeholder="Objetivos (5)" min="0" max="5" required>
          <input type="number" name="marco_teorico" placeholder="Marco teórico (5)" min="0" max="5" required>
          <input type="number" name="metodologia" placeholder="Metodología (10)" min="0" max="10" required>
          <input type="number" name="resultados_analisis" placeholder="Resultados y análisis (10)" min="0" max="10" required>
          <input type="number" name="conclusiones_aportes" placeholder="Conclusiones y aportes (5)" min="0" max="5" required>
          <input type="number" name="impacto_aplicabilidad" placeholder="Impacto (10)" min="0" max="10" required>
          <input type="number" name="innovacion_creatividad" placeholder="Innovación y creatividad (10)" min="0" max="10" required>
          <input type="number" name="presentacion_oral" placeholder="Presentación oral (10)" min="0" max="10" required>
          <input type="number" name="manejo_publico" placeholder="Manejo del público (10)" min="0" max="10" required>
          <input type="number" name="apoyo_visual" placeholder="Apoyo visual (5)" min="0" max="5" required>
        </div>

        <div class="form-full-width">
          <label for="estado"><strong>Estado del Proyecto:</strong></label>
          <select name="estado" style="width: 100%; padding: 10px; margin-top: 5px;" required>
            <option value="En curso">En curso</option>
            <option value="Finalizado">Finalizado</option>
          </select>
        </div>

        <div class="form-actions">
          <button type="submit" class="btn-submit">💾 Guardar Calificación</button>
        </div>
      </form>
    </div>

    <div class="actions">
      <a href="perfil.php" class="btn">👤 Ver Perfil</a>
    </div>

</div>

<script>
document.getElementById("id_asignacion").addEventListener("change", function() {
    const tipo = this.options[this.selectedIndex].getAttribute("data-tipo");
    const id = this.value;

    document.getElementById("id_normal").value = id;
    document.getElementById("id_ponencia").value = id;

    if (tipo === "Ponencia") {
        document.getElementById("form-normal").style.display = "none";
        document.getElementById("form-ponencia").style.display = "block";
    } else {
        document.getElementById("form-normal").style.display = "block";
        document.getElementById("form-ponencia").style.display = "none";
    }
});

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
<?php include 'footer.php'; ?>
</html>

