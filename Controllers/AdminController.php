<?php
require_once "../Config/database.php";
require_once "../Models/Admin.php";

class AdminController {
    private $model;

    public function __construct() {
        $db = (new Database())->conectar();
        $this->model = new Admin($db);
    }

    /* =====================================================
       🔹 MÉTODOS CONTROLADOR
    ===================================================== */

    public function crearProyecto($data) {
        return $this->model->crearProyecto($data);
    }

    public function editarProyecto($id, $data) {
        return $this->model->editarProyecto($id, $data);
    }

    public function crearAsignacion($data) {
        return $this->model->crearAsignacion($data);
    }

    public function editarAsignacion($id, $data) {
        return $this->model->editarAsignacion($id, $data);
    }

    public function listarEvaluadores() {
        return $this->model->listarEvaluadores();
    }

    public function listarProyectos() {
        return $this->model->listarProyectos();
    }

    public function obtenerProyectoPorId($id) {
        return $this->model->obtenerProyectoPorId($id);
    }

    public function obtenerAsignacionPorId($id) {
        return $this->model->obtenerAsignacionPorId($id);
    }
}

/* =====================================================
   🔹 MANEJO DE FORMULARIOS (POST)
===================================================== */

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $admin = new AdminController();

    try {
        switch ($_POST["accion"]) {

            case "crear_proyecto":
                $data = [
                    "nombre_proyecto"   => trim($_POST["nombre_proyecto"]),
                    "tipo_participacion"=> trim($_POST["tipo_participacion"]),
                    "regional"          => trim($_POST["regional"]),
                    "centro_formacion"  => trim($_POST["centro_formacion"])
                ];

                if ($admin->crearProyecto($data)) {
                    header("Location: ../Views/Admin/index.php?success=proyecto");
                } else {
                    throw new Exception("Error al crear el proyecto.");
                }
                break;

            case "editar_proyecto":
                $data = [
                    "nombre_proyecto"   => trim($_POST["nombre_proyecto"]),
                    "tipo_participacion"=> trim($_POST["tipo_participacion"]),
                    "regional"          => trim($_POST["regional"]),
                    "centro_formacion"  => trim($_POST["centro_formacion"])
                ];

                if ($admin->editarProyecto($_POST["id_proyecto"], $data)) {
                    header("Location: ../Views/Admin/index.php?success=edit_proyecto");
                } else {
                    throw new Exception("Error al editar el proyecto.");
                }
                break;

            case "crear_asignacion":
                $data = [
                    "id_evaluador" => $_POST["id_evaluador"],
                    "id_proyecto"  => $_POST["id_proyecto"]
                ];

                if ($admin->crearAsignacion($data)) {
                    header("Location: ../Views/Admin/index.php?success=asignacion");
                } else {
                    throw new Exception("Error al crear la asignación.");
                }
                break;

            case "editar_asignacion":
                $data = [
                    "id_evaluador" => $_POST["id_evaluador"],
                    "id_proyecto"  => $_POST["id_proyecto"]
                ];

                if ($admin->editarAsignacion($_POST["id_asignacion"], $data)) {
                    header("Location: ../Views/Admin/index.php?success=edit_asignacion");
                } else {
                    throw new Exception("Error al editar la asignación.");
                }
                break;

            default:
                throw new Exception("Acción no válida.");
        }

    } catch (Exception $e) {
        echo "<h3 style='color:red; text-align:center;'>❌ Error: {$e->getMessage()}</h3>";
    }
}
?>


