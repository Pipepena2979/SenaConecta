<?php

    include("./Muser.php");
   
    $consulta = new Usuario(); 

    if (session_status() !== PHP_SESSION_ACTIVE) {
        // Si no está iniciada, la iniciamos
        session_start();
    }

    if(isset($_POST['nombre'])){
        $nombre = trim(isset($_POST['nombre']) ? $_POST['nombre']:NULL);
            if(!empty($nombre)){
                $n = strtolower($nombre);
                $n2 = ucwords($n);
                $email = trim(isset($_POST['email']) ? $_POST['email']:NULL);
                    if(!empty($email)){
                        $subject = trim(isset($_POST['subject']) ? $_POST['subject']:NULL);
                            if(!empty($subject)){
                                $med = strlen($subject);
                                    if($med <= 25){
                                        $s = strtolower($subject);
                                        $s1 = ucfirst($subject);
                                        $message = trim(isset($_POST['message']) ? $_POST['message']:NULL);
                                            if(!empty($message)){
                                                $m = strtolower($message);
                                                $m1 = ucfirst($m);
                                                date_default_timezone_set("America/Bogota");
                                                $fechaRegistro = date("Y-m-d h:i:s");
                                                $contacto = $consulta->contacto($n2,$email,$s1,$m1,$fechaRegistro);
                                                    if($contacto){
                                                        // echo "<script>alert('entro')</script>";
                                                        $_SESSION['modalContacto']="si";
                                                        $_SESSION['mensajeContacto']="Formulario de contacto enviado correctamente";
                                                        $_SESSION['boton']="success";
                                                        echo "<script>location.href='../interfaz.php'</script>";
                                                    }else{
                                                        $_SESSION['modalContacto']="si";
                                                        $_SESSION['mensajeContacto']="Error, por favor intente otra vez";
                                                        $_SESSION['boton']="danger";
                                                        echo "<script>location.href='../interfaz.php'</script>";
                                                    }
                                            }else{
                                                $_SESSION['modalContacto']="si";
                                                $_SESSION['mensajeContacto']="Por favor ingrese un mensaje";
                                                $_SESSION['boton']="danger";
                                                echo "<script>location.href='../interfaz.php'</script>";
                                            }
                                    }else{
                                        $_SESSION['modalContacto']="si";
                                        $_SESSION['mensajeContacto']="Por favor no ingrese un asunto mayor a 25 caracteres";
                                        $_SESSION['boton']="danger";
                                        echo "<script>location.href='../interfaz.php'</script>";
                                    }
                            }else{
                                $_SESSION['modalContacto']="si";
                                $_SESSION['mensajeContacto']="Por favor ingrese un asunto";
                                $_SESSION['boton']="danger";
                                echo "<script>location.href='../interfaz.php'</script>";
                            }
                    }else{
                        $_SESSION['modalContacto']="si";
                        $_SESSION['mensajeContacto']="Por favor ingrese su correo electrónico";
                        $_SESSION['boton']="danger";
                        echo "<script>location.href='../interfaz.php'</script>";
                    }
            }else{
                $_SESSION['modalContacto']="si";
                $_SESSION['mensajeContacto']="Por favor ingrese su usuario";
                $_SESSION['boton']="danger";
                echo "<script>location.href='../interfaz.php'</script>";
            }
    }

?>