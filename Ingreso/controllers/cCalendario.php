<?php
    include("../models/mconsultas.php");
   
    $consulta = new Consultas(); // Objecto

    // Abrir calendario usuario
    if(isset($_GET['usu'])){ 
        if (session_status() !== PHP_SESSION_ACTIVE) {
            // Si no está iniciada, la iniciamos
            session_start();
        }
        $nDoc = $_GET['usu'];
        $consultarUsuario = $consulta->consultarUsuarioCalendario($nDoc);
        if($consultarUsuario){
            $_SESSION['calendarioUsuario'] =  $consultarUsuario;
            
            echo "<script>location.href='../views/calendario.php'</script>";
        }else{
            $_SESSION['tipo_alert']="danger";
            $_SESSION['mensaje']="Usuario inexistente, intente otra vez";
            echo "<script>location.href='../views/instructores.php'</script>";
        }
    }
    // Fin de Abrir calendario usuario

    // Abrir calendario curso
    if(isset($_GET['curso'])){ 
        if (session_status() !== PHP_SESSION_ACTIVE) {
            // Si no está iniciada, la iniciamos
            session_start();
        }
        $codigoCurso = $_GET['curso'];
        $consultarUsuario = $consulta->consultarCursoCalendario($codigoCurso);
        if($consultarUsuario){
            $_SESSION['calendarioCurso'] =  $consultarUsuario;
            echo "<script>location.href='../views/calendarioCursos.php'</script>";
        }else{
            $_SESSION['tipo_alert']="danger";
            $_SESSION['mensaje']="Curso inexistente, intente otra vez";
            echo "<script>location.href='../views/cursos.php'</script>";
        }
    }
    // Fin de Abrir calendario curso

?>