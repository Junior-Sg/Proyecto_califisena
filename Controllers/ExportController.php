<?php
require_once("../Models/Calificacion.php");
require_once("../Config/database.php");

class ExportController {
    private $calificacion;

    public function __construct() {
        $db = (new Database())->conectar();
        $this->calificacion = new Calificacion($db);
    }

    // ✅ FUNCIÓN MEJORADA PARA LIMPIAR TEXTO
    private function limpiarTexto($texto) {
        if (empty($texto)) return '';
        
        // Reemplazar caracteres especiales manualmente
        $caracteresEspeciales = [
            'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u',
            'Á' => 'A', 'É' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ú' => 'U',
            'ñ' => 'n', 'Ñ' => 'N', 'ü' => 'u', 'Ü' => 'U',
            '´' => '', '`' => '', '¨' => '', '~' => '', '^' => '',
            '°' => '', 'ª' => '', 'º' => '', '§' => '', '¶' => '',
            '¿' => '', '¡' => '', '€' => 'EUR', '$' => 'USD',
            '&' => 'y', '<' => '(', '>' => ')', '"' => "'"
        ];
        
        $texto = strtr($texto, $caracteresEspeciales);
        
        // Eliminar cualquier otro carácter problemático
        $texto = preg_replace('/[^\x20-\x7E]/', '', $texto);
        
        return trim($texto);
    }

    // ✅ EXPORTAR SEGÚN TIPO (INDIVIDUAL)
    public function exportarPorProyecto($id_proyecto) {
        // Determinar el tipo de proyecto
        $tipo_proyecto = $this->calificacion->obtenerTipoProyecto($id_proyecto);
        
        if ($tipo_proyecto === 'Ponencia') {
            $this->exportarPonenciaExcel(null, $id_proyecto, "Proyecto_Ponencia_");
        } else {
            $this->exportarNormalExcel(null, $id_proyecto, "Proyecto_Normal_");
        }
    }

    // ✅ EXPORTAR TODOS LOS PROYECTOS DEL EVALUADOR
    public function exportarTodos($id_evaluador) {
        // Exportar proyectos normales del evaluador
        $this->exportarNormalExcel($id_evaluador, null, "Mis_Calificaciones_Normales_");
        
        // Exportar proyectos ponencia del evaluador  
        $this->exportarPonenciaExcel($id_evaluador, null, "Mis_Calificaciones_Ponencia_");
    }

