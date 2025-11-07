<?php
require_once "../Config/database.php";
require_once "../Models/Calificacion.php";

session_start();

if (!isset($_SESSION["id_evaluador"])) {
    header("Location: ../Views/login.php");
    exit;
}

class CalificacionController {
    private $db;
    private $model;

    public function __construct() {
        $this->db = (new Database())->conectar();
        $this->model = new Calificacion($this->db);
    }

    public function procesar() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            try {
                if (!isset($_POST["tipo"]) || !isset($_POST["id_asignacion"])) {
                    throw new Exception("Datos incompletos del formulario");
                }

                $id_asignacion = intval($_POST["id_asignacion"]);
                $tipo = $_POST["tipo"];

                // Verificar asignación y permisos
                $stmt_verificar = $this->db->prepare("
                    SELECT COUNT(*) FROM asignaciones 
                    WHERE id_asignacion = ? AND id_evaluador = ?
                ");
                $stmt_verificar->execute([$id_asignacion, $_SESSION["id_evaluador"]]);
                
                if (!$stmt_verificar->fetchColumn()) {
                    throw new Exception("No tienes permisos para calificar este proyecto");
                }

                // Verificar duplicados
                if ($tipo === "ponencia") {
                    if ($this->model->existeCalificacionPonencia($id_asignacion)) {
                        throw new Exception("Ya existe una calificación de ponencia para este proyecto");
                    }
                } else {
                    if ($this->model->existeCalificacion($id_asignacion)) {
                        throw new Exception("Ya existe una calificación para este proyecto");
                    }
                }

                // Iniciar transacción
                $this->db->beginTransaction();

                if ($tipo === "ponencia") {
                    $this->procesarPonencia($id_asignacion, $_POST);
                } else {
                    $this->procesarNormal($id_asignacion, $_POST);
                }

                $this->db->commit();
                
                $_SESSION['mensaje_exito'] = "✅ Calificación guardada correctamente";
                header("Location: ../Views/perfil.php");
                exit;

            } catch (Exception $e) {
                if ($this->db->inTransaction()) {
                    $this->db->rollBack();
                }
                
                error_log("Error en calificación: " . $e->getMessage());
                $_SESSION['error'] = $e->getMessage();
                header("Location: ../Views/calificar.php");
                exit;
            }
        }
    }

    private function procesarPonencia($id_asignacion, $datos) {
        $campos_requeridos = [
            "titulo_presentacion", "planteamiento_justificacion", "objetivos",
            "marco_teorico", "metodologia", "resultados_analisis", "conclusiones_aportes",
            "impacto_aplicabilidad", "innovacion_creatividad", "presentacion_oral",
            "manejo_publico", "apoyo_visual", "estado"
        ];

        // Validar campos
        foreach ($campos_requeridos as $campo) {
            if (!isset($datos[$campo]) || $datos[$campo] === '') {
                throw new Exception("El campo {$campo} es requerido");
            }
            
            // Validar rango numérico
            if (in_array($campo, ["titulo_presentacion", "planteamiento_justificacion", "objetivos", 
                                  "marco_teorico", "metodologia", "resultados_analisis", "conclusiones_aportes",
                                  "impacto_aplicabilidad", "innovacion_creatividad", "presentacion_oral",
                                  "manejo_publico", "apoyo_visual"])) {
                $valor = intval($datos[$campo]);
                $maximos = [
                    "titulo_presentacion" => 5, "planteamiento_justificacion" => 10, 
                    "objetivos" => 5, "marco_teorico" => 5, "metodologia" => 10,
                    "resultados_analisis" => 10, "conclusiones_aportes" => 5,
                    "impacto_aplicabilidad" => 10, "innovacion_creatividad" => 10,
                    "presentacion_oral" => 10, "manejo_publico" => 10, "apoyo_visual" => 5
                ];
                
                if ($valor < 0 || $valor > $maximos[$campo]) {
                    throw new Exception("El campo {$campo} debe estar entre 0 y {$maximos[$campo]}");
                }
            }
        }

        $total = array_sum([
            intval($datos["titulo_presentacion"]),
            intval($datos["planteamiento_justificacion"]),
            intval($datos["objetivos"]),
            intval($datos["marco_teorico"]),
            intval($datos["metodologia"]),
            intval($datos["resultados_analisis"]),
            intval($datos["conclusiones_aportes"]),
            intval($datos["impacto_aplicabilidad"]),
            intval($datos["innovacion_creatividad"]),
            intval($datos["presentacion_oral"]),
            intval($datos["manejo_publico"]),
            intval($datos["apoyo_visual"])
        ]);

        //  DATOS CON NUEVOS NOMBRES DE COLUMNAS
        $data_ponencia = [
            "id_asignacion" => $id_asignacion,
            "pon_titulo_presentacion" => intval($datos["titulo_presentacion"]),
            "pon_planteamiento_justificacion" => intval($datos["planteamiento_justificacion"]),
            "pon_objetivos" => intval($datos["objetivos"]),
            "pon_marco_teorico" => intval($datos["marco_teorico"]),
            "pon_metodologia" => intval($datos["metodologia"]),
            "pon_resultados_analisis" => intval($datos["resultados_analisis"]),
            "pon_conclusiones_aportes" => intval($datos["conclusiones_aportes"]),
            "pon_impacto_aplicabilidad" => intval($datos["impacto_aplicabilidad"]),
            "pon_innovacion_creatividad" => intval($datos["innovacion_creatividad"]),
            "pon_presentacion_oral" => intval($datos["presentacion_oral"]),
            "pon_manejo_publico" => intval($datos["manejo_publico"]),
            "pon_apoyo_visual" => intval($datos["apoyo_visual"]),
            "pon_total" => $total,
            "pon_estado" => htmlspecialchars($datos["estado"])
        ];

        if (!$this->model->guardarPonencia($data_ponencia)) {
            throw new Exception("Error al guardar la calificación de ponencia");
        }
    }

    private function procesarNormal($id_asignacion, $datos) {
        $campos_requeridos = [
            "dominio_tematico", "creatividad_diseno", "planteamiento_problema",
            "objetivos", "pertinencia_impacto", "metodologia", "resultados", 
            "bibliografia", "estado_proyecto"
        ];

        foreach ($campos_requeridos as $campo) {
            if (!isset($datos[$campo]) || $datos[$campo] === '') {
                throw new Exception("El campo {$campo} es requerido");
            }
            
            if (in_array($campo, ["dominio_tematico", "creatividad_diseno", "planteamiento_problema",
                                  "objetivos", "pertinencia_impacto", "metodologia", "resultados", 
                                  "bibliografia"])) {
                $valor = intval($datos[$campo]);
                $maximos = [
                    "dominio_tematico" => 10, "creatividad_diseno" => 15, 
                    "planteamiento_problema" => 15, "objetivos" => 10,
                    "pertinencia_impacto" => 10, "metodologia" => 15,
                    "resultados" => 20, "bibliografia" => 10
                ];
                
                if ($valor < 0 || $valor > $maximos[$campo]) {
                    throw new Exception("El campo {$campo} debe estar entre 0 y {$maximos[$campo]}");
                }
            }
        }

        $total = array_sum([
            intval($datos["dominio_tematico"]),
            intval($datos["creatividad_diseno"]),
            intval($datos["planteamiento_problema"]),
            intval($datos["objetivos"]),
            intval($datos["pertinencia_impacto"]),
            intval($datos["metodologia"]),
            intval($datos["resultados"]),
            intval($datos["bibliografia"])
        ]);

        $data = [
            "id_asignacion" => $id_asignacion,
            "dominio_tematico" => intval($datos["dominio_tematico"]),
            "creatividad_diseno" => intval($datos["creatividad_diseno"]),
            "planteamiento_problema" => intval($datos["planteamiento_problema"]),
            "objetivos" => intval($datos["objetivos"]),
            "pertinencia_impacto" => intval($datos["pertinencia_impacto"]),
            "metodologia" => intval($datos["metodologia"]),
            "resultados" => intval($datos["resultados"]),
            "bibliografia" => intval($datos["bibliografia"]),
            "total" => $total,
            "estado" => htmlspecialchars($datos["estado_proyecto"])
        ];

        if (!$this->model->guardar($data)) {
            throw new Exception("Error al guardar la calificación");
        }
    }
}

// Ejecutar el controlador
$controller = new CalificacionController();
$controller->procesar();
?>