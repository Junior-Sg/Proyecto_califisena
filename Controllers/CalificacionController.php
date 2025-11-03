<?php
require_once "../Config/database.php";
require_once "../Models/Calificacion.php";

session_start();

// Verificar sesión activa
if (!isset($_SESSION["id_evaluador"])) {
    header("Location: ../Views/login.php");
    exit;
}

$db = (new Database())->conectar();
$model = new Calificacion($db);

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Validar campos obligatorios
    if (
        empty($_POST["id_asignacion"]) ||
        empty($_POST["dominio_tematico"]) ||
        empty($_POST["formato_poster"]) ||
        empty($_POST["creatividad_diseno"]) ||
        empty($_POST["introduccion"]) ||
        empty($_POST["planteamiento_problema"]) ||
        empty($_POST["objetivos"]) ||
        empty($_POST["referente_teorico"]) ||
        empty($_POST["metodologia"]) ||
        empty($_POST["resultados"]) ||
        empty($_POST["bibliografia"]) ||
        empty($_POST["estado_proyecto"])
    ) {
        echo "<script>alert('⚠️ Debes completar todos los campos.'); window.location='../Views/calificar.php';</script>";
        exit;
    }

    // Calcular total
    $total = (
        $_POST["dominio_tematico"] +
        $_POST["formato_poster"] +
        $_POST["creatividad_diseno"] +
        $_POST["introduccion"] +
        $_POST["planteamiento_problema"] +
        $_POST["objetivos"] +
        $_POST["referente_teorico"] +
        $_POST["metodologia"] +
        $_POST["resultados"] +
        $_POST["bibliografia"]
    );

    // Datos a guardar
    $data = [
        "id_asignacion" => $_POST["id_asignacion"],
        "dominio_tematico" => $_POST["dominio_tematico"],
        "formato_poster" => $_POST["formato_poster"],
        "creatividad_diseno" => $_POST["creatividad_diseno"],
        "introduccion" => $_POST["introduccion"],
        "planteamiento_problema" => $_POST["planteamiento_problema"],
        "objetivos" => $_POST["objetivos"],
        "referente_teorico" => $_POST["referente_teorico"],
        "metodologia" => $_POST["metodologia"],
        "resultados" => $_POST["resultados"],
        "bibliografia" => $_POST["bibliografia"],
        "total" => $total,
        "estado" => $_POST["estado_proyecto"]
    ];

    // Guardar en base de datos
    if ($model->guardar($data)) {
        echo "<script>
            alert('✅ Calificación guardada correctamente.\\nTotal obtenido: {$total}');
            window.location='../Views/perfil.php';
        </script>";
    } else {
        echo "<script>
            alert('❌ Error al guardar la calificación. Intenta nuevamente.');
            window.location='../Views/calificar.php';
        </script>";
    }
}
?>




