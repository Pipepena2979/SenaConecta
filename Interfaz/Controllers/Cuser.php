<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    // Si no está iniciada, la iniciamos
    session_start();
}

include('Muser.php');



$ndocumento= (isset($_POST['documento']) ?$_POST['documento']:null);
$contrasena= (isset($_POST['contra']) ?$_POST['contra']:null);


if($ndocumento !="" && $contrasena !=""){
    // $secret = "6LcoZQgpAAAAAJ8AmG0-tXiFSjpyg4I_opKIcJW7";
    // $response = $_POST['g-recaptcha-response'];
    // $remoteip = $_SERVER['REMOTE_ADDR'];
    // $url ="https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip";
    // $data = file_get_contents($url);
    // $row = json_decode($data, true);
    
    // if($row['success'] == "true"){
        if(is_numeric($ndocumento)){
        $user = new Usuario();
        $acesso = $user->login($ndocumento);
        $pass= sha1(md5($contrasena));   
            if($acesso){
                date_default_timezone_set("America/Bogota");
                $fecha = date("Y-m-d");
                if($pass==$acesso[0]['contrasena']){
                    if($fecha > $acesso[0]['fechaFinContrato']){
                        $_SESSION['modal']=true;
                        $_SESSION['tipo_alert_Login']="danger";
                        $_SESSION['mensajeLogin']="Querido usuario/a usted no puede acceder por qué su contrato ya se venció";
                        echo "<script>location.href='../index.php'</script>"; 
                    }else{
                        date_default_timezone_set("America/Bogota");
                        $fechaS = date("Y-m-d h:i:s");
                        $fechaControl = $user->fechaControl($acesso[0]['num_doc'],$fechaS);
                        $fechaSession = $user->fechaSession($fechaS,$acesso[0]['num_doc']);
                        $_SESSION['id']=$acesso[0]['id'];
                        $_SESSION['T_doc']=$acesso[0]['T_doc'];
                        $_SESSION['num_doc']=$acesso[0]['num_doc'];
                        $_SESSION['genero']=$acesso[0]['genero'];
                        $_SESSION['rol']=$acesso[0]['rol'];
                        $_SESSION['Correo']=$acesso[0]['Correo'];
                        $_SESSION['nombres']=$acesso[0]['nombres'];
                        $_SESSION['apellidos']=$acesso[0]['apellidos'];
                        $_SESSION['fechaNacimiento']=$acesso[0]['fechaNacimiento'];
                        $_SESSION['Telefono']=$acesso[0]['Telefono'];
                        $_SESSION['contrasena']=$acesso[0]['contrasena'];
                        $_SESSION['departamentoUsu']=$acesso[0]['departamento'];
                        if(!empty($_SESSION['departamentoUsu'])){
                            $municipios = $user->municipios($_SESSION['departamentoUsu']);
                            $_SESSION['arrayMunicipios'] = $municipios;
                        }
                        $_SESSION['municipioUsu']=$acesso[0]['municipio'];
                        $_SESSION['foto']=$acesso[0]['foto'];    
                        $_SESSION['fechaFinContrato']=$acesso[0]['fechaFinContrato'];
                        


                        $date1 = new DateTime($fecha);
                        $date2 = new DateTime($acesso[0]['fechaFinContrato']);
                        $diff = $date1->diff($date2);
                        $dias = $diff->days;
                        if($dias >= 0 && $dias <=5){           
                            $_SESSION['alertaContrato'] = $dias;
                        }
                        

                        echo "<script>location.href='../../Ingreso/index.php'</script>";
                    } 
                }else{
                    // echo "<script>alert('entro')</script>";
                    $_SESSION['modal']=true;
                    $_SESSION['tipo_alert_Login']="danger";
                    $_SESSION['mensajeLogin']="Contraseña Incorrecta";
                    echo "<script>location.href='../index.php'</script>";         
                }
            }else{
                // echo "<script>alert('entro')</script>";
                $_SESSION['modal']=true;
                $_SESSION['tipo_alert_Login']="danger";
                $_SESSION['mensajeLogin']="Usuario no existe";
                echo "<script>location.href='../index.php'</script>";
            }
        }else{
            // echo "<script>alert('entro')</script>";
            $_SESSION['modal']=true;
            $_SESSION['tipo_alert_Login']="danger";
            $_SESSION['mensajeLogin']="Ingrese su número de documento";
            echo "<script>location.href='../index.php'</script>";
        }
    // }else{
    //     $_SESSION['modal']=true;
    //     $_SESSION['tipo_alert_Login']="danger";
    //     $_SESSION['mensajeLogin']="Verifica que no eres un robot";
    //     echo "<script>location.href='../index.php'</script>";
    // }
}else{
    // echo "<script>alert('entro')</script>";
    $_SESSION['modal']=true;
    $_SESSION['tipo_alert_Login']="danger";
    $_SESSION['mensajeLogin']="Ingrese todos los campos";
    echo "<script>location.href='../index.php'</script>";
}

?>