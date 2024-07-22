<?php 

    include('../models/mconsultamensaje.php');

    $consultamensajes = new Consultasmensaje;

    if (session_status() !== PHP_SESSION_ACTIVE) {
        // Si no está iniciada, la iniciamos
        session_start();
    }

    $mensajes = $consultamensajes->traermensaje($_SESSION['num_doc']);

    $tipomensaje = $consultamensajes->tipomensaje();

    if(isset($_GET['borrar'])){
        $borrarleidos = $consultamensajes-> borrarleidos();
        if($borrarleidos){
        echo "<script>alert('mensajes borrados')</script>";
        echo "<script>location.href='../views/menu.php'</script>";
        }
    }

    if(isset($_POST['tituloMensaje'])){

        if (session_status() !== PHP_SESSION_ACTIVE) {
            // Si no está iniciada, la iniciamos
            session_start();
        }
        $ti = trim(isset($_POST['tituloMensaje']) ? $_POST['tituloMensaje']:NULL);   
            if(!empty($ti)){
                $stre = strlen($ti);
                if($stre <= 50){
                    $ti1 = strtolower($ti);
                    $tituloMensaje = ucfirst($ti1);
                    $tipoMensaje = trim(isset($_POST['tipoMensaje']) ? $_POST['tipoMensaje']:NULL);
                        if(!empty($tipoMensaje)){
                            if(is_numeric($tipoMensaje)){
                                $consultarTipoMensaje = $consultamensajes->consultarTipoMensaje($tipoMensaje);
                                    if($consultarTipoMensaje){
                                        $men = trim(isset($_POST['mensaje']) ? $_POST['mensaje']:NULL);
                                            if(!empty($men)){
                                                $men1 = strtolower($men);
                                                $mensaje = ucfirst($men1);
                                                
                                                $emisor = $_SESSION['num_doc'];
                                                date_default_timezone_set("America/Bogota");
                                                $fechaEnvio = date("Y-m-d h:i:s");

                                                $receptor = trim(isset($_POST['receptor']) ? $_POST['receptor']:NULL);

                                                if(!empty($receptor)){
                                                    if(is_numeric($receptor)){
                                                        $consultarReceptor = $consultamensajes->consultarReceptor($receptor);
                                                            if($consultarReceptor){
                                                                $guardarMensaje = $consultamensajes->guardarMensaje($tituloMensaje,$tipoMensaje,$mensaje,$emisor,$receptor,$fechaEnvio);

                                                                if($guardarMensaje){
                                                                    $_SESSION['modalMensaje']=true;
                                                                    unset($_SESSION['error']);
                                                                    $_SESSION['tipo_alert_Mensaje']="success";
                                                                    $_SESSION['mensajeMensaje']="Mensaje enviado correctamente";
                                                                    echo "<script>location.href='../views/instructores.php'</script>";
                                                                }else{
                                                                    $_SESSION['modalMensaje']=true;
                                                                    $_SESSION['tipo_alert_Mensaje']="danger";
                                                                    $_SESSION['mensajeMensaje']="Error al enviar el mensaje, intenta otra vez";
                                                                    echo "<script>location.href='../views/instructores.php'</script>";
                                                                }
                                                                
                                                            }else{
                                                                $_SESSION['modalMensaje']=true;
                                                                $_SESSION['error']=true;
                                                                $_SESSION['tipo_alert_Mensaje']="danger";
                                                                $_SESSION['mensajeMensaje']="Error, intenta enviarlo otra vez";
                                                                echo "<script>location.href='../views/instructores.php'</script>";
                                                            }  
                                                    }else{
                                                        $_SESSION['modalMensaje']=true;
                                                        $_SESSION['error']=true;
                                                        $_SESSION['tipo_alert_Mensaje']="danger";
                                                        $_SESSION['mensajeMensaje']="Error, intenta enviarlo otra vez";
                                                        echo "<script>location.href='../views/instructores.php'</script>";
                                                    }
                                                }else{
                                                    $_SESSION['modalMensaje']=true;
                                                    $_SESSION['error']=true;
                                                    $_SESSION['tipo_alert_Mensaje']="danger";
                                                    $_SESSION['mensajeMensaje']="Error, intenta enviarlo otra vez";
                                                    echo "<script>location.href='../views/instructores.php'</script>";
                                                }     
                                            }else{
                                                $_SESSION['modalMensaje']=true;
                                                $_SESSION['error']=true;
                                                $_SESSION['tipo_alert_Mensaje']="danger";
                                                $_SESSION['mensajeMensaje']="Ingresa el mensaje a enviar";
                                                echo "<script>location.href='../views/instructores.php'</script>";
                                            }
                                    }else{
                                        $_SESSION['modalMensaje']=true;
                                        $_SESSION['error']=true;
                                        $_SESSION['tipo_alert_Mensaje']="danger";
                                        $_SESSION['mensajeMensaje']="El tipo de mensaje es inexistente";
                                        echo "<script>location.href='../views/instructores.php'</script>";
                                    }
                            }else{
                                $_SESSION['modalMensaje']=true;
                                $_SESSION['error']=true;
                                $_SESSION['tipo_alert_Mensaje']="danger";
                                $_SESSION['mensajeMensaje']="Error en el tipo de mensaje";
                                echo "<script>location.href='../views/instructores.php'</script>";
                            }
                        }else{
                            $_SESSION['modalMensaje']=true;
                            $_SESSION['error']=true;
                            $_SESSION['tipo_alert_Mensaje']="danger";
                            $_SESSION['mensajeMensaje']="Selecciona el tipo de mensaje";
                            echo "<script>location.href='../views/instructores.php'</script>";
                        }
                }else{
                    $_SESSION['modalMensaje']=true;
                    $_SESSION['error']=true;
                    $_SESSION['tipo_alert_Mensaje']="danger";
                    $_SESSION['mensajeMensaje']="El titulo del mensaje no debe ser superior a 50 caracteres";
                    echo "<script>location.href='../views/instructores.php'</script>";
                }
            }else{
                $_SESSION['modalMensaje']=true;
                $_SESSION['error']=true;
                $_SESSION['tipo_alert_Mensaje']="danger";
                $_SESSION['mensajeMensaje']="Ingrese el titulo del mensaje";
                echo "<script>location.href='../views/instructores.php'</script>";
            }
    }

?>