<?php
    include("../models/mconsultas.php");
   
    $consulta = new Consultas(); // Objecto

    
    $tAmbiente = $consulta->mostrarambiente();
    if (session_status() !== PHP_SESSION_ACTIVE) {
            // Si no está iniciada, la iniciamos
            session_start();
    }

// registrar ambiente
    if (isset($_POST['ambiente'])){
        $amb= trim((isset($_POST['ambiente']) ? $_POST['ambiente']:NULL));
        if (!empty($amb)){
            $amb1 = strtolower($amb);
            $ambiente = ucwords($amb1);
            $validarAmbiente = $consulta->validarAmbiente($ambiente);
            if (!$validarAmbiente) {
                $insertAmbiente = $consulta->insertAmbiente($ambiente);
                if ($insertAmbiente) {
                    $_SESSION['tipo_alert_ambiente']="success";
                    $_SESSION['mensaje_ambiente']=" Ambiente registrado correctamente ";
                    echo "<script>location.href='../views/Ambiente.php'</script>";
                }else{
                    $_SESSION['tipo_alert_ambiente']="danger";
                    $_SESSION['mensaje_ambiente']=" No se pudo registrar el ambiente ";
                    echo "<script>location.href='../views/Ambiente.php'</script>";
                }
            }else{
                $_SESSION['tipo_alert_ambiente']="danger";
                $_SESSION['mensaje_ambiente']=" Este ambiente ya existe";
                echo "<script>location.href='../views/Ambiente.php'</script>";
            }
        }else{
            $_SESSION['tipo_alert_ambiente']="danger";
            $_SESSION['mensaje_ambiente']=" Ingrese un Ambiente ";
            echo "<script>location.href='../views/Ambiente.php'</script>";
        }
    }

// editar ambiente
    if (isset($_POST['eAmbiente'])) {
        $eAmb = trim((isset($_POST['eAmbiente']) ? $_POST['eAmbiente']:NULL));
        if (!empty($eAmb)) {
            $eAmb1 = strtolower($eAmb);
            $eAmbiente = ucwords($eAmb1);
            $validarAmbiente = $consulta->validarAmbiente($eAmbiente);
            if ($validarAmbiente == false ) {
                if (isset($_SESSION['consultaAmbiente'][0]['id'])) {
                    $updateAmbiente = $consulta->updateAmbiente($eAmbiente,$_SESSION['consultaAmbiente'][0]['id']);
                    if ($updateAmbiente) {
                        unset($_SESSION['consultaAmbiente']);
                        $_SESSION['tipo_alert_ambiente']="success";
                        $_SESSION['mensaje_ambiente']=" Ambiente actualizado correctamente ";
                        echo "<script>location.href='../views/Ambiente.php'</script>";
                    }else{
                        $_SESSION['tipo_alert_ambiente']="danger";
                        $_SESSION['mensaje_ambiente']=" Error al actualizar el ambiente  ";
                        echo "<script>location.href='../views/Ambiente.php'</script>";
                    }
                }else{
                    $_SESSION['tipo_alert_ambiente']="danger";
                    $_SESSION['mensaje_ambiente']="Por favor no dañar el sistema";
                    echo "<script>location.href='../views/Ambiente.php'</script>";
                }
            }elseif($validarAmbiente[0]['ambiente'] === $_SESSION['consultaAmbiente'][0]['ambiente']){
                unset($_SESSION['consultaAmbiente']);
                echo "<script>location.href='../views/Ambiente.php'</script>";
            }else{
                $_SESSION['tipo_alert_ambiente']="danger";
                $_SESSION['mensaje_ambiente']=" Error ambiente ya existente ";
                echo "<script>location.href='../views/Ambiente.php'</script>";
            }
        }else{
            $_SESSION['tipo_alert_ambiente']="danger";
            $_SESSION['mensaje_ambiente']=" Ingrese un Ambiente ";
            echo "<script>location.href='../views/Ambiente.php'</script>";
        }

    }


// controlador de editar
    if(isset($_GET['eAmbiente'])){ 
        if (session_status() !== PHP_SESSION_ACTIVE) {
            // Si no está iniciada, la iniciamos
            session_start();
        }
        $eAmbiente = $_GET['eAmbiente'];
        if (isset($eAmbiente)) {
            if (!empty($eAmbiente)) {
                $nAmbiente = $_GET['nAmbiente'];
                if(isset($nAmbiente)) {
                    if (!empty($nAmbiente)) {
                        $consultaAmbiente = $consulta->consultarAmbiente($eAmbiente,$nAmbiente);
                        if($consultaAmbiente) {
                            $_SESSION['consultaAmbiente'] =  $consultaAmbiente;
                            echo "<script>location.href='../views/Ambiente.php'</script>";
                        }else{
                            
                        }
                    }else{

                    }
                }else{

                }
            }else{

            }
        }else{

        }
    }





// cancelar editar
    if(isset($_GET['cancelEdit'])){ 
        if (session_status() !== PHP_SESSION_ACTIVE) {
            // Si no está iniciada, la iniciamos
            session_start();
        }
        $cancelEdit = $_GET['cancelEdit'];
        if (isset($cancelEdit)) {
            if (!empty($cancelEdit)) {
                unset($_SESSION['consultaAmbiente']);
                echo "<script>location.href='../views/Ambiente.php'</script>";
            }else{

            }
        }else{

        }
    }




//Eliminar Ambiente 
if(isset($_GET['eliminarAmbiente'])){ 
    if (session_status() !== PHP_SESSION_ACTIVE) {
        // Si no está iniciada, la iniciamos
        session_start();
    }
    $id = trim($_GET['eliminarAmbiente']);
        if (!empty($id)) {
            if (is_numeric($id)) {
                $consultarAmbiente = $consulta->validarAmbiente2($id);
                if($consultarAmbiente){
                    $eliminarAmbiente = $consulta->eliminarAmbiente($id);
                    if($eliminarAmbiente){
                        $_SESSION['tipo_alert_ambiente']="success";
                        $_SESSION['mensaje_ambiente']="Ambiente eliminado correctamente";
                        echo "<script>location.href='../views/Ambiente.php'</script>"; 
                        
                    }else{
                        $_SESSION['tipo_alert_ambiente']="danger";
                        $_SESSION['mensaje_ambiente']="Error al eliminar el ambiente, intente otra vez";
                        echo "<script>location.href='../views/Ambiente.php'</script>";
                    }     
                    }else{
                        $_SESSION['tipo_alert_ambiente']="danger";
                        $_SESSION['mensaje_ambiente']="El ambiente a eliminar no existe";
                        echo "<script>location.href='../views/Ambiente.php'</script>";
                    }
                }else{
                    $_SESSION['tipo_alert_ambiente']="danger";
                    $_SESSION['mensaje_ambiente']="Error intente de nuevo";
                    echo "<script>location.href='../views/Ambiente.php'</script>";
            }
        }else {
            $_SESSION['tipo_alert_ambiente']="danger";
            $_SESSION['mensaje_ambiente']="Error intente de nuevo";
            echo "<script>location.href='../views/Ambiente.php'</script>";
        }
    }

    
?>