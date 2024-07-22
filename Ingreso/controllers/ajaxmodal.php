<?php

    include('../models/mconsultamensaje.php');

    $consulta = new Consultasmensaje();

    if($_POST['id'] && $_POST['estado']){
        if($_POST['estado'] == 'noleido'){
        $identrada = $_POST['id'];
        $newestado = "leido";
        // Hora actual
        date_default_timezone_set('America/Bogota');
        $fechaleido = date('Y-m-d H:i:s ', time());
        $mensajeleido = $consulta->mensajeleido($identrada,$newestado,$fechaleido);

        if($mensajeleido){
            echo "<script>console.log($identrada)</script>";
        }
        }else{
            echo "-> Ya leido";
        }

    }

?>