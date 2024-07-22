<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    // Si no está iniciada, la iniciamos
    session_start();
}
include("../models/mconsultas.php");

$consulta = new Consultas(); // Objecto

    $instructores = $consulta->instructores();
    $instructores2 = $consulta->instructores2($_SESSION["num_doc"]);
    $coordinadoresT = $consulta->coordinadoresT();
    $tipomensaje = $consulta->tipomensaje();
    $cursos =  $consulta->cursos();
    $contacto =  $consulta->contacto();

?>