    // ✅ EXPORTAR EXCEL NORMAL
    private function exportarNormalExcel($id_evaluador = null, $id_proyecto = null, $prefix = "Calificaciones_") {
        $datos = $this->calificacion->obtenerCalificacionesNormales($id_evaluador, $id_proyecto);
        
        if (empty($datos)) {
            die("No hay datos para exportar");
        }

        // Headers mejorados para Excel
        header("Content-Type: application/vnd.ms-excel; charset=Windows-1252");
        header("Content-Disposition: attachment; filename=" . $prefix . date('Ymd_His') . ".xls"); 
        header("Pragma: no-cache"); 
        header("Expires: 0"); 

        echo '<!DOCTYPE html>
        <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=Windows-1252">
            <title>Calificaciones Normales SENA</title>
            <style>
                th { 
                    background:#0C6C3C; 
                    color:white; 
                    font-weight:bold; 
                    padding:6px; 
                    font-family: Arial;
                    font-size: 12px;
                } 
                td { 
                    border:1px solid #bbb; 
                    padding:5px; 
                    text-align:center; 
                    font-family: Arial;
                    font-size: 11px;
                } 
                tr:nth-child(even) { 
                    background:#EAF3ED; 
                }
            </style> 
        </head> 
        <body> 
            <table border="1" cellpadding="3" cellspacing="0" width="100%"> 
            <tr> 
                <th>Proyecto</th> 
                <th>Tipo Participacion</th>
                <th>Regional</th> 
                <th>Centro</th> 
                <th>Evaluadores</th> 
                <th>Cant. Eval</th>
                <th>Dominio</th> 
                <th>Creatividad</th> 
                <th>Problema</th> 
                <th>Pertinencia / Impacto</th> 
                <th>Objetivos</th> 
                <th>Metodologia</th> 
                <th>Resultados</th> 
                <th>Bibliografia</th> 
                <th>Suma Total</th> 
                <th>Resultado Final</th> 
            </tr> 
        '; 

        foreach ($datos as $r) { 
            // Limpiar todos los textos
            $nombre_proyecto = $this->limpiarTexto($r['nombre_proyecto']);
            $tipo_participacion = $this->limpiarTexto($r['tipo_participacion']);
            $regional = $this->limpiarTexto($r['regional']);
            $centro_formacion = $this->limpiarTexto($r['centro_formacion']);
            $evaluadores = $this->limpiarTexto($r['evaluadores']);
            
            // Asegurar que los números sean numéricos
            $dominio = is_numeric($r['dominio_tematico']) ? $r['dominio_tematico'] : 0;
            $creatividad = is_numeric($r['creatividad_diseno']) ? $r['creatividad_diseno'] : 0;
            $problema = is_numeric($r['planteamiento_problema']) ? $r['planteamiento_problema'] : 0;
            $pertinencia = is_numeric($r['pertinencia_impacto']) ? $r['pertinencia_impacto'] : 0;
            $objetivos = is_numeric($r['objetivos']) ? $r['objetivos'] : 0;
            $metodologia = is_numeric($r['metodologia']) ? $r['metodologia'] : 0;
            $resultados = is_numeric($r['resultados']) ? $r['resultados'] : 0;
            $bibliografia = is_numeric($r['bibliografia']) ? $r['bibliografia'] : 0;
            $total_suma = is_numeric($r['total_suma']) ? $r['total_suma'] : 0;
            $resultado_final = is_numeric($r['resultado_final']) ? $r['resultado_final'] : 0;
            $cantidad_eval = is_numeric($r['cantidad_evaluadores']) ? $r['cantidad_evaluadores'] : 0;
            
            echo "<tr> 
                <td>{$nombre_proyecto}</td> 
                <td>{$tipo_participacion}</td>
                <td>{$regional}</td> 
                <td>{$centro_formacion}</td> 
                <td>{$evaluadores}</td> 
                <td>{$cantidad_eval}</td>
                <td>{$dominio}</td> 
                <td>{$creatividad}</td> 
                <td>{$problema}</td> 
                <td>{$pertinencia}</td> 
                <td>{$objetivos}</td> 
                <td>{$metodologia}</td> 
                <td>{$resultados}</td> 
                <td>{$bibliografia}</td> 
                <td><b>{$total_suma}</b></td> 
                <td><b>{$resultado_final}</b></td> 
            </tr>"; 
        } 

        echo "</table></body></html>"; 
        exit;
    }

