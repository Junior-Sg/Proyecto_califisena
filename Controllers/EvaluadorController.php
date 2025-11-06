<?php
require_once __DIR__ . "/../Config/database.php";
require_once __DIR__ . "/../Models/Evaluador.php";



class EvaluadorController {
    private $model;

    public function __construct() {
        $db = (new Database())->conectar();
        $this->model = new Evaluador($db);
    }

    public function crearEvaluador($nombre, $usuario, $contrasena) {
        $hash = $contrasena;
        $data = [
            "nombre" => $nombre,
            "usuario" => $usuario,
            "contrasena_hash" => $hash
        ];

        return $this->model->crearEvaluador($data);
    }

    public function listarEvaluadores() {
        return $this->model->listarEvaluadores();
    }
}

// === Manejo del formulario ===
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $controller = new EvaluadorController();
    $nombre = $_POST["nombre"] ?? '';
    $usuario = $_POST["usuario"] ?? '';
    $contrasena = $_POST["contrasena"] ?? '';

    if (empty($nombre) || empty($usuario) || empty($contrasena)) {
        echo "<div class='error'>⚠️ Todos los campos son obligatorios</div>";
        exit;
    }

    $ok = $controller->crearEvaluador($nombre, $usuario, $contrasena);

    if ($ok) {
        echo "<script>alert('✅ Evaluador registrado correctamente'); window.location='../Views/Admin/ver_evaluadores.php';</script>";
    } else {
        echo "<script>alert('❌ Error al registrar el evaluador'); window.history.back();</script>";
    }
}
?>
