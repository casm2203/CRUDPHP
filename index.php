<?php


require_once "controladores/plantilla.ctrl.php";
require_once "controladores/formulario.ctrl.php";
require_once "modelos/formularios.modelos.php";

$plantilla = new controladorPlantilla();
$plantilla->crtlTraerPlantilla();






/* Probar conexion a la BD
require_once "modelos/conexion.php";

$conexion = Conexion::conectar();
echo '<pre>';
print_r($conexion);
echo '</pre>';
*/