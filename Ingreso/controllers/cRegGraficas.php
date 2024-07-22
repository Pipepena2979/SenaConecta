<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    // Si no está iniciada, la iniciamos
    session_start();
}
    include("../models/mconsultas.php");
   
    $consulta = new Consultas(); // Objecto


    $asignaciones=$consulta->asignaciones(); 
    $registros=$consulta->registros();
    $sesion=$consulta->sesion();

    $coordinadorMisional=$consulta->contarCoordinadorMisional(); 
    $coordinador=$consulta->contarCoordinador(); 
    $instructores=$consulta->contarInstructores(); 


    $femenino =$consulta->contarFemenino(); 
    $masculino =$consulta->contarMasculino(); 
    $otros =$consulta->contarOtros(); 


    $asignacionesCoordinador =$consulta->asignacionesCoordinador();


    $asignaciones_ins = $consulta->asignaciones_ins($_SESSION["num_doc"]);

    // total cursos por cada jornada 
    $cursos_mañana = $consulta->cursos_mañana();
    $cursos_tarde = $consulta->cursos_tarde();
    $cursos_noche = $consulta->cursos_noche();
    $cursos_fin_semana = $consulta->cursos_fin_semana();
    $cursos_virtual = $consulta->cursos_virtual();
?>