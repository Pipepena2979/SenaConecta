<?php
    include("../models/mconsultas.php");
   
    $consulta = new Consultas(); // Objecto

    if (session_status() !== PHP_SESSION_ACTIVE) {
        // Si no está iniciada, la iniciamos
        session_start();
    }


    if(isset($_GET['asignacionIns'])){
         
        $nDoc = $_SESSION['num_doc'];
        if($_SESSION['rol'] == 3){
            $convocatorias = $consulta->asignacionesInstructor($nDoc);
            if(isset($convocatorias)){
                $_SESSION['asignacionesInstructor'] = $convocatorias;
            } 
        }
        echo "<script>location.href='../views/asignaciones.php'</script>";

    }
?>