    // ✅ EXPORTAR EXCEL PONENCIA
    private function exportarPonenciaExcel($id_evaluador = null, $id_proyecto = null, $prefix = "Calificaciones_Ponencia_") {
        $datos = $this->calificacion->obtenerCalificacionesPonencia($id_evaluador, $id_proyecto);
        
        if (empty($datos)) {
            die("No hay datos para exportar");
        }

        header("Content-Type: application/vnd.ms-excel; charset=Windows-1252");
        header("Content-Disposition: attachment; filename=" . $prefix . date('Ymd_His') . ".xls"); 
        header("Pragma: no-cache"); 
        header("Expires: 0"); 

        echo '<!DOCTYPE html>
        <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=Windows-1252">
            <title>Calificaciones Ponencia SENA</title>
            <style>
                th { 
                    background:#0C6C3C; 
                    color:white; 
                    font-weight:bold; 
                    padding:6px; 
                    font-family: Arial;
                    font-size: 12px;
                } 
                td { 
                    border:1px solid #bbb; 
                    padding:5px; 
                    text-align:center; 
                    font-family: Arial;
                    font-size: 11px;
                } 
                tr:nth-child(even) { 
                    background:#EAF3ED; 
                }
            </style> 
        </head> 
        <body> 
            <table border="1" cellpadding="3" cellspacing="0" width="100%"> 
            <tr> 
                <th>Proyecto</th> 
                <th>Tipo Participacion</th>
                <th>Regional</th> 
                <th>Centro</th> 
                <th>Evaluadores</th> 
                <th>Cant. Eval</th>
                <th>Titulo Presentacion</th> 
                <th>Planteamiento Justificacion</th> 
                <th>Objetivos</th> 
                <th>Marco Teorico</th> 
                <th>Metodologia</th> 
                <th>Resultados Analisis</th> 
                <th>Conclusiones Aportes</th> 
                <th>Impacto Aplicabilidad</th> 
                <th>Innovacion Creatividad</th> 
                <th>Presentacion Oral</th> 
                <th>Manejo Publico</th> 
                <th>Apoyo Visual</th> 
                <th>Suma Total</th> 
                <th>Resultado Final</th> 
            </tr> 
        '; 

        foreach ($datos as $r) { 
            // Limpiar todos los textos
            $nombre_proyecto = $this->limpiarTexto($r['nombre_proyecto']);
            $tipo_participacion = $this->limpiarTexto($r['tipo_participacion']);
            $regional = $this->limpiarTexto($r['regional']);
            $centro_formacion = $this->limpiarTexto($r['centro_formacion']);
            $evaluadores = $this->limpiarTexto($r['evaluadores']);
            
            // Asegurar que los números sean numéricos
            $titulo_presentacion = is_numeric($r['titulo_presentacion']) ? $r['titulo_presentacion'] : 0;
            $planteamiento_justificacion = is_numeric($r['planteamiento_justificacion']) ? $r['planteamiento_justificacion'] : 0;
            $objetivos = is_numeric($r['objetivos']) ? $r['objetivos'] : 0;
            $marco_teorico = is_numeric($r['marco_teorico']) ? $r['marco_teorico'] : 0;
            $metodologia = is_numeric($r['metodologia']) ? $r['metodologia'] : 0;
            $resultados_analisis = is_numeric($r['resultados_analisis']) ? $r['resultados_analisis'] : 0;
            $conclusiones_aportes = is_numeric($r['conclusiones_aportes']) ? $r['conclusiones_aportes'] : 0;
            $impacto_aplicabilidad = is_numeric($r['impacto_aplicabilidad']) ? $r['impacto_aplicabilidad'] : 0;
            $innovacion_creatividad = is_numeric($r['innovacion_creatividad']) ? $r['innovacion_creatividad'] : 0;
            $presentacion_oral = is_numeric($r['presentacion_oral']) ? $r['presentacion_oral'] : 0;
            $manejo_publico = is_numeric($r['manejo_publico']) ? $r['manejo_publico'] : 0;
            $apoyo_visual = is_numeric($r['apoyo_visual']) ? $r['apoyo_visual'] : 0;
            $total_suma = is_numeric($r['total_suma']) ? $r['total_suma'] : 0;
            $resultado_final = is_numeric($r['resultado_final']) ? $r['resultado_final'] : 0;
            $cantidad_eval = is_numeric($r['cantidad_evaluadores']) ? $r['cantidad_evaluadores'] : 0;
            
            echo "<tr> 
                <td>{$nombre_proyecto}</td> 
                <td>{$tipo_participacion}</td>
                <td>{$regional}</td> 
                <td>{$centro_formacion}</td> 
                <td>{$evaluadores}</td> 
                <td>{$cantidad_eval}</td>
                <td>{$titulo_presentacion}</td> 
                <td>{$planteamiento_justificacion}</td> 
                <td>{$objetivos}</td> 
                <td>{$marco_teorico}</td> 
                <td>{$metodologia}</td> 
                <td>{$resultados_analisis}</td> 
                <td>{$conclusiones_aportes}</td> 
                <td>{$impacto_aplicabilidad}</td> 
                <td>{$innovacion_creatividad}</td> 
                <td>{$presentacion_oral}</td> 
                <td>{$manejo_publico}</td> 
                <td>{$apoyo_visual}</td> 
                <td><b>{$total_suma}</b></td> 
                <td><b>{$resultado_final}</b></td> 
            </tr>"; 
        } 

        echo "</table></body></html>"; 
        exit;
    }
}

// ✅ USO DEL CONTROLADOR
session_start();
if (!isset($_SESSION["id_evaluador"])) {
    die("No tiene permisos para esta acción");
}

$controller = new ExportController();

if (isset($_GET["id_proyecto"])) {
    // Exportar proyecto individual según su tipo
    $controller->exportarPorProyecto($_GET["id_proyecto"]);
} elseif (isset($_GET["id_evaluador"])) {
    // Exportar todos los proyectos del evaluador
    $controller->exportarTodos($_GET["id_evaluador"]);
} else {
    die("Parámetros inválidos");
}
?>
