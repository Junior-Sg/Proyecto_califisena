<?php
require_once "../Config/database.php";
require_once "../Models/Calificacion.php";

session_start();
$db = (new Database())->conectar();
$model = new Calificacion($db);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = [
        "id_asignacion" => $_POST["id_asignacion"],
        "dominio_tematico" => $_POST["dominio_tematico"],
        "formato_poster" => $_POST["formato_poster"],
        "creatividad_diseno" => $_POST["creatividad_diseno"],
        "introduccion" => $_POST["introduccion"],
        "planteamiento_problema" => $_POST["planteamiento_problema"],
        "objetivos" => $_POST["objetivos"],
        "total" => (
            $_POST["dominio_tematico"] +
            $_POST["formato_poster"] +
            $_POST["creatividad_diseno"] +
            $_POST["introduccion"] +
            $_POST["planteamiento_problema"] +
            $_POST["objetivos"]
        )
    ];

    if ($model->guardar($data)) {
        echo "<script>alert('✅ Calificación guardada correctamente'); window.location='../Views/calificar.php';</script>";
    } else {
        echo "<script>alert('❌ Error al guardar la calificación'); window.location='../Views/calificar.php';</script>";
    }
}
?>



