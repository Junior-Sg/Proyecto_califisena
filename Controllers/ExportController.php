<?php
require_once("../Models/Calificacion.php");

class ExportController {
    public function generarExcel() {
        $calificacion = new Calificacion();
        $datos = $calificacion->obtenerCalificaciones();

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=Calificaciones_SENA.xls");

        echo "Proyecto\tEvaluador\tDominio\tFormato\tCreatividad\tIntroducción\tProblema\tObjetivos\tTotal\n";
        foreach ($datos as $fila) {
            echo "{$fila['Proyecto']}\t{$fila['Evaluador']}\t{$fila['Dominio']}\t{$fila['Formato']}\t{$fila['Creatividad']}\t{$fila['Introduccion']}\t{$fila['Problema']}\t{$fila['Objetivos']}\t{$fila['Total']}\n";
        }
    }
}
?>
