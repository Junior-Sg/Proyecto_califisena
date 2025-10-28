<?php
require_once "../Config/database.php";
require_once "../Models/Evaluador.php";

session_start();
$db = (new Database())->conectar();
$model = new Evaluador($db);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = $_POST["usuario"];
    $contrasena = $_POST["contrasena"];
    $evaluador = $model->verificarLogin($usuario, $contrasena);

    if ($evaluador) {
        $_SESSION["id_evaluador"] = $evaluador["id_evaluador"];
        $_SESSION["nombre"] = $evaluador["nombre"];
        header("Location: ../Views/calificar.php");
        exit;
    } else {
        echo "<script>alert('Usuario o contraseña incorrectos'); window.location='../Views/login.php';</script>";
    }
}
?>




