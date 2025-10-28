<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("../config/database.php");

$database = new Database();
$db = $database->conectar();

if ($db) {
    echo "✅ Conexión exitosa a la base de datos.";
} else {
    echo "❌ Error de conexión.";
}
?>
