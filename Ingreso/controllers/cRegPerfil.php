<?php
    include("../models/mconsultas.php");
   
    $consulta = new Consultas(); // Objecto


    if (session_status() !== PHP_SESSION_ACTIVE) {
        // Si no está iniciada, la iniciamos
        session_start();
    }

    if(isset($_POST['eNombres'])){
        $nDoc =  $_SESSION['num_doc'];
        $eNombres = trim(isset($_POST['eNombres']) ? $_POST['eNombres']:NULL);
        if($eNombres != ""){
            $eN1 = strtolower($eNombres);
            $eN2 = ucwords($eN1);
            $eApellidos = trim(isset($_POST['eApellidos']) ? $_POST['eApellidos']:NULL);
            if($eApellidos !=""){
                $eA1 = strtolower($eApellidos);
                $eA2 = ucwords($eA1);
                $eCorreo = trim(isset($_POST['eCorreo']) ? $_POST['eCorreo']:NULL);
                if($eCorreo !=""){
                    $eTel = trim(isset($_POST['eTel']) ? $_POST['eTel']:NULL);
                    if($eTel !=""){
                        if(is_numeric($eTel)){
                            $num = strlen($eTel);
                            if($num == 10){
                                $eGenero = trim(isset($_POST['eGenero']) ? $_POST['eGenero']:NULL);
                                if(!empty($eGenero)){
                                    if(is_numeric($eGenero)){
                                        $consultarGenero = $consulta->consultarGenero($eGenero);
                                        if($consultarGenero){
                                            $eDepartamento = trim(isset($_POST['eDepartamento']) ? $_POST['eDepartamento']:NULL);
                                                if(!empty($eDepartamento)){
                                                    if(is_numeric($eDepartamento)){
                                                        $consultarDepartamento = $consulta->consultarDepartamento($eDepartamento);
                                                            if($consultarDepartamento){
                                                                $eCiudad = trim(isset($_POST['eCiudad']) ? $_POST['eCiudad']:NULL);
                                                                if(!empty($eCiudad)){
                                                                    if(is_numeric($eCiudad)){
                                                                        $consultarMunicipioD = $consulta->consultarMunicipioD($eDepartamento,$eCiudad);
                                                                            if($consultarMunicipioD){
                                                                                
                                                                                // consulta correo
                                                                                if($eCorreo == $_SESSION['Correo']){
                                                                                    if($eTel == $_SESSION['Telefono']){
                                                                                        $consulta->actualizarInformacion($eN2,$eA2,$eCorreo,$eTel,$eGenero,$eDepartamento,$eCiudad,$nDoc);
                                                                                            if($consulta){
                                                                                                $_SESSION['nombres']=$eN2;
                                                                                                $_SESSION['apellidos']=$eA2;
                                                                                                $_SESSION['Correo']=$eCorreo;
                                                                                                $_SESSION['Telefono']=$eTel;
                                                                                                $_SESSION['genero']=$eGenero;
                                                                                                $_SESSION['departamentoUsu']=$eDepartamento;
                                                                                                $_SESSION['municipioUsu']=$eCiudad;
                                                                                                $_SESSION['tipo_alert']="success";
                                                                                                $_SESSION['mensaje']="Información actualizada correctamente";
                                                                                                echo "<script>location.href='../views/perfil.php'</script>"; 
                                                                                            }else{
                                                                                                $_SESSION['tipo_alert']="danger";
                                                                                                $_SESSION['mensaje']="Error a actualizar sus datos, por favor intente otra vez";
                                                                                                echo "<script>location.href='../views/perfil.php'</script>"; 
                                                                                            }
                                                                                    }else{
                                                                                        $consultarTelefono = $consulta->consultarTelefono($eTel);

                                                                                            if($consultarTelefono){
                                                                                                $_SESSION['tipo_alert']="danger";
                                                                                                $_SESSION['mensaje']="El número teléfonico " . $eTel . " ya esta registrado con otro usuario";
                                                                                                echo "<script>location.href='../views/perfil.php'</script>";
                                                                                            }else{
                                                                                                $consulta->actualizarInformacion($eN2,$eA2,$eCorreo,$eTel,$eGenero,$eDepartamento,$eCiudad,$nDoc);
                                                                                                    if($consulta){
                                                                                                        $_SESSION['nombres']=$eN2;
                                                                                                        $_SESSION['apellidos']=$eA2;
                                                                                                        $_SESSION['Correo']=$eCorreo;
                                                                                                        $_SESSION['Telefono']=$eTel;
                                                                                                        $_SESSION['genero']=$eGenero;
                                                                                                        $_SESSION['departamentoUsu']=$eDepartamento;
                                                                                                        $_SESSION['municipioUsu']=$eCiudad;
                                                                                                        $_SESSION['tipo_alert']="success";
                                                                                                        $_SESSION['mensaje']="Información actualizada correctamente";
                                                                                                        echo "<script>location.href='../views/perfil.php'</script>"; 
                                                                                                    }else{
                                                                                                        $_SESSION['tipo_alert']="danger";
                                                                                                        $_SESSION['mensaje']="Error a actualizar sus datos, por favor intente otra vez";
                                                                                                        echo "<script>location.href='../views/perfil.php'</script>"; 
                                                                                                    }
                                                                                            }
                                                                                    }
                                                                                    
                                                                                }else{
                                                                                    $consultarCorreo = $consulta->consultarCorreo($eCorreo);
                                                                                    if($consultarCorreo){
                                                                                        $_SESSION['tipo_alert']="danger";
                                                                                        $_SESSION['mensaje']="El correo electrónico " . $eCorreo . " ya esta registrado con otro usuario";
                                                                                        echo "<script>location.href='../views/perfil.php'</script>";
                                                                                    }else{
                                                                                        if($eTel == $_SESSION['Telefono']){
                                                                                            $consulta->actualizarInformacion($eN2,$eA2,$eCorreo,$eTel,$eGenero,$eDepartamento,$eCiudad,$nDoc);
                                                                                                if($consulta){
                                                                                                    $_SESSION['nombres']=$eN2;
                                                                                                    $_SESSION['apellidos']=$eA2;
                                                                                                    $_SESSION['Correo']=$eCorreo;
                                                                                                    $_SESSION['Telefono']=$eTel;
                                                                                                    $_SESSION['genero']=$eGenero;
                                                                                                    $_SESSION['departamentoUsu']=$eDepartamento;
                                                                                                    $_SESSION['municipioUsu']=$eCiudad;
                                                                                                    $_SESSION['tipo_alert']="success";
                                                                                                    $_SESSION['mensaje']="Información actualizada correctamente";
                                                                                                    echo "<script>location.href='../views/perfil.php'</script>"; 
                                                                                                }else{
                                                                                                    $_SESSION['tipo_alert']="danger";
                                                                                                    $_SESSION['mensaje']="Error a actualizar sus datos, por favor intente otra vez";
                                                                                                    echo "<script>location.href='../views/perfil.php'</script>"; 
                                                                                                }
                                                                                        }else{
                                                                                            $consultarTelefono = $consulta->consultarTelefono($eTel);

                                                                                                if($consultarTelefono){
                                                                                                    $_SESSION['tipo_alert']="danger";
                                                                                                    $_SESSION['mensaje']="El número teléfonico " . $eTel . " ya esta registrado con otro usuario";
                                                                                                    echo "<script>location.href='../views/perfil.php'</script>";
                                                                                                }else{
                                                                                                    $consulta->actualizarInformacion($eN2,$eA2,$eCorreo,$eTel,$eGenero,$eDepartamento,$eCiudad,$nDoc);
                                                                                                        if($consulta){
                                                                                                            $_SESSION['nombres']=$eN2;
                                                                                                            $_SESSION['apellidos']=$eA2;
                                                                                                            $_SESSION['Correo']=$eCorreo;
                                                                                                            $_SESSION['Telefono']=$eTel;
                                                                                                            $_SESSION['genero']=$eGenero;
                                                                                                            $_SESSION['departamentoUsu']=$eDepartamento;
                                                                                                            $_SESSION['municipioUsu']=$eCiudad;
                                                                                                            $_SESSION['tipo_alert']="success";
                                                                                                            $_SESSION['mensaje']="Información actualizada correctamente";
                                                                                                            echo "<script>location.href='../views/perfil.php'</script>"; 
                                                                                                        }else{
                                                                                                            $_SESSION['tipo_alert']="danger";
                                                                                                            $_SESSION['mensaje']="Error a actualizar sus datos, por favor intente otra vez";
                                                                                                            echo "<script>location.href='../views/perfil.php'</script>"; 
                                                                                                        }
                                                                                                }
                                                                                        }
                                                                                        
                                                                                    }
                                                                                }    
                                                                            }else{
                                                                                $_SESSION['tipo_alert']="danger";
                                                                                $_SESSION['mensaje']="Error, intenta otra vez";
                                                                                echo "<script>location.href='../views/perfil.php'</script>";
                                                                            }
                                                                    }else{
                                                                        $_SESSION['tipo_alert']="danger";
                                                                        $_SESSION['mensaje']="Error";
                                                                        echo "<script>location.href='../views/perfil.php'</script>";
                                                                    }
                                                                }else{
                                                                    $_SESSION['tipo_alert']="danger";
                                                                    $_SESSION['mensaje']="Seleccione su ciudad o municipio de residencia";
                                                                    echo "<script>location.href='../views/perfil.php'</script>";
                                                                }
                                                            }else{
                                                                $_SESSION['tipo_alert']="danger";
                                                                $_SESSION['mensaje']="Error, intenta otra vez";
                                                                echo "<script>location.href='../views/perfil.php'</script>";
                                                            }
                                                    }else{
                                                        $_SESSION['tipo_alert']="danger";
                                                        $_SESSION['mensaje']="Error";
                                                        echo "<script>location.href='../views/perfil.php'</script>";
                                                    }
                                                }else{
                                                    $_SESSION['tipo_alert']="danger";
                                                    $_SESSION['mensaje']="Seleccione su departamento de residencia";
                                                    echo "<script>location.href='../views/perfil.php'</script>";
                                                }   
                                        }else{
                                            $_SESSION['tipo_alert']="danger";
                                            $_SESSION['mensaje']="Tipo de género no existente";
                                            echo "<script>location.href='../views/perfil.php'</script>";
                                        }
                                    }else{
                                        $_SESSION['tipo_alert']="danger";
                                        $_SESSION['mensaje']="Error en tipo de género";
                                        echo "<script>location.href='../views/perfil.php'</script>";
                                    }
                                }else{
                                    $_SESSION['tipo_alert']="danger";
                                    $_SESSION['mensaje']="Seleccione su tipo de género";
                                    echo "<script>location.href='../views/perfil.php'</script>"; 
                                }
                                
                            }else{
                                $_SESSION['tipo_alert']="danger";
                                $_SESSION['mensaje']="Ingrese un número telefonico valido";
                                echo "<script>location.href='../views/perfil.php'</script>"; 
                            }
                        }else{
                            $_SESSION['tipo_alert']="danger";
                            $_SESSION['mensaje']="Ingrese NUMEROS en el campo de numero telefonico";
                            echo "<script>location.href='../views/perfil.php'</script>"; 
                        }
                    }else{
                        $_SESSION['tipo_alert']="danger";
                        $_SESSION['mensaje']="Ingrese su número telefonico";
                        echo "<script>location.href='../views/perfil.php'</script>"; 
                    }
                }else{
                    $_SESSION['tipo_alert']="danger";
                    $_SESSION['mensaje']="Ingrese su correo electronico";
                    echo "<script>location.href='../views/perfil.php'</script>"; 
                }
            }else{
                $_SESSION['tipo_alert']="danger";
                $_SESSION['mensaje']="Ingrese sus apellidos";
                echo "<script>location.href='../views/perfil.php'</script>"; 
            }
        }else{
            $_SESSION['tipo_alert']="danger";
            $_SESSION['mensaje']="Ingrese sus nombres";
            echo "<script>location.href='../views/perfil.php'</script>";
        }
    }
    if(isset($_GET['contra'])){
        
        $_SESSION['perfil'] = 1;          
        echo "<script>location.href='../views/perfil.php'</script>";

    }
    if(isset($_GET['cancel'])){
        unset($_SESSION['perfil']);         
        echo "<script>location.href='../views/perfil.php'</script>";
    }

    if(isset($_POST['eContra1'])){
        $eContra1 = (isset($_POST['eContra1']) ? $_POST['eContra1']:NULL);
        $eContra2 = (isset($_POST['eContra2']) ? $_POST['eContra2']:NULL);

        if($eContra1 !=""){
            if($eContra2 !=""){
                if($eContra1 == $eContra2){
                    $pass= sha1(md5($eContra1));
                        if($pass == $_SESSION['contrasena']){
                            unset($_SESSION['perfil']);
                            $_SESSION['rContra'] = 1;          
                            echo "<script>location.href='../views/perfil.php'</script>";
                        }else{
                            $_SESSION['tipo_alertperfil']="danger";
                            $_SESSION['mensajeperfil']="Contraseña incorrecta";
                            echo "<script>location.href='../views/perfil.php'</script>";
                        }
                }else{
                    $_SESSION['tipo_alertperfil']="danger";
                    $_SESSION['mensajeperfil']="Los campos no coinciden";
                    echo "<script>location.href='../views/perfil.php'</script>";
                }
            }else{
                $_SESSION['tipo_alertperfil']="danger";
                $_SESSION['mensajeperfil']="Ingrese todos los campos";
                echo "<script>location.href='../views/perfil.php'</script>";
            }
        }else{
            $_SESSION['tipo_alertperfil']="danger";
            $_SESSION['mensajeperfil']="Ingrese todos los campos";
            echo "<script>location.href='../views/perfil.php'</script>";
        }
    }

    if(isset($_GET['cancel2'])){
        unset($_SESSION['rContra']);         
        echo "<script>location.href='../views/perfil.php'</script>";
    }

    if(isset($_POST['eContra3'])){
        $eContra3 = (isset($_POST['eContra3']) ? $_POST['eContra3']:NULL);
        $eContra4 = (isset($_POST['eContra4']) ? $_POST['eContra4']:NULL);

        if($eContra3 !=""){
            if($eContra4 !=""){
                if($eContra3 == $eContra4){
                    $pass= sha1(md5($eContra3));
                    $nDoc =  $_SESSION['num_doc'];
                        $consulta->actualizarContrasena($pass,$nDoc);
                        if($consulta){
                            $_SESSION['contrasena']=$pass;
                            unset($_SESSION['rContra']);
                            $_SESSION['tipo_alert']="success";
                            $_SESSION['mensaje']="Contraseña actualizada correctamente";
                            echo "<script>location.href='../views/perfil.php'</script>"; 
                        }else{
                            $_SESSION['tipo_alertrContra']="danger";
                            $_SESSION['mensajerContra']="Error a actualizar su contraseña, por favor intente otra vez";
                            echo "<script>location.href='../views/perfil.php'</script>"; 
                        }
                }else{
                    $_SESSION['tipo_alertrContra']="danger";
                    $_SESSION['mensajerContra']="Los campos no coinciden";
                    echo "<script>location.href='../views/perfil.php'</script>";
                }
            }else{
                $_SESSION['tipo_alertrContra']="danger";
                $_SESSION['mensajerContra']="Ingrese todos los campos";
                echo "<script>location.href='../views/perfil.php'</script>";
            }
        }else{
            $_SESSION['tipo_alertrContra']="danger";
            $_SESSION['mensajerContra']="Ingrese todos los campos";
            echo "<script>location.href='../views/perfil.php'</script>";
        }
    }

    if(isset($_FILES['foto'])){
        if (session_status() !== PHP_SESSION_ACTIVE) {
            // Si no está iniciada, la iniciamos
            session_start();
        }
        $formatos_permitidos =  array('.jpg');
        $numDoc =  $_SESSION['num_doc'];
        $nombre_foto= $_FILES['foto']['name'];
        // var_dump($nombre_foto);
        // die();
        $nombre_temporal=$_FILES['foto']['tmp_name'];
        $nuevo_nombre="Sena_".$numDoc;
        $carpeta = '../img/Perfil/';
        //$carpeta = '../img/perfil/'. $numDoc . '/';
        // if(!file_exists($carpeta)){
        //     mkdir($carpeta, 0007, true);
        // }
        $explode=explode(".",$nombre_foto);


        $extension_archivo=".".array_pop($explode);
        
        if(in_array($extension_archivo, $formatos_permitidos)){
            $rutafinal=$carpeta.$nuevo_nombre.$extension_archivo;
            $rutafinalSql=$nuevo_nombre.$extension_archivo;
            if(move_uploaded_file($nombre_temporal,$rutafinal)){
                $consulta->actualizarFoto($numDoc,$rutafinalSql);
                if($consulta){
                    if (session_status() !== PHP_SESSION_ACTIVE) {
                        // Si no está iniciada, la iniciamos
                        session_start();
                    }
                $_SESSION['foto']=$rutafinalSql;
                $_SESSION['tipo_alert']="success";
                $_SESSION['mensaje']="Foto de perfil actualizada exitosamente";
                echo "<script>location.href='../views/perfil.php'</script>";
                }
            }
        }else{
            $_SESSION['tipo_alert']="danger";
            $_SESSION['mensaje']= $extension_archivo . " es una extension  de archivo no permitida";
            echo "<script>location.href='../views/perfil.php'</script>";
        }



    }

?>