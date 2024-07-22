<?php
include("../models/mconsultas.php");

$consulta = new Consultas(); // Objecto

if(isset($_POST['nomeven'])){
    $nom_even= (isset($_POST['nomeven']) ? $_POST['nomeven']:NULL);
    $nom_per= (isset($_POST['person']) ? $_POST['person']:NULL);
    $fecha= (isset($_POST['fechaxxx']) ? $_POST['fechaxxx']:NULL);
    
    $saveUser = $consulta->calendario($nom_even,$nom_per,$fecha);
        
    if($saveUser){
        if (session_status() !== PHP_SESSION_ACTIVE) {
        // Si no está iniciada, la iniciamos
            session_start();
        };
        echo "<script>location.href='../views/calendario.php'</script>";
    }
}

?>