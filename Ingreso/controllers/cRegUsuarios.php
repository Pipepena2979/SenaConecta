<?php
    include("../models/mconsultas.php");
   
    $consulta = new Consultas(); // Objecto

    $usuarios = $consulta->usuarios();
    $tDocs = $consulta->tDoc();
    $genero = $consulta->genero();
    $roles = $consulta->rol();
    $departamentos = $consulta->departamentos();



// Registrar usuario

if(isset($_POST['nombres'])){
    if (session_status() !== PHP_SESSION_ACTIVE) {
        // Si no está iniciada, la iniciamos
        session_start();
    }

    $nombres = trim(isset($_POST['nombres']) ? $_POST['nombres']:NULL);
        if(!empty($nombres)){
            $eN1 = strtolower($nombres); $eN2 = ucwords($eN1);
            $apellidos = trim(isset($_POST['apellidos']) ? $_POST['apellidos']:NULL);
                if(!empty($apellidos)){
                    $eA1 = strtolower($apellidos); $eA2 = ucwords($eA1);
                    $tDoc = trim(isset($_POST['tDoc']) ? $_POST['tDoc']:NULL);
                        if(!empty($tDoc)){
                            if(is_numeric($tDoc)){
                                $consultarnTdoc = $consulta->consultarnTdoc($tDoc);
                                    if($consultarnTdoc){
                                        $nDoc = trim(isset($_POST['nDoc']) ? $_POST['nDoc']:NULL);
                                            if(!empty($nDoc)){
                                                if(is_numeric($nDoc)){
                                                    $fechaNacimiento = trim(isset($_POST['fechaNacimiento']) ? $_POST['fechaNacimiento']:NULL);
                                                        if(!empty($fechaNacimiento)){
                                                                    $correo = trim(isset($_POST['correo']) ? $_POST['correo']:NULL);
                                                                        if(!empty($correo)){
                                                                                    $nTelefono = trim(isset($_POST['nTelefono']) ? $_POST['nTelefono']:NULL);
                                                                                    if(!empty($nTelefono)){
                                                                                        if(is_numeric($nTelefono)){
                                                                                            
                                                                                                            $rol = trim(isset($_POST['rol']) ? $_POST['rol']:NULL);
                                                                                                            if(!empty($rol)){
                                                                                                                if(is_numeric($rol)){
                                                                                                                    $consultarnRol = $consulta->consultarnRol($rol);
                                                                                                                        if($consultarnRol){
                                                                                                                            $departamento = trim(isset($_POST['departamento']) ? $_POST['departamento']:NULL);
                                                                                                                                if(!empty($departamento)){
                                                                                                                                    if(is_numeric($departamento)){
                                                                                                                                        $consultarDepartamento = $consulta->consultarDepartamento($departamento);
                                                                                                                                            if($consultarDepartamento){
                                                                                                                                                $Ciudad = trim(isset($_POST['Ciudad']) ? $_POST['Ciudad']:NULL);
                                                                                                                                                    if(!empty($Ciudad)){
                                                                                                                                                        if(is_numeric($Ciudad)){
                                                                                                                                                            $consultarMunicipio = $consulta->consultarMunicipio($Ciudad);
                                                                                                                                                                if($consultarMunicipio){
                                                                                                                                                                    $genero = trim(isset($_POST['genero']) ? $_POST['genero']:NULL);
                                                                                                                                                                        if(!empty($genero)){
                                                                                                                                                                            if(is_numeric($genero)){
                                                                                                                                                                                $consultarGenero = $consulta->consultarGenero($genero);
                                                                                                                                                                                    if($consultarGenero){
                                                                                                                                                                                        $fechaContrato = trim(isset($_POST['fechaContrato']) ? $_POST['fechaContrato']:NULL);
                                                                                                                                                                                            if(!empty($fechaContrato)){
                                                                                                                                                                                                $contra = substr($nDoc, -4);
                                                                                                                                                                                                $ncontra = sha1(md5($contra));
                                                                                                                                                                                                date_default_timezone_set("America/Bogota");
                                                                                                                                                                                                $fechaRegistro = date("Y-m-d h:i:s");
                                                                                                                                                                                                $fechaSession = date("Y-m-d h:i:s");                                                             
                                                                                                                                                                                                    $perfiles = (isset($_POST['perfiles']) ? $_POST['perfiles']:NULL);    
                                                                                                                                                                                                    if(!empty($perfiles)){
                                                                                                                                                                                                        // $p1 = strtolower($p); 
                                                                                                                                                                                                        // $perfiles = ucwords($p1);
                                                                                                                                                                                                        $supervisor = trim(isset($_POST['supervisor']) ? $_POST['supervisor']:NULL);
                                                                                                                                                                                                        
                                                                                                                                                                                                        $estado = 1;
                                                                                                                                                                                                        
                                                                                                                                                                                                        $consultarnDoc = $consulta->consultarnDoc($nDoc);
                                                                                                                                                                                                            if(($rol !=1 and $rol !=5)&& $supervisor == ""){
                                                                                                                                                                                                                // var_dump($supervisor);
                                                                                                                                                                                                                // die();
                                                                                                                                                                                                                $_SESSION['tipo_alert']="danger";
                                                                                                                                                                                                                $_SESSION['mensaje']="Debes seleccionar el supervisor de contrato del usuario a registrar";
                                                                                                                                                                                                                $_SESSION['errorRegistrar'] = true;
                                                                                                                                                                                                                $_SESSION['errorRegistrarNombres'] = $eN2;
                                                                                                                                                                                                                $_SESSION['errorRegistrarApellidos'] = $eA2;
                                                                                                                                                                                                                $_SESSION['errorRegistrartDoc'] = $tDoc;
                                                                                                                                                                                                                $_SESSION['errorRegistrarnDoc'] = $nDoc;
                                                                                                                                                                                                                $_SESSION['errorRegistrarGenero'] = $genero;
                                                                                                                                                                                                                $_SESSION['errorRegistrarFechaNacimiento'] = $fechaNacimiento;
                                                                                                                                                                                                                $_SESSION['errorRegistrarCorreo'] = $correo;
                                                                                                                                                                                                                $_SESSION['errorRegistrarNumero'] = $nTelefono;
                                                                                                                                                                                                                $_SESSION['errorRegistrarRol'] = $rol;
                                                                                                                                                                                                                $_SESSION['errorRegistrarFechaContrato'] = $fechaContrato;
                                                                                                                                                                                                                $_SESSION['errorRegistrarPerfiles'] = $perfiles;
                                                                                                                                                                                                                if($rol !=1 && $rol!=5){
                                                                                                                                                                                                                    if($rol == 2){
                                                                                                                                                                                                                        $rolll = 1;
                                                                                                                                                                                                                    }elseif($rol == 3){
                                                                                                                                                                                                                        $rolll = 2;
                                                                                                                                                                                                                    }elseif($rol = 5){
                                                                                                                                                                                                                        $rolll = 1;
                                                                                                                                                                                                                    }
                                                                                                                                                                                                                    if($supervisor != ""){
                                                                                                                                                                                                                        $consultarSupervisor = $consulta->consultarSupervisor($supervisor);
                                                                                                                                                                                                                            if($consultarSupervisor){
                                                                                                                                                                                                                                $consultarSupervisorAjax = $consulta->consultarSupervisorAjax($rolll);
                                                                                                                                                                                                                                $_SESSION['errorRegistrarSupervisor'] = $supervisor;
                                                                                                                                                                                                                                $_SESSION['errorRegistrarSupervisorAjax'] = $consultarSupervisorAjax;  
                                                                                                                                                                                                                            }else{
                                                                                                                                                                                                                                $consultarSupervisorAjax = $consulta->consultarSupervisorAjax($rolll);
                                                                                                                                                                                                                                $_SESSION['errorRegistrarSupervisor'] = "";
                                                                                                                                                                                                                                $_SESSION['errorRegistrarSupervisorAjax'] = $consultarSupervisorAjax;  
                                                                                                                                                                                                                            }
                                                                                                                                                                                                                    }else{
                                                                                                                                                                                                                        $_SESSION['errorRegistrarSupervisor'] = "";    
                                                                                                                                                                                                                        $consultarSupervisorAjax = $consulta->consultarSupervisorAjax($rolll);
                                                                                                                                                                                                                        $_SESSION['errorRegistrarSupervisorAjax'] = $consultarSupervisorAjax;
                                                                                                                                                                                                                    }
                                                                                                                                                                                                                    
                                                                                                                                                                                                                }else{
                                                                                                                                                                                                                    $consultarSupervisorAjax = $consulta->consultarSupervisorAjax($rol);
                                                                                                                                                                                                                    $_SESSION['errorRegistrarSupervisorAjax'] = $consultarSupervisorAjax;
                                                                                                                                                                                                                }
                                                                                                                                                                                                                $_SESSION['errorRegistrarDepartamento'] = $departamento;
                                                                                                                                                                                                                $_SESSION['errorRegistrarMunicipio'] = $Ciudad;
                                                                                                                                                                                                                if($consultarMunicipio[0]['iddepar']){
                                                                                                                                                                                                                    $consultarMunicipioRegistrar = $consulta->consultarMunicipioRegistrar($consultarMunicipio[0]['iddepar']);
                                                                                                                                                                                                                        if($consultarMunicipioRegistrar){
                                                                                                                                                                                                                            $_SESSION['errorRegistrarMunicipioA'] = $consultarMunicipioRegistrar;
                                                                                                                                                                                                                            
                                                                                                                                                                                                                        }
                                                                                                                                                                                                                }
                                                                                                                                                                                                                echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                                            }else{

                                                                                                                                                                                                                if($consultarnDoc){
                                                                                                                                                                                                                    $_SESSION['tipo_alert']="danger";
                                                                                                                                                                                                                    $_SESSION['mensaje']="Numero de documento " . $nDoc . " ya fue registrado con otro usuario";
                                                                                                                                                                                                                    $_SESSION['errorRegistrar'] = true;
                                                                                                                                                                                                                    $_SESSION['errorRegistrarNombres'] = $eN2;
                                                                                                                                                                                                                    $_SESSION['errorRegistrarApellidos'] = $eA2;
                                                                                                                                                                                                                    $_SESSION['errorRegistrartDoc'] = $tDoc;
                                                                                                                                                                                                                    $_SESSION['errorRegistrarnDoc'] = $nDoc;
                                                                                                                                                                                                                    $_SESSION['errorRegistrarGenero'] = $genero;
                                                                                                                                                                                                                    $_SESSION['errorRegistrarFechaNacimiento'] = $fechaNacimiento;
                                                                                                                                                                                                                    $_SESSION['errorRegistrarCorreo'] = $correo;
                                                                                                                                                                                                                    $_SESSION['errorRegistrarNumero'] = $nTelefono;
                                                                                                                                                                                                                    $_SESSION['errorRegistrarRol'] = $rol;
                                                                                                                                                                                                                    $_SESSION['errorRegistrarFechaContrato'] = $fechaContrato;
                                                                                                                                                                                                                    //PERFIL
                                                                                                                                                                                                                    $_SESSION['errorRegistrarPerfiles'] = $perfiles;
                                                                                                                                                                                                                    if($rol !=1 && $rol!=4){
                                                                                                                                                                                                                        if($rol == 2){
                                                                                                                                                                                                                            $rolll = 1;
                                                                                                                                                                                                                        }elseif($rol == 3){
                                                                                                                                                                                                                            $rolll = 2;
                                                                                                                                                                                                                        }
                                                                                                                                                                                                                        if($supervisor != ""){
                                                                                                                                                                                                                            $consultarSupervisor = $consulta->consultarSupervisor($supervisor);
                                                                                                                                                                                                                                if($consultarSupervisor){
                                                                                                                                                                                                                                    $consultarSupervisorAjax = $consulta->consultarSupervisorAjax($rolll);
                                                                                                                                                                                                                                    $_SESSION['errorRegistrarSupervisor'] = $supervisor;
                                                                                                                                                                                                                                    $_SESSION['errorRegistrarSupervisorAjax'] = $consultarSupervisorAjax;  
                                                                                                                                                                                                                                }else{
                                                                                                                                                                                                                                    $consultarSupervisorAjax = $consulta->consultarSupervisorAjax($rolll);
                                                                                                                                                                                                                                    $_SESSION['errorRegistrarSupervisor'] = "";
                                                                                                                                                                                                                                    $_SESSION['errorRegistrarSupervisorAjax'] = $consultarSupervisorAjax;  
                                                                                                                                                                                                                                }
                                                                                                                                                                                                                        }else{
                                                                                                                                                                                                                            $_SESSION['errorRegistrarSupervisor'] = "";    
                                                                                                                                                                                                                            $consultarSupervisorAjax = $consulta->consultarSupervisorAjax($rolll);
                                                                                                                                                                                                                            $_SESSION['errorRegistrarSupervisorAjax'] = $consultarSupervisorAjax;
                                                                                                                                                                                                                        }
                                                                                                                                                                                                                        
                                                                                                                                                                                                                    }
                                                                                                                                                                                                                    $_SESSION['errorRegistrarDepartamento'] = $departamento;
                                                                                                                                                                                                                    $_SESSION['errorRegistrarMunicipio'] = $Ciudad;
                                                                                                                                                                                                                    if($consultarMunicipio[0]['iddepar']){
                                                                                                                                                                                                                        $consultarMunicipioRegistrar = $consulta->consultarMunicipioRegistrar($consultarMunicipio[0]['iddepar']);
                                                                                                                                                                                                                            if($consultarMunicipioRegistrar){
                                                                                                                                                                                                                                $_SESSION['errorRegistrarMunicipioA'] = $consultarMunicipioRegistrar;
                                                                                                                                                                                                                            }
                                                                                                                                                                                                                    }
                                                                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                                                }else{
                                                                                                                                                                                                                    $consultarCorreo = $consulta->consultarCorreo($correo);
                                                                                                                                                                                                                        if($consultarCorreo){
                                                                                                                                                                                                                            $_SESSION['tipo_alert']="danger";
                                                                                                                                                                                                                            $_SESSION['mensaje']="El correo electrónico " . $correo .  " ya fue registrado con un usuario";
                                                                                                                                                                                                                            $_SESSION['errorRegistrar'] = true;
                                                                                                                                                                                                                            $_SESSION['errorRegistrarNombres'] = $eN2;
                                                                                                                                                                                                                            $_SESSION['errorRegistrarApellidos'] = $eA2;
                                                                                                                                                                                                                            $_SESSION['errorRegistrartDoc'] = $tDoc;
                                                                                                                                                                                                                            $_SESSION['errorRegistrarnDoc'] = $nDoc;
                                                                                                                                                                                                                            $_SESSION['errorRegistrarGenero'] = $genero;
                                                                                                                                                                                                                            $_SESSION['errorRegistrarFechaNacimiento'] = $fechaNacimiento;
                                                                                                                                                                                                                            $_SESSION['errorRegistrarCorreo'] = $correo;
                                                                                                                                                                                                                            $_SESSION['errorRegistrarNumero'] = $nTelefono;
                                                                                                                                                                                                                            $_SESSION['errorRegistrarRol'] = $rol;
                                                                                                                                                                                                                            $_SESSION['errorRegistrarFechaContrato'] = $fechaContrato;
                                                                                                                                                                                                                            //PERFIL
                                                                                                                                                                                                                            $_SESSION['errorRegistrarPerfiles'] = $perfiles;
                                                                                                                                                                                                                            if($rol !=1 && $rol!=4){
                                                                                                                                                                                                                                if($rol == 2){
                                                                                                                                                                                                                                    $rolll = 1;
                                                                                                                                                                                                                                }elseif($rol == 3){
                                                                                                                                                                                                                                    $rolll = 2;
                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                if($supervisor != ""){
                                                                                                                                                                                                                                    $consultarSupervisor = $consulta->consultarSupervisor($supervisor);
                                                                                                                                                                                                                                        if($consultarSupervisor){
                                                                                                                                                                                                                                            $consultarSupervisorAjax = $consulta->consultarSupervisorAjax($rolll);
                                                                                                                                                                                                                                            $_SESSION['errorRegistrarSupervisor'] = $supervisor;
                                                                                                                                                                                                                                            $_SESSION['errorRegistrarSupervisorAjax'] = $consultarSupervisorAjax;  
                                                                                                                                                                                                                                        }else{
                                                                                                                                                                                                                                            $consultarSupervisorAjax = $consulta->consultarSupervisorAjax($rolll);
                                                                                                                                                                                                                                            $_SESSION['errorRegistrarSupervisor'] = "";
                                                                                                                                                                                                                                            $_SESSION['errorRegistrarSupervisorAjax'] = $consultarSupervisorAjax;  
                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                }else{
                                                                                                                                                                                                                                    $_SESSION['errorRegistrarSupervisor'] = "";    
                                                                                                                                                                                                                                    $consultarSupervisorAjax = $consulta->consultarSupervisorAjax($rolll);
                                                                                                                                                                                                                                    $_SESSION['errorRegistrarSupervisorAjax'] = $consultarSupervisorAjax;
                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                
                                                                                                                                                                                                                            }
                                                                                                                                                                                                                            $_SESSION['errorRegistrarDepartamento'] = $departamento;
                                                                                                                                                                                                                            $_SESSION['errorRegistrarMunicipio'] = $Ciudad;
            
                                                                                                                                                                                                                            if($consultarMunicipio[0]['iddepar']){
                                                                                                                                                                                                                                $consultarMunicipioRegistrar = $consulta->consultarMunicipioRegistrar($consultarMunicipio[0]['iddepar']);
                                                                                                                                                                                                                                    if($consultarMunicipioRegistrar){
                                                                                                                                                                                                                                        $_SESSION['errorRegistrarMunicipioA'] = $consultarMunicipioRegistrar;
                                                                                                                                                                                                                                        
                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                            }
                                                                                                                                                                                                                            echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                                                        }else{
                                                                                                                                                                                                                            $consultarTelefono = $consulta->consultarTelefono($nTelefono);
                                                                                                                                                                                                                            if($consultarTelefono){
                                                                                                                                                                                                                                $_SESSION['tipo_alert']="danger";
                                                                                                                                                                                                                                $_SESSION['mensaje']="El numero telefonico " . $nTelefono . " ya fue resgitrado con otro usuario";
                                                                                                                                                                                                                                $_SESSION['errorRegistrar'] = true;
                                                                                                                                                                                                                                $_SESSION['errorRegistrarNombres'] = $eN2;
                                                                                                                                                                                                                                $_SESSION['errorRegistrarApellidos'] = $eA2;
                                                                                                                                                                                                                                $_SESSION['errorRegistrartDoc'] = $tDoc;
                                                                                                                                                                                                                                $_SESSION['errorRegistrarnDoc'] = $nDoc;
                                                                                                                                                                                                                                $_SESSION['errorRegistrarGenero'] = $genero;
                                                                                                                                                                                                                                $_SESSION['errorRegistrarFechaNacimiento'] = $fechaNacimiento;
                                                                                                                                                                                                                                $_SESSION['errorRegistrarCorreo'] = $correo;
                                                                                                                                                                                                                                $_SESSION['errorRegistrarNumero'] = $nTelefono;
                                                                                                                                                                                                                                $_SESSION['errorRegistrarRol'] = $rol;
                                                                                                                                                                                                                                $_SESSION['errorRegistrarFechaContrato'] = $fechaContrato;
                                                                                                                                                                                                                                //PERFIL
                                                                                                                                                                                                                                $_SESSION['errorRegistrarPerfiles'] = $perfiles;
                                                                                                                                                                                                                                if($rol !=1 && $rol!=4){
                                                                                                                                                                                                                                    if($rol == 2){
                                                                                                                                                                                                                                        $rolll = 1;
                                                                                                                                                                                                                                    }elseif($rol == 3){
                                                                                                                                                                                                                                        $rolll = 2;
                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                    if($supervisor != ""){
                                                                                                                                                                                                                                        $consultarSupervisor = $consulta->consultarSupervisor($supervisor);
                                                                                                                                                                                                                                            if($consultarSupervisor){
                                                                                                                                                                                                                                                $consultarSupervisorAjax = $consulta->consultarSupervisorAjax($rolll);
                                                                                                                                                                                                                                                $_SESSION['errorRegistrarSupervisor'] = $supervisor;
                                                                                                                                                                                                                                                $_SESSION['errorRegistrarSupervisorAjax'] = $consultarSupervisorAjax;  
                                                                                                                                                                                                                                            }else{
                                                                                                                                                                                                                                                $consultarSupervisorAjax = $consulta->consultarSupervisorAjax($rolll);
                                                                                                                                                                                                                                                $_SESSION['errorRegistrarSupervisor'] = "";
                                                                                                                                                                                                                                                $_SESSION['errorRegistrarSupervisorAjax'] = $consultarSupervisorAjax;  
                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                    }else{
                                                                                                                                                                                                                                        $_SESSION['errorRegistrarSupervisor'] = "";    
                                                                                                                                                                                                                                        $consultarSupervisorAjax = $consulta->consultarSupervisorAjax($rolll);
                                                                                                                                                                                                                                        $_SESSION['errorRegistrarSupervisorAjax'] = $consultarSupervisorAjax;
                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                    
                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                $_SESSION['errorRegistrarDepartamento'] = $departamento;
                                                                                                                                                                                                                                $_SESSION['errorRegistrarMunicipio'] = $Ciudad;
                
                                                                                                                                                                                                                                if($consultarMunicipio[0]['iddepar']){
                                                                                                                                                                                                                                    $consultarMunicipioRegistrar = $consulta->consultarMunicipioRegistrar($consultarMunicipio[0]['iddepar']);
                                                                                                                                                                                                                                        if($consultarMunicipioRegistrar){
                                                                                                                                                                                                                                            $_SESSION['errorRegistrarMunicipioA'] = $consultarMunicipioRegistrar;
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                                                            }else{
                                                                                                                                                                                                                                $nTelMed = strlen($nTelefono);
                                                                                                                                                                                                                                if($nTelMed <> 10){
                                                                                                                                                                                                                                    
                                                                                                                                                                                                                                    $_SESSION['tipo_alert']="danger";
                                                                                                                                                                                                                                    $_SESSION['mensaje']="El numero telefonico " . $nTelefono . " debe ser de 10 digitos";
                                                                                                                                                                                                                                    $_SESSION['errorRegistrar'] = true;
                                                                                                                                                                                                                                    $_SESSION['errorRegistrarNombres'] = $eN2;
                                                                                                                                                                                                                                    $_SESSION['errorRegistrarApellidos'] = $eA2;
                                                                                                                                                                                                                                    $_SESSION['errorRegistrartDoc'] = $tDoc;
                                                                                                                                                                                                                                    $_SESSION['errorRegistrarnDoc'] = $nDoc;
                                                                                                                                                                                                                                    $_SESSION['errorRegistrarGenero'] = $genero;
                                                                                                                                                                                                                                    $_SESSION['errorRegistrarFechaNacimiento'] = $fechaNacimiento;
                                                                                                                                                                                                                                    $_SESSION['errorRegistrarCorreo'] = $correo;
                                                                                                                                                                                                                                    $_SESSION['errorRegistrarNumero'] = $nTelefono;
                                                                                                                                                                                                                                    $_SESSION['errorRegistrarRol'] = $rol;
                                                                                                                                                                                                                                    $_SESSION['errorRegistrarFechaContrato'] = $fechaContrato;
                                                                                                                                                                                                                                    //PERFIL
                                                                                                                                                                                                                                    $_SESSION['errorRegistrarPerfiles'] = $perfiles;
                                                                                                                                                                                                                                    if($rol !=1 && $rol!=4){
                                                                                                                                                                                                                                        if($rol == 2){
                                                                                                                                                                                                                                            $rolll = 1;
                                                                                                                                                                                                                                        }elseif($rol == 3){
                                                                                                                                                                                                                                            $rolll = 2;
                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                        if($supervisor != ""){
                                                                                                                                                                                                                                            $consultarSupervisor = $consulta->consultarSupervisor($supervisor);
                                                                                                                                                                                                                                                if($consultarSupervisor){
                                                                                                                                                                                                                                                    $consultarSupervisorAjax = $consulta->consultarSupervisorAjax($rolll);
                                                                                                                                                                                                                                                    $_SESSION['errorRegistrarSupervisor'] = $supervisor;
                                                                                                                                                                                                                                                    $_SESSION['errorRegistrarSupervisorAjax'] = $consultarSupervisorAjax;  
                                                                                                                                                                                                                                                }else{
                                                                                                                                                                                                                                                    $consultarSupervisorAjax = $consulta->consultarSupervisorAjax($rolll);
                                                                                                                                                                                                                                                    $_SESSION['errorRegistrarSupervisor'] = "";
                                                                                                                                                                                                                                                    $_SESSION['errorRegistrarSupervisorAjax'] = $consultarSupervisorAjax;  
                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                        }else{
                                                                                                                                                                                                                                            $_SESSION['errorRegistrarSupervisor'] = "";    
                                                                                                                                                                                                                                            $consultarSupervisorAjax = $consulta->consultarSupervisorAjax($rolll);
                                                                                                                                                                                                                                            $_SESSION['errorRegistrarSupervisorAjax'] = $consultarSupervisorAjax;
                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                        
                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                    $_SESSION['errorRegistrarDepartamento'] = $departamento;
                                                                                                                                                                                                                                    $_SESSION['errorRegistrarMunicipio'] = $Ciudad;
                                                                                                                                                                                                                                    
                                                                                                                                                                                                                                    if($consultarMunicipio[0]['iddepar']){
                                                                                                                                                                                                                                        $consultarMunicipioRegistrar = $consulta->consultarMunicipioRegistrar($consultarMunicipio[0]['iddepar']);
                                                                                                                                                                                                                                            if($consultarMunicipioRegistrar){
                                                                                                                                                                                                                                                $_SESSION['errorRegistrarMunicipioA'] = $consultarMunicipioRegistrar;
                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                                                                }else{
                                                                                                                                                                                                                                    if($fechaNacimiento >= $fechaRegistro){
                                                                                                                                                                                                                                        $_SESSION['tipo_alert']="danger";
                                                                                                                                                                                                                                        $_SESSION['mensaje']="La fecha de nacimiento ( " . $fechaNacimiento . " ) , debe ser menor a la fecha actual";
                                                                                                                                                                                                                                        $_SESSION['errorRegistrar'] = true;
                                                                                                                                                                                                                                        $_SESSION['errorRegistrarNombres'] = $eN2;
                                                                                                                                                                                                                                        $_SESSION['errorRegistrarApellidos'] = $eA2;
                                                                                                                                                                                                                                        $_SESSION['errorRegistrartDoc'] = $tDoc;
                                                                                                                                                                                                                                        $_SESSION['errorRegistrarnDoc'] = $nDoc;
                                                                                                                                                                                                                                        $_SESSION['errorRegistrarGenero'] = $genero;
                                                                                                                                                                                                                                        $_SESSION['errorRegistrarFechaNacimiento'] = $fechaNacimiento;
                                                                                                                                                                                                                                        $_SESSION['errorRegistrarCorreo'] = $correo;
                                                                                                                                                                                                                                        $_SESSION['errorRegistrarNumero'] = $nTelefono;
                                                                                                                                                                                                                                        $_SESSION['errorRegistrarRol'] = $rol;
                                                                                                                                                                                                                                        $_SESSION['errorRegistrarFechaContrato'] = $fechaContrato;
                                                                                                                                                                                                                                        //PERFIL
                                                                                                                                                                                                                                        $_SESSION['errorRegistrarPerfiles'] = $perfiles;
                                                                                                                                                                                                                                        if($rol !=1 && $rol!=4){
                                                                                                                                                                                                                                            if($rol == 2){
                                                                                                                                                                                                                                                $rolll = 1;
                                                                                                                                                                                                                                            }elseif($rol == 3){
                                                                                                                                                                                                                                                $rolll = 2;
                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                            if($supervisor != ""){
                                                                                                                                                                                                                                                $consultarSupervisor = $consulta->consultarSupervisor($supervisor);
                                                                                                                                                                                                                                                    if($consultarSupervisor){
                                                                                                                                                                                                                                                        $consultarSupervisorAjax = $consulta->consultarSupervisorAjax($rolll);
                                                                                                                                                                                                                                                        $_SESSION['errorRegistrarSupervisor'] = $supervisor;
                                                                                                                                                                                                                                                        $_SESSION['errorRegistrarSupervisorAjax'] = $consultarSupervisorAjax;  
                                                                                                                                                                                                                                                    }else{
                                                                                                                                                                                                                                                        $consultarSupervisorAjax = $consulta->consultarSupervisorAjax($rolll);
                                                                                                                                                                                                                                                        $_SESSION['errorRegistrarSupervisor'] = "";
                                                                                                                                                                                                                                                        $_SESSION['errorRegistrarSupervisorAjax'] = $consultarSupervisorAjax;  
                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                            }else{
                                                                                                                                                                                                                                                $_SESSION['errorRegistrarSupervisor'] = "";    
                                                                                                                                                                                                                                                $consultarSupervisorAjax = $consulta->consultarSupervisorAjax($rolll);
                                                                                                                                                                                                                                                $_SESSION['errorRegistrarSupervisorAjax'] = $consultarSupervisorAjax;
                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                        $_SESSION['errorRegistrarDepartamento'] = $departamento;
                                                                                                                                                                                                                                        $_SESSION['errorRegistrarMunicipio'] = $Ciudad;
                                                                                                                                                                                                                                        if($consultarMunicipio[0]['iddepar']){
                                                                                                                                                                                                                                            $consultarMunicipioRegistrar = $consulta->consultarMunicipioRegistrar($consultarMunicipio[0]['iddepar']);
                                                                                                                                                                                                                                                if($consultarMunicipioRegistrar){
                                                                                                                                                                                                                                                    $_SESSION['errorRegistrarMunicipioA'] = $consultarMunicipioRegistrar;
                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                        echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                                                                    }else{
                                                                                                                                                                                                                                        if($fechaContrato <= $fechaRegistro){   
                                                                                                                                                                                                                                            $_SESSION['tipo_alert']="danger";
                                                                                                                                                                                                                                            $_SESSION['mensaje']="Seleccione una fecha de finalización de contrato mayor a la fecha del dia de hoy";
                                                                                                                                                                                                                                            $_SESSION['errorRegistrar'] = true;
                                                                                                                                                                                                                                            $_SESSION['errorRegistrarNombres'] = $eN2;
                                                                                                                                                                                                                                            $_SESSION['errorRegistrarApellidos'] = $eA2;
                                                                                                                                                                                                                                            $_SESSION['errorRegistrartDoc'] = $tDoc;
                                                                                                                                                                                                                                            $_SESSION['errorRegistrarnDoc'] = $nDoc;
                                                                                                                                                                                                                                            $_SESSION['errorRegistrarGenero'] = $genero;
                                                                                                                                                                                                                                            $_SESSION['errorRegistrarFechaNacimiento'] = $fechaNacimiento;
                                                                                                                                                                                                                                            $_SESSION['errorRegistrarCorreo'] = $correo;
                                                                                                                                                                                                                                            $_SESSION['errorRegistrarNumero'] = $nTelefono;
                                                                                                                                                                                                                                            $_SESSION['errorRegistrarRol'] = $rol;
                                                                                                                                                                                                                                            $_SESSION['errorRegistrarFechaContrato'] = $fechaContrato;
                                                                                                                                                                                                                                            //PERFIL
                                                                                                                                                                                                                                            $_SESSION['errorRegistrarPerfiles'] = $perfiles;
                                                                                                                                                                                                                                            if($rol !=1 && $rol!=4){
                                                                                                                                                                                                                                                if($rol == 2){
                                                                                                                                                                                                                                                    $rolll = 1;
                                                                                                                                                                                                                                                }elseif($rol == 3){
                                                                                                                                                                                                                                                    $rolll = 2;
                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                if($supervisor != ""){
                                                                                                                                                                                                                                                    $consultarSupervisor = $consulta->consultarSupervisor($supervisor);
                                                                                                                                                                                                                                                        if($consultarSupervisor){
                                                                                                                                                                                                                                                            $consultarSupervisorAjax = $consulta->consultarSupervisorAjax($rolll);
                                                                                                                                                                                                                                                            $_SESSION['errorRegistrarSupervisor'] = $supervisor;
                                                                                                                                                                                                                                                            $_SESSION['errorRegistrarSupervisorAjax'] = $consultarSupervisorAjax;  
                                                                                                                                                                                                                                                        }else{
                                                                                                                                                                                                                                                            $consultarSupervisorAjax = $consulta->consultarSupervisorAjax($rolll);
                                                                                                                                                                                                                                                            $_SESSION['errorRegistrarSupervisor'] = "";
                                                                                                                                                                                                                                                            $_SESSION['errorRegistrarSupervisorAjax'] = $consultarSupervisorAjax;  
                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                }else{
                                                                                                                                                                                                                                                    $_SESSION['errorRegistrarSupervisor'] = "";    
                                                                                                                                                                                                                                                    $consultarSupervisorAjax = $consulta->consultarSupervisorAjax($rolll);
                                                                                                                                                                                                                                                    $_SESSION['errorRegistrarSupervisorAjax'] = $consultarSupervisorAjax;
                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                
                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                            $_SESSION['errorRegistrarDepartamento'] = $departamento;
                                                                                                                                                                                                                                            $_SESSION['errorRegistrarMunicipio'] = $Ciudad;
                                                                                                                                                                                                                                            if($consultarMunicipio[0]['iddepar']){
                                                                                                                                                                                                                                                $consultarMunicipioRegistrar = $consulta->consultarMunicipioRegistrar($consultarMunicipio[0]['iddepar']);
                                                                                                                                                                                                                                                    if($consultarMunicipioRegistrar){
                                                                                                                                                                                                                                                        $_SESSION['errorRegistrarMunicipioA'] = $consultarMunicipioRegistrar;
                                                                                                                                                                                                                                                        
                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                            echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                        }else{
                                                                                                                                                                                                                                            if($rol ==1 or $rol ==4){

                                                                                                                                                                                                                                                $registrarUsuario = $consulta->registrarUsuario($tDoc,$nDoc,$genero,$rol,$correo,$eN2,$eA2,$nTelefono,$fechaNacimiento,$ncontra,$departamento,$Ciudad,$fechaRegistro,$fechaSession,$fechaContrato,$_SESSION['num_doc'],$_SESSION['num_doc']);
                                                                                                                                                                                                                                                if($registrarUsuario){
                                                                                                                                                                                                                                                    foreach($perfiles AS $p){
                                                                                                                                                                                                                                                        $p1 = strtolower($p); 
                                                                                                                                                                                                                                                        $perfiles = ucwords($p1);
                                                                                                                                                                                                                                                        $consultaPerfil = $consulta->consultaPerfiles($perfiles, $nDoc, $fechaRegistro);
                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                    if (session_status() !== PHP_SESSION_ACTIVE) {
                                                                                                                                                                                                                                                        // Si no está iniciada, la iniciamos
                                                                                                                                                                                                                                                        session_start();
                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                    if($consultaPerfil){
                                                                                                                                                                                                                                                        $_SESSION['tipo_alert']="success";
                                                                                                                                                                                                                                                        $_SESSION['mensaje']="Usuario registrado correctamente";
                                                                                                                                                                                                                                                        unset($_SESSION['errorRegistrar']);
                                                                                                                                                                                                                                                        echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                                                                                    }else{
                                                                                                                                                                                                                                                        $_SESSION['tipo_alert']="danger";
                                                                                                                                                                                                                                                        $_SESSION['mensaje']="Error al registrar el perfil profesional del usuario";
                                                                                                                                                                                                                                                        unset($_SESSION['errorRegistrar']);
                                                                                                                                                                                                                                                        echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                }else{
                                                                                                                                                                                                                                                    $_SESSION['tipo_alert']="danger";
                                                                                                                                                                                                                                                    $_SESSION['mensaje']="Error al registrar el usuario, por favor intente de nuevo";
                                                                                                                                                                                                                                                    unset($_SESSION['errorRegistrar']);
                                                                                                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                                                                                }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
                                                                                                                                                                                                                                            // Fin
                                                                                                                                                                                                                                            }else{
                                                                                                                                                                                                                                                $registrarUsuario = $consulta->registrarUsuarioSupervisor($tDoc,$nDoc,$genero,$rol,$correo,$eN2,$eA2,$nTelefono,$fechaNacimiento,$ncontra,$departamento,$Ciudad,$fechaRegistro,$fechaSession,$fechaContrato,$supervisor,$_SESSION['num_doc'],$_SESSION['num_doc']);
                                                                                                                                                                                                                                                if($registrarUsuario){
                                                                                                                                                                                                                                                    foreach($perfiles AS $p){
                                                                                                                                                                                                                                                        $p1 = strtolower($p); 
                                                                                                                                                                                                                                                        $perfiles = ucwords($p1);
                                                                                                                                                                                                                                                        $consultaPerfil = $consulta->consultaPerfiles($perfiles, $nDoc, $fechaRegistro);
                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                    if (session_status() !== PHP_SESSION_ACTIVE) {
                                                                                                                                                                                                                                                        // Si no está iniciada, la iniciamos
                                                                                                                                                                                                                                                        session_start();
                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                    if($consultaPerfil){
                                                                                                                                                                                                                                                        $_SESSION['tipo_alert']="success";
                                                                                                                                                                                                                                                        $_SESSION['mensaje']="Usuario registrado correctamente";
                                                                                                                                                                                                                                                        unset($_SESSION['errorRegistrar']);
                                                                                                                                                                                                                                                        echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                                                                                    }else{
                                                                                                                                                                                                                                                        $_SESSION['tipo_alert']="danger";
                                                                                                                                                                                                                                                        $_SESSION['mensaje']="Error al registrar el perfil profesional del usuario";
                                                                                                                                                                                                                                                        unset($_SESSION['errorRegistrar']);
                                                                                                                                                                                                                                                        echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                }else{
                                                                                                                                                                                                                                                    $_SESSION['tipo_alert']="danger";
                                                                                                                                                                                                                                                    $_SESSION['mensaje']="Error al registrar el usuario, por favor intente de nuevo";
                                                                                                                                                                                                                                                    unset($_SESSION['errorRegistrar']);
                                                                                                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                                                                                }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
                                                                                                                                                                                                                                            // Fin
                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                        }                          
                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                }    
                                                                                                                                                                                                                            }
                                                                                                                                                                                                                        }
                                                                                                                                                                                                                }

                                                                                                                                                                                                            }
                                                                                                                                                                                                            
                                                                                                                                                                                                    }else{
                                                                                                                                                                                                        $_SESSION['tipo_alert']="danger";
                                                                                                                                                                                                        $_SESSION['mensaje']="Ingrese el perfil profesional del usuario a registrar";
                                                                                                                                                                                                        echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                                    }                       
                                                                                                                                                                                                
                                                                                                                                                                                            }else{
                                                                                                                                                                                                $_SESSION['tipo_alert']="danger";
                                                                                                                                                                                                $_SESSION['mensaje']="Seleccione una fecha de finalizacón de contrato";
                                                                                                                                                                                                echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                            }
                                                                                                                                                                                    }else{
                                                                                                                                                                                        $_SESSION['tipo_alert']="danger";
                                                                                                                                                                                        $_SESSION['mensaje']="Seleccione un genero";
                                                                                                                                                                                        echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                    }
                                                                                                                                                                            }else{
                                                                                                                                                                                $_SESSION['tipo_alert']="danger";
                                                                                                                                                                                $_SESSION['mensaje']="Error en el genero";
                                                                                                                                                                                echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                            }
                                                                                                                                                                        }else{
                                                                                                                                                                            $_SESSION['tipo_alert']="danger";
                                                                                                                                                                            $_SESSION['mensaje']="Seleccione un genero";
                                                                                                                                                                            echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                        }                                                                                                                                             
                                                                                                                                                                }else{
                                                                                                                                                                    $_SESSION['tipo_alert']="danger";
                                                                                                                                                                    $_SESSION['mensaje']="Seleccione un municipio";
                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                }
                                                                                                                                                        }else{
                                                                                                                                                            $_SESSION['tipo_alert']="danger";
                                                                                                                                                            $_SESSION['mensaje']="Error en el municipio";
                                                                                                                                                            echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                        }
                                                                                                                                                    }else{
                                                                                                                                                        $_SESSION['tipo_alert']="danger";
                                                                                                                                                        $_SESSION['mensaje']="Seleccione un municipio";
                                                                                                                                                        echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                    }
                                                                                                                                            }else{
                                                                                                                                                $_SESSION['tipo_alert']="danger";
                                                                                                                                                $_SESSION['mensaje']="Departamento inexistente";
                                                                                                                                                echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                            }
                                                                                                                                    }else{
                                                                                                                                        $_SESSION['tipo_alert']="danger";
                                                                                                                                        $_SESSION['mensaje']="Error en el departamento";
                                                                                                                                        echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                    }
                                                                                                                                }else{
                                                                                                                                    $_SESSION['tipo_alert']="danger";
                                                                                                                                    $_SESSION['mensaje']="Seleccione un departamento";
                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                }
                                                                                                                        }else{
                                                                                                                            $_SESSION['tipo_alert']="danger";
                                                                                                                            $_SESSION['mensaje']="Rol inexistente";
                                                                                                                            echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                        }
                                                                                                                }else{
                                                                                                                    $_SESSION['tipo_alert']="danger";
                                                                                                                    $_SESSION['mensaje']="Error en el rol";
                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                }
                                                                                                            }else{
                                                                                                                $_SESSION['tipo_alert']="danger";
                                                                                                                $_SESSION['mensaje']="Seleccione un rol";
                                                                                                                echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                            }
                                                                                        }else{
                                                                                            $_SESSION['tipo_alert']="danger";
                                                                                            $_SESSION['mensaje']="Error en el numero telefonico";
                                                                                            echo "<script>location.href='../views/registrar.php'</script>";
                                                                                        }
                                                                                    }else{
                                                                                        $_SESSION['tipo_alert']="danger";
                                                                                        $_SESSION['mensaje']="Ingrese el numero telefonico";
                                                                                        echo "<script>location.href='../views/registrar.php'</script>";
                                                                                    }
                                                                        }else{
                                                                            $_SESSION['tipo_alert']="danger";
                                                                            $_SESSION['mensaje']="Ingrese el correo electronico";
                                                                            echo "<script>location.href='../views/registrar.php'</script>";
                                                                        }
                                                        }else{
                                                            $_SESSION['tipo_alert']="danger";
                                                            $_SESSION['mensaje']="Seleccione una fecha de nacimiento";
                                                            echo "<script>location.href='../views/registrar.php'</script>";
                                                        }                                       
                                                }else{
                                                    $_SESSION['tipo_alert']="danger";
                                                    $_SESSION['mensaje']="Error en numero de documento";
                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                }
                                            }else{
                                                $_SESSION['tipo_alert']="danger";
                                                $_SESSION['mensaje']="Ingrese el numero de documento";
                                                echo "<script>location.href='../views/registrar.php'</script>";
                                            }
                                    }else{
                                        $_SESSION['tipo_alert']="danger";
                                        $_SESSION['mensaje']="Tipo de documento inexistente";
                                        echo "<script>location.href='../views/registrar.php'</script>";
                                    }
                            }else{
                                $_SESSION['tipo_alert']="danger";
                                $_SESSION['mensaje']="Error de tipo de documento";
                                echo "<script>location.href='../views/registrar.php'</script>";
                            }
                        }else{
                            $_SESSION['tipo_alert']="danger";
                            $_SESSION['mensaje']="Seleccione un tipo de documento";
                            echo "<script>location.href='../views/registrar.php'</script>";
                        }
                }else{
                    $_SESSION['tipo_alert']="danger";
                    $_SESSION['mensaje']="Ingrese los apellidos del usuario";
                    echo "<script>location.href='../views/registrar.php'</script>";
                }
        }else{
            $_SESSION['tipo_alert']="danger";
            $_SESSION['mensaje']="Ingrese los nombres del usuario";
            echo "<script>location.href='../views/registrar.php'</script>";
        }
}

// Fin de Registrar usuario

// Formulario editar usuario

    if(isset($_GET['editUser'])){
        if (session_status() !== PHP_SESSION_ACTIVE) {
            // Si no está iniciada, la iniciamos
            session_start();
        } 
        unset($_SESSION['cargaMasiva']); 
        $idUser = $_GET['editUser'];
        $nDoc = $_GET['n'];
        date_default_timezone_set("America/Bogota");
        $fecha = date("Y-m-d");
        $verificarUsuario = $consulta->consultarnDoc($nDoc);
            if($verificarUsuario){
                $x = $verificarUsuario[0]['id'];
                    if($idUser == $x){

                        if(isset($verificarUsuario[0]['iddepar'])){
                            $id = $verificarUsuario[0]['iddepar'];
                            $municipios = $consulta->get_muni($id);
                            $_SESSION['editarMunicipio'] = $municipios;
                        }  
                        $verificarPerfiles = $consulta->verificarPerfiles($nDoc);

                        $_SESSION['editarPerfilUsuario'] = $verificarPerfiles;
                        $_SESSION['verificarNdoc'] =$nDoc;
                        $UsuarioOne = $consulta->editarUsuarioone($idUser);
                        $_SESSION['usuarios'] =$UsuarioOne;
                        if($UsuarioOne[0]['rol'] == 2 OR $UsuarioOne[0]['rol'] == 3){
                            if($UsuarioOne[0]['rol'] == 2){
                                // traer los usuarios posibles
                                
                                $traerSupervisores = $consulta->traerSupervisores(1,$nDoc);
                                
                                $_SESSION['usuariosSupervisores'] =$traerSupervisores;
                            }elseif($UsuarioOne[0]['rol'] == 3){
                                
                                $traerSupervisores = $consulta->traerSupervisores(2,$nDoc);
                                
                                $_SESSION['usuariosSupervisores'] =$traerSupervisores;
                            }
                        }
                        echo "<script>location.href='../views/registrar.php'</script>";
                    }else{
                        if (session_status() !== PHP_SESSION_ACTIVE) {
                            // Si no está iniciada, la iniciamos
                            session_start();
                        }
                        $_SESSION['tipo_alert']="danger";
                        $_SESSION['mensaje']="Error, intente otra vez";
                        echo "<script>location.href='../views/registrar.php'</script>";  
                    }
            }else{
                if (session_status() !== PHP_SESSION_ACTIVE) {
                    // Si no está iniciada, la iniciamos
                    session_start();
                }
                $_SESSION['tipo_alert']="danger";
                $_SESSION['mensaje']="Usuario inexistente";
                echo "<script>location.href='../views/registrar.php'</script>"; 
            }
    }

// Fin de Formulario editar usuario

// Cancelar editar usuario

    if(isset($_GET['cancelx'])){
        if (session_status() !== PHP_SESSION_ACTIVE) {
            // Si no está iniciada, la iniciamos
            session_start();
        }
        
        unset($_SESSION['usuarios']);
        echo "<script>location.href='../views/registrar.php'</script>";
    }

// Fin de Cancelar editar usuario

// Editar usuario

if(isset($_POST['enombre'])){

    if (session_status() !== PHP_SESSION_ACTIVE) {
        // Si no está iniciada, la iniciamos
        session_start();
    }
    $enDoc = $_SESSION['verificarNdoc'];
    $editor = $_SESSION['num_doc'];
    date_default_timezone_set("America/Bogota");
    $fecha= date("Y-m-d");
    $fechaActual = date("Y-m-d h:i:s");
    $enombre = trim(isset($_POST['enombre']) ? $_POST['enombre']:NULL);

    $eperfiles = (isset($_POST['perfiles']) ? $_POST['perfiles']:NULL);
    if(!empty($eperfiles)){
        // variable nDoc
        $eliminarPerfiles = $consulta->eliminarPerfiles($_SESSION['verificarNdoc']);    
        foreach($eperfiles AS $p){

            $p1 = strtolower($p); 
            $perfiles = ucwords($p1);
            $consultaPerfil = $consulta->consultaPerfiles($perfiles, $enDoc, $fechaActual);
        }

        if(!empty($enombre)){
            $eN1 = strtolower($enombre);
            $eN2 = ucwords($eN1);
            $eapellidos = trim(isset($_POST['eapellidos']) ? $_POST['eapellidos']:NULL);
                if(!empty($eapellidos)){
                    $eA1 = strtolower($eapellidos);
                    $eA2 = ucwords($eA1);
                    $etDoc = trim(isset($_POST['etDoc']) ? $_POST['etDoc']:NULL);
                        if(!empty($etDoc)){
                            if(is_numeric($etDoc)){
                                $consultarnTdoc = $consulta->consultarnTdoc($etDoc);
                                    if($consultarnTdoc){
                                        
                                        $eRol = trim(isset($_POST['eRol']) ? $_POST['eRol']:NULL);
                                            if(!empty($eRol)){
                                                if(is_numeric($eRol)){
                                                    $consultarnRol = $consulta->consultarnRol($eRol);
                                                        if($consultarnRol){
                                                            
                                                            $efechaNacimiento = trim(isset($_POST['efechaNacimiento']) ? $_POST['efechaNacimiento']:NULL);
                                                                if(!empty($efechaNacimiento)){
                                                                    if($efechaNacimiento < $fecha){
                                                                        $eDepartamento = trim(isset($_POST['departamento']) ? $_POST['departamento']:NULL);
                                                                            if(!empty($eDepartamento)){
                                                                                if(is_numeric($eDepartamento)){
                                                                                    $consultarnDepartamento = $consulta->consultarDepartamento($eDepartamento);
                                                                                    if($consultarnDepartamento){
                                                                                        $eMunicipio = trim(isset($_POST['Ciudad']) ? $_POST['Ciudad']:NULL);
                                                                                        if(!empty($eMunicipio)){
                                                                                            if(is_numeric($eMunicipio)){
                                                                                                $consultarnMunicipio = $consulta->consultarMunicipioD($eDepartamento,$eMunicipio);
                                                                                                if($consultarnMunicipio){
                                                                                                    $eCorreo = trim(isset($_POST['eCorreo']) ? $_POST['eCorreo']:NULL);
                                                                                                    if(!empty($eCorreo)){
                                                                                                        if ($eCorreo == $_SESSION['Correo']){
                                                                                                            // si el correo es igual a la variable de session
                                                                                                            $eTelefono = trim(isset($_POST['eTelefono']) ? $_POST['eTelefono']:NULL);
                                                                                                            if(!empty($eTelefono)){
                                                                                                                if(is_numeric($eTelefono)){
                                                                                                                    $num = strlen($eTelefono);
                                                                                                                        if($num == 10){
                                                                                                                            if($eTelefono == $_SESSION['Telefono']){
                                                                                                                                $eGenero = trim(isset($_POST['eGenero']) ? $_POST['eGenero']:NULL);
                                                                                                                                $consultarGenero = $consulta->consultarGenero($eGenero);
                                                                                                                                    if($consultarGenero){
                                                                                                                                        $efechaFinContrato = trim(isset($_POST['efechaFinContrato']) ? $_POST['efechaFinContrato']:NULL);
                                                                                                                                            if(!empty($efechaFinContrato)){
                                                                                                                                                if($efechaFinContrato >= $fecha){
                                                                                                                                                    if($eRol == 1 or $eRol == 4){
                                                                                                                                                        // hacer consulta del update
                                                                                                                                                        $actualizarSupervisor = $consulta->actualizarSupervisor($enDoc);

                                                                                                                                                        $editarUsuario = $consulta->editarUsuario($eN2,$eA2,$etDoc,$enDoc,$eRol,$eGenero,$efechaNacimiento,$eCorreo,$eTelefono,$efechaFinContrato,$eDepartamento,$eMunicipio,$editor);
                                                                                                                                                        if (session_status() !== PHP_SESSION_ACTIVE) {
                                                                                                                                                            // Si no está iniciada, la iniciamos
                                                                                                                                                            session_start();
                                                                                                                                                        }
                                                                                                                                                        if($editarUsuario){
                                                                                                                                                        

                                                                                                                                                            if($enDoc == $_SESSION['num_doc']){
                                                                                                                                                                $_SESSION['nombres']=$eN2;
                                                                                                                                                                $_SESSION['apellidos']=$eA2;
                                                                                                                                                                $_SESSION['T_doc']=$etDoc;
                                                                                                                                                                $_SESSION['genero']=$eGenero;
                                                                                                                                                                $_SESSION['rol']=$eRol;
                                                                                                                                                                $_SESSION['fechaNacimiento']=$efechaNacimiento;
                                                                                                                                                                $_SESSION['Correo']=$eCorreo;
                                                                                                                                                                $_SESSION['Telefono']=$eTelefono;
                                                                                                                                                                $_SESSION['fechaFinContrato']=$efechaFinContrato;
                                                                                                                                                                unset($_SESSION['usuarios']);
                                                                                                                                                                $_SESSION['tipo_alert']="success";
                                                                                                                                                                $_SESSION['mensaje']="Usuario editado correctamente";
                                                                                                                                                                echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                            }elseif($enDoc != $_SESSION['num_doc']){
                                                                                                                                                                unset($_SESSION['usuarios']);
                                                                                                                                                                $_SESSION['tipo_alert']="success";
                                                                                                                                                                $_SESSION['mensaje']="Usuario editado correctamente";
                                                                                                                                                                echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                            }else{
                                                                                                                                                                unset($_SESSION['usuarios']);
                                                                                                                                                                $_SESSION['tipo_alert']="danger";
                                                                                                                                                                $_SESSION['mensaje']="Error al editar el usuario, intente otra vez";
                                                                                                                                                                echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                            }
                                                                                                                                                        }else{
                                                                                                                                                            unset($_SESSION['usuarios']);
                                                                                                                                                            $_SESSION['tipo_alert']="danger";
                                                                                                                                                            $_SESSION['mensaje']="Error al editar el usuario";
                                                                                                                                                            echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                        }
                                                                                                                                                        // fin

                                                                                                                                                    }else{
                                                                                                                                                        $eSupervisor = trim(isset($_POST['supervisor']) ? $_POST['supervisor']:NULL);
                                                                                                                                                        if(!empty($eSupervisor)){
                                                                                                                                                            if(is_numeric($eSupervisor)){
                                                                                                                                                                if($eRol == 2){
                                                                                                                                                                    // consulta si existe
                                                                                                                                                                    $consultarSupervisor = $consulta->consultarSupervisorE($eSupervisor,1);
                                                                                                                                                                    if($consultarSupervisor){
                                                                                                                                                                        $editarUsuario = $consulta->editarUsuario($eN2,$eA2,$etDoc,$enDoc,$eRol,$eGenero,$efechaNacimiento,$eCorreo,$eTelefono,$efechaFinContrato,$eDepartamento,$eMunicipio,$editor);
                                                                                                                                                                        $editarSupervisor = $consulta->editarSupervisor($enDoc,$eSupervisor);
                                                                                                                                                                            if (session_status() !== PHP_SESSION_ACTIVE) {
                                                                                                                                                                                // Si no está iniciada, la iniciamos
                                                                                                                                                                                session_start();
                                                                                                                                                                            }
                                                                                                                                                                            if($editarUsuario){
                                                                                                                                                                            
                                                                                                                                                                            
                                                                                                                                                                                if($enDoc == $_SESSION['num_doc']){
                                                                                                                                                                                    $_SESSION['nombres']=$eN2;
                                                                                                                                                                                    $_SESSION['apellidos']=$eA2;
                                                                                                                                                                                    $_SESSION['T_doc']=$etDoc;
                                                                                                                                                                                    $_SESSION['genero']=$eGenero;
                                                                                                                                                                                    $_SESSION['rol']=$eRol;
                                                                                                                                                                                    $_SESSION['fechaNacimiento']=$efechaNacimiento;
                                                                                                                                                                                    $_SESSION['Correo']=$eCorreo;
                                                                                                                                                                                    $_SESSION['Telefono']=$eTelefono;
                                                                                                                                                                                    $_SESSION['fechaFinContrato']=$efechaFinContrato;
                                                                                                                                                                                    unset($_SESSION['usuarios']);
                                                                                                                                                                                    $_SESSION['tipo_alert']="success";
                                                                                                                                                                                    $_SESSION['mensaje']="Usuario editado correctamente";
                                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                }elseif($enDoc != $_SESSION['num_doc']){
                                                                                                                                                                                    unset($_SESSION['usuarios']);
                                                                                                                                                                                    $_SESSION['tipo_alert']="success";
                                                                                                                                                                                    $_SESSION['mensaje']="Usuario editado correctamente";
                                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                }else{
                                                                                                                                                                                    unset($_SESSION['usuarios']);
                                                                                                                                                                                    $_SESSION['tipo_alert']="danger";
                                                                                                                                                                                    $_SESSION['mensaje']="Error al editar el usuario, intente otra vez";
                                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                }
                                                                                                                                                                            }else{
                                                                                                                                                                                unset($_SESSION['usuarios']);
                                                                                                                                                                                $_SESSION['tipo_alert']="danger";
                                                                                                                                                                                $_SESSION['mensaje']="Error al editar el usuario";
                                                                                                                                                                                echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                            }
                                                                                                                                                                            // fin
                                                                                                                                                                    }else{
                                                                                                                                                                        $_SESSION['tipo_alert_editar']="danger";
                                                                                                                                                                        $_SESSION['mensajeEditar']="Error, supervisor inexistente";
                                                                                                                                                                        echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                    }
                                                                                                                                                                }elseif($eRol == 3){
                                                                                                                                                                    $consultarSupervisor = $consulta->consultarSupervisorE($eSupervisor,2);
                                                                                                                                                                    if($consultarSupervisor){
                                                                                                                                                                        $editarUsuario = $consulta->editarUsuario($eN2,$eA2,$etDoc,$enDoc,$eRol,$eGenero,$efechaNacimiento,$eCorreo,$eTelefono,$efechaFinContrato,$eDepartamento,$eMunicipio,$editor);
                                                                                                                                                                        $editarSupervisor = $consulta->editarSupervisor($enDoc,$eSupervisor);    
                                                                                                                                                                        if (session_status() !== PHP_SESSION_ACTIVE) {
                                                                                                                                                                                // Si no está iniciada, la iniciamos
                                                                                                                                                                                session_start();
                                                                                                                                                                            }
                                                                                                                                                                            if($editarUsuario){
                                                                                                                                                                            
                                                                                                                                                                            
                                                                                                                                                                                if($enDoc == $_SESSION['num_doc']){
                                                                                                                                                                                    $_SESSION['nombres']=$eN2;
                                                                                                                                                                                    $_SESSION['apellidos']=$eA2;
                                                                                                                                                                                    $_SESSION['T_doc']=$etDoc;
                                                                                                                                                                                    $_SESSION['genero']=$eGenero;
                                                                                                                                                                                    $_SESSION['rol']=$eRol;
                                                                                                                                                                                    $_SESSION['fechaNacimiento']=$efechaNacimiento;
                                                                                                                                                                                    $_SESSION['Correo']=$eCorreo;
                                                                                                                                                                                    $_SESSION['Telefono']=$eTelefono;
                                                                                                                                                                                    $_SESSION['fechaFinContrato']=$efechaFinContrato;
                                                                                                                                                                                    unset($_SESSION['usuarios']);
                                                                                                                                                                                    $_SESSION['tipo_alert']="success";
                                                                                                                                                                                    $_SESSION['mensaje']="Usuario editado correctamente";
                                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                }elseif($enDoc != $_SESSION['num_doc']){
                                                                                                                                                                                    unset($_SESSION['usuarios']);
                                                                                                                                                                                    $_SESSION['tipo_alert']="success";
                                                                                                                                                                                    $_SESSION['mensaje']="Usuario editado correctamente";
                                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                }else{
                                                                                                                                                                                    unset($_SESSION['usuarios']);
                                                                                                                                                                                    $_SESSION['tipo_alert']="danger";
                                                                                                                                                                                    $_SESSION['mensaje']="Error al editar el usuario, intente otra vez";
                                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                }
                                                                                                                                                                            }else{
                                                                                                                                                                                unset($_SESSION['usuarios']);
                                                                                                                                                                                $_SESSION['tipo_alert']="danger";
                                                                                                                                                                                $_SESSION['mensaje']="Error al editar el usuario";
                                                                                                                                                                                echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                            }
                                                                                                                                                                            // fin
                                                                                                                                                                    }else{
                                                                                                                                                                        $_SESSION['tipo_alert_editar']="danger";
                                                                                                                                                                        $_SESSION['mensajeEditar']="Error, supervisor inexistente";
                                                                                                                                                                        echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                    }
                                                                                                                                                                }else{
                                                                                                                                                                    $_SESSION['tipo_alert_editar']="danger";
                                                                                                                                                                    $_SESSION['mensajeEditar']="Error, intente otra vez";
                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                }      
                                                                                                                                                            }else{
                                                                                                                                                                $_SESSION['tipo_alert_editar']="danger";
                                                                                                                                                                $_SESSION['mensajeEditar']="Error, intente otra vez";
                                                                                                                                                                echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                            }
                                                                                                                                                        }else{
                                                                                                                                                            $_SESSION['tipo_alert_editar']="danger";
                                                                                                                                                            $_SESSION['mensajeEditar']="Seleccione el supervisor de contrato si el rol es coordinador o instructor";
                                                                                                                                                            echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                        }
                                                                                                                                                    }
                                                                                                                                                    
                                                                                                                                                }else{
                                                                                                                                                    $_SESSION['tipo_alert_editar']="danger";
                                                                                                                                                    $_SESSION['mensajeEditar']="La fecha de finalización de contrato debe ser mayor a la fecha actual";
                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                } 
                                                                                                                                            }else{
                                                                                                                                                $_SESSION['tipo_alert_editar']="danger";
                                                                                                                                                $_SESSION['mensajeEditar']="Seleccione una fecha de finalización de contrato";
                                                                                                                                                echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                            }
                                                                                                                                    }else{
                                                                                                                                        $_SESSION['tipo_alert_editar']="danger";
                                                                                                                                        $_SESSION['mensajeEditar']="Ingrese un género valido";
                                                                                                                                        echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                    }
                                                                                                                            }else{
                                                                                                                                $consultarTelefono = $consulta->consultarTelefono($eTelefono);
                                                                                                                                    if($consultarTelefono){
                                                                                                                                        $_SESSION['tipo_alert_editar']="danger";
                                                                                                                                        $_SESSION['mensajeEditar']="El numero telefonico " . $eTelefono . " ya fue resgitrado con otro usuario";
                                                                                                                                        echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                    }else{
                                                                                                                                        $eGenero = trim(isset($_POST['eGenero']) ? $_POST['eGenero']:NULL);
                                                                                                                                                $consultarGenero = $consulta->consultarGenero($eGenero);
                                                                                                                                                    if($consultarGenero){
                                                                                                                                                        $efechaFinContrato = trim(isset($_POST['efechaFinContrato']) ? $_POST['efechaFinContrato']:NULL);
                                                                                                                                                            if(!empty($efechaFinContrato)){
                                                                                                                                                                if($efechaFinContrato >= $fecha){
                                                                                                                                                                    if($eRol == 1 or $eRol == 4){
                                                                                                                                                                        $actualizarSupervisor = $consulta->actualizarSupervisor($enDoc);
                                                                                                                                                                        $editarUsuario = $consulta->editarUsuario($eN2,$eA2,$etDoc,$enDoc,$eRol,$eGenero,$efechaNacimiento,$eCorreo,$eTelefono,$efechaFinContrato,$eDepartamento,$eMunicipio,$editor);
                                                                                                                                                            
                                                                                                                                                                    if (session_status() !== PHP_SESSION_ACTIVE) {
                                                                                                                                                                        // Si no está iniciada, la iniciamos
                                                                                                                                                                        session_start();
                                                                                                                                                                    }
                                                                                                                                                                
                                                                                                                                                                    if($editarUsuario){
                                                                                                                                                                        if($enDoc == $_SESSION['num_doc']){
                                                                                                                                                                           
                                                                                                                                                                            $_SESSION['nombres']=$eN2;
                                                                                                                                                                            $_SESSION['apellidos']=$eA2;
                                                                                                                                                                            $_SESSION['T_doc']=$etDoc;
                                                                                                                                                                            $_SESSION['genero']=$eGenero;
                                                                                                                                                                            $_SESSION['rol']=$eRol;
                                                                                                                                                                             $_SESSION['fechaNacimiento']=$efechaNacimiento;
                                                                                                                                                                            $_SESSION['Correo']=$eCorreo;
                                                                                                                                                                            $_SESSION['Telefono']=$eTelefono;
                                                                                                                                                                            $_SESSION['fechaFinContrato']=$efechaFinContrato;
                                                                                                                                                                            unset($_SESSION['usuarios']);
                                                                                                                                                                            $_SESSION['tipo_alert']="success";
                                                                                                                                                                            $_SESSION['mensaje']="Usuario editado correctamente";
                                                                                                                                                                            echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                        }elseif($enDoc != $_SESSION['num_doc']){
                                                                                                                                                                            unset($_SESSION['usuarios']);
                                                                                                                                                                            $_SESSION['tipo_alert']="success";
                                                                                                                                                                            $_SESSION['mensaje']="Usuario editado correctamente";
                                                                                                                                                                            echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                        }else{
                                                                                                                                                                            unset($_SESSION['usuarios']);
                                                                                                                                                                            $_SESSION['tipo_alert']="danger";
                                                                                                                                                                            $_SESSION['mensaje']="Error al editar el usuario, intente otra vez";
                                                                                                                                                                            echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                        }
                                                                                                                                                                    }else{
                                                                                                                                                                        unset($_SESSION['usuarios']);
                                                                                                                                                                        $_SESSION['tipo_alert']="danger";
                                                                                                                                                                        $_SESSION['mensaje']="Error al editar el usuario";
                                                                                                                                                                        echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                    }
                                                                                                                                                                    // fin
                                                                                                                                                                    }else{
                                                                                                                                                                        
                                                                                                                                                                        $eSupervisor = trim(isset($_POST['supervisor']) ? $_POST['supervisor']:NULL);
                                                                                                                                                        if(!empty($eSupervisor)){
                                                                                                                                                            if(is_numeric($eSupervisor)){
                                                                                                                                                                if($eRol == 2){
                                                                                                                                                                    // consulta si existe
                                                                                                                                                                    $consultarSupervisor = $consulta->consultarSupervisorE($eSupervisor,1);
                                                                                                                                                                    if($consultarSupervisor){
                                                                                                                                                                        $editarUsuario = $consulta->editarUsuario($eN2,$eA2,$etDoc,$enDoc,$eRol,$eGenero,$efechaNacimiento,$eCorreo,$eTelefono,$efechaFinContrato,$eDepartamento,$eMunicipio,$editor);
                                                                                                                                                                        $editarSupervisor = $consulta->editarSupervisor($enDoc,$eSupervisor);
                                                                                                                                                                            if (session_status() !== PHP_SESSION_ACTIVE) {
                                                                                                                                                                                // Si no está iniciada, la iniciamos
                                                                                                                                                                                session_start();
                                                                                                                                                                            }
                                                                                                                                                                            if($editarUsuario){
                                                                                                                                                                            
                                                                                                                                                                            
                                                                                                                                                                                if($enDoc == $_SESSION['num_doc']){
                                                                                                                                                                                    $_SESSION['nombres']=$eN2;
                                                                                                                                                                                    $_SESSION['apellidos']=$eA2;
                                                                                                                                                                                    $_SESSION['T_doc']=$etDoc;
                                                                                                                                                                                    $_SESSION['genero']=$eGenero;
                                                                                                                                                                                    $_SESSION['rol']=$eRol;
                                                                                                                                                                                    $_SESSION['fechaNacimiento']=$efechaNacimiento;
                                                                                                                                                                                    $_SESSION['Correo']=$eCorreo;
                                                                                                                                                                                    $_SESSION['Telefono']=$eTelefono;
                                                                                                                                                                                    $_SESSION['fechaFinContrato']=$efechaFinContrato;
                                                                                                                                                                                    unset($_SESSION['usuarios']);
                                                                                                                                                                                    $_SESSION['tipo_alert']="success";
                                                                                                                                                                                    $_SESSION['mensaje']="Usuario editado correctamente";
                                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                }elseif($enDoc != $_SESSION['num_doc']){
                                                                                                                                                                                    unset($_SESSION['usuarios']);
                                                                                                                                                                                    $_SESSION['tipo_alert']="success";
                                                                                                                                                                                    $_SESSION['mensaje']="Usuario editado correctamente";
                                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                }else{
                                                                                                                                                                                    unset($_SESSION['usuarios']);
                                                                                                                                                                                    $_SESSION['tipo_alert']="danger";
                                                                                                                                                                                    $_SESSION['mensaje']="Error al editar el usuario, intente otra vez";
                                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                }
                                                                                                                                                                            }else{
                                                                                                                                                                                unset($_SESSION['usuarios']);
                                                                                                                                                                                $_SESSION['tipo_alert']="danger";
                                                                                                                                                                                $_SESSION['mensaje']="Error al editar el usuario";
                                                                                                                                                                                echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                            }
                                                                                                                                                                            // fin
                                                                                                                                                                    }else{
                                                                                                                                                                        $_SESSION['tipo_alert_editar']="danger";
                                                                                                                                                                        $_SESSION['mensajeEditar']="Error, supervisor inexistente";
                                                                                                                                                                        echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                    }
                                                                                                                                                                }elseif($eRol == 3){
                                                                                                                                                                    $consultarSupervisor = $consulta->consultarSupervisorE($eSupervisor,2);
                                                                                                                                                                    if($consultarSupervisor){
                                                                                                                                                                        $editarUsuario = $consulta->editarUsuario($eN2,$eA2,$etDoc,$enDoc,$eRol,$eGenero,$efechaNacimiento,$eCorreo,$eTelefono,$efechaFinContrato,$eDepartamento,$eMunicipio,$editor);
                                                                                                                                                                        $editarSupervisor = $consulta->editarSupervisor($enDoc,$eSupervisor);    
                                                                                                                                                                        if (session_status() !== PHP_SESSION_ACTIVE) {
                                                                                                                                                                                // Si no está iniciada, la iniciamos
                                                                                                                                                                                session_start();
                                                                                                                                                                            }
                                                                                                                                                                            if($editarUsuario){
                                                                                                                                                                            
                                                                                                                                                                            
                                                                                                                                                                                if($enDoc == $_SESSION['num_doc']){
                                                                                                                                                                                    $_SESSION['nombres']=$eN2;
                                                                                                                                                                                    $_SESSION['apellidos']=$eA2;
                                                                                                                                                                                    $_SESSION['T_doc']=$etDoc;
                                                                                                                                                                                    $_SESSION['genero']=$eGenero;
                                                                                                                                                                                    $_SESSION['rol']=$eRol;
                                                                                                                                                                                    $_SESSION['fechaNacimiento']=$efechaNacimiento;
                                                                                                                                                                                    $_SESSION['Correo']=$eCorreo;
                                                                                                                                                                                    $_SESSION['Telefono']=$eTelefono;
                                                                                                                                                                                    $_SESSION['fechaFinContrato']=$efechaFinContrato;
                                                                                                                                                                                    unset($_SESSION['usuarios']);
                                                                                                                                                                                    $_SESSION['tipo_alert']="success";
                                                                                                                                                                                    $_SESSION['mensaje']="Usuario editado correctamente";
                                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                }elseif($enDoc != $_SESSION['num_doc']){
                                                                                                                                                                                    unset($_SESSION['usuarios']);
                                                                                                                                                                                    $_SESSION['tipo_alert']="success";
                                                                                                                                                                                    $_SESSION['mensaje']="Usuario editado correctamente";
                                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                }else{
                                                                                                                                                                                    unset($_SESSION['usuarios']);
                                                                                                                                                                                    $_SESSION['tipo_alert']="danger";
                                                                                                                                                                                    $_SESSION['mensaje']="Error al editar el usuario, intente otra vez";
                                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                }
                                                                                                                                                                            }else{
                                                                                                                                                                                unset($_SESSION['usuarios']);
                                                                                                                                                                                $_SESSION['tipo_alert']="danger";
                                                                                                                                                                                $_SESSION['mensaje']="Error al editar el usuario";
                                                                                                                                                                                echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                            }
                                                                                                                                                                            // fin
                                                                                                                                                                    }else{
                                                                                                                                                                        $_SESSION['tipo_alert_editar']="danger";
                                                                                                                                                                        $_SESSION['mensajeEditar']="Error, supervisor inexistente";
                                                                                                                                                                        echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                    }
                                                                                                                                                                }else{
                                                                                                                                                                    $_SESSION['tipo_alert_editar']="danger";
                                                                                                                                                                    $_SESSION['mensajeEditar']="Error, intente otra vez";
                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                }      
                                                                                                                                                            }else{
                                                                                                                                                                $_SESSION['tipo_alert_editar']="danger";
                                                                                                                                                                $_SESSION['mensajeEditar']="Error, intente otra vez";
                                                                                                                                                                echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                            }
                                                                                                                                                        }else{
                                                                                                                                                            $_SESSION['tipo_alert_editar']="danger";
                                                                                                                                                            $_SESSION['mensajeEditar']="Seleccione el supervisor de contrato si el rol es coordinador o instructor";
                                                                                                                                                            echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                        }
                                                                                                                                                                    }
                                                                                                                                                                    
                                                                                                                                                                }else{
                                                                                                                                                                    $_SESSION['tipo_alert_editar']="danger";
                                                                                                                                                                    $_SESSION['mensajeEditar']="La fecha de finalización de contrato debe ser mayor a la fecha actual";
                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                }
                                                                                                                                                                
                                                                                                                                                            }else{
                                                                                                                                                                $_SESSION['tipo_alert_editar']="danger";
                                                                                                                                                                $_SESSION['mensajeEditar']="Seleccione una fecha de finalización de contrato";
                                                                                                                                                                echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                            }
                                                                                                                                                    }else{
                                                                                                                                                        $_SESSION['tipo_alert_editar']="danger";
                                                                                                                                                        $_SESSION['mensajeEditar']="Ingrese un género valido";
                                                                                                                                                        echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                    }
                                                                                                                                    }
                                                                                                                            }                                                                                       
                                                                                                                        }else{
                                                                                                                            $_SESSION['tipo_alert_editar']="danger";
                                                                                                                            $_SESSION['mensajeEditar']="Ingrese numero telefonico valido";
                                                                                                                            echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                        }
                                                                                                                }else{
                                                                                                                    $_SESSION['tipo_alert_editar']="danger";
                                                                                                                    $_SESSION['mensajeEditar']="Error de numero de telefono";
                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                }
                                                                                                            }else{
                                                                                                                $_SESSION['tipo_alert_editar']="danger";
                                                                                                                $_SESSION['mensajeEditar']="Ingrese numero telefonico";
                                                                                                                echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                            }
                                                                                                        }elseif($_SESSION['usuarios'][0]['Correo'] == $eCorreo){
                                                                                                            $eTelefono = trim(isset($_POST['eTelefono']) ? $_POST['eTelefono']:NULL);
                                                                                                            if(!empty($eTelefono)){
                                                                                                                if(is_numeric($eTelefono)){
                                                                                                                    $num = strlen($eTelefono);
                                                                                                                        if($num == 10){
                                                                                                                        
                                                                                                                            if($eTelefono == $_SESSION['usuarios'][0]['Telefono']){
                                                                                                                                $eGenero = trim(isset($_POST['eGenero']) ? $_POST['eGenero']:NULL);
                                                                                                                                $consultarGenero = $consulta->consultarGenero($eGenero);
                                                                                                                                    if($consultarGenero){
                                                                                                                                        $efechaFinContrato = trim(isset($_POST['efechaFinContrato']) ? $_POST['efechaFinContrato']:NULL);
                                                                                                                                            if(!empty($efechaFinContrato)){
                                                                                                                                                // var_dump($efechaFinContrato, $fecha);
                                                                                                                                                // die();
                                                                                                                                                if($efechaFinContrato >= $fecha){

                                                                                                                                                    if($eRol == 1 or $eRol == 4){
                                                                                                                                                        $actualizarSupervisor = $consulta->actualizarSupervisor($enDoc);
                                                                                                                                                        $editarUsuario = $consulta->editarUsuario($eN2,$eA2,$etDoc,$enDoc,$eRol,$eGenero,$efechaNacimiento,$eCorreo,$eTelefono,$efechaFinContrato,$eDepartamento,$eMunicipio,$editor);
                                                                                                                                            
                                                                                                                                                    if (session_status() !== PHP_SESSION_ACTIVE) {
                                                                                                                                                        // Si no está iniciada, la iniciamos
                                                                                                                                                        session_start();
                                                                                                                                                    }
                                                                                                                                                
                                                                                                                                                    if($editarUsuario){
                                                                                                                                                        if($enDoc == $_SESSION['num_doc']){
                                                                                                                                                            
                                                                                                                                                            $_SESSION['nombres']=$eN2;
                                                                                                                                                            $_SESSION['apellidos']=$eA2;
                                                                                                                                                            $_SESSION['T_doc']=$etDoc;
                                                                                                                                                            $_SESSION['genero']=$eGenero;
                                                                                                                                                            $_SESSION['rol']=$eRol;
                                                                                                                                                            $_SESSION['fechaNacimiento']=$efechaNacimiento;
                                                                                                                                                            $_SESSION['Correo']=$eCorreo;
                                                                                                                                                            $_SESSION['Telefono']=$eTelefono;
                                                                                                                                                            $_SESSION['fechaFinContrato']=$efechaFinContrato;
                                                                                                                                                            unset($_SESSION['usuarios']);
                                                                                                                                                            $_SESSION['tipo_alert']="success";
                                                                                                                                                            $_SESSION['mensaje']="Usuario editado correctamente";
                                                                                                                                                            echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                        }elseif($enDoc != $_SESSION['num_doc']){
                                                                                                                                                            unset($_SESSION['usuarios']);
                                                                                                                                                            $_SESSION['tipo_alert']="success";
                                                                                                                                                            $_SESSION['mensaje']="Usuario editado correctamente";
                                                                                                                                                            echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                        }else{
                                                                                                                                                            unset($_SESSION['usuarios']);
                                                                                                                                                            $_SESSION['tipo_alert']="danger";
                                                                                                                                                            $_SESSION['mensaje']="Error al editar el usuario, intente otra vez";
                                                                                                                                                            echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                        }
                                                                                                                                                    }else{
                                                                                                                                                        unset($_SESSION['usuarios']);
                                                                                                                                                        $_SESSION['tipo_alert']="danger";
                                                                                                                                                        $_SESSION['mensaje']="Error al editar el usuario";
                                                                                                                                                        echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                    }
                                                                                                                                                    // fin
                                                                                                                                                    }else{
                                                                                                                                                        $eSupervisor = trim(isset($_POST['supervisor']) ? $_POST['supervisor']:NULL);
                                                                                                                                                        if(!empty($eSupervisor)){
                                                                                                                                                            if(is_numeric($eSupervisor)){
                                                                                                                                                                if($eRol == 2){
                                                                                                                                                                    // consulta si existe
                                                                                                                                                                    $consultarSupervisor = $consulta->consultarSupervisorE($eSupervisor,1);
                                                                                                                                                                    if($consultarSupervisor){
                                                                                                                                                                        $editarUsuario = $consulta->editarUsuario($eN2,$eA2,$etDoc,$enDoc,$eRol,$eGenero,$efechaNacimiento,$eCorreo,$eTelefono,$efechaFinContrato,$eDepartamento,$eMunicipio,$editor);
                                                                                                                                                                        $editarSupervisor = $consulta->editarSupervisor($enDoc,$eSupervisor);
                                                                                                                                                                            if (session_status() !== PHP_SESSION_ACTIVE) {
                                                                                                                                                                                // Si no está iniciada, la iniciamos
                                                                                                                                                                                session_start();
                                                                                                                                                                            }
                                                                                                                                                                            if($editarUsuario){
                                                                                                                                                                            
                                                                                                                                                                            
                                                                                                                                                                                if($enDoc == $_SESSION['num_doc']){
                                                                                                                                                                                    $_SESSION['nombres']=$eN2;
                                                                                                                                                                                    $_SESSION['apellidos']=$eA2;
                                                                                                                                                                                    $_SESSION['T_doc']=$etDoc;
                                                                                                                                                                                    $_SESSION['genero']=$eGenero;
                                                                                                                                                                                    $_SESSION['rol']=$eRol;
                                                                                                                                                                                    $_SESSION['fechaNacimiento']=$efechaNacimiento;
                                                                                                                                                                                    $_SESSION['Correo']=$eCorreo;
                                                                                                                                                                                    $_SESSION['Telefono']=$eTelefono;
                                                                                                                                                                                    $_SESSION['fechaFinContrato']=$efechaFinContrato;
                                                                                                                                                                                    unset($_SESSION['usuarios']);
                                                                                                                                                                                    $_SESSION['tipo_alert']="success";
                                                                                                                                                                                    $_SESSION['mensaje']="Usuario editado correctamente";
                                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                }elseif($enDoc != $_SESSION['num_doc']){
                                                                                                                                                                                    unset($_SESSION['usuarios']);
                                                                                                                                                                                    $_SESSION['tipo_alert']="success";
                                                                                                                                                                                    $_SESSION['mensaje']="Usuario editado correctamente";
                                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                }else{
                                                                                                                                                                                    unset($_SESSION['usuarios']);
                                                                                                                                                                                    $_SESSION['tipo_alert']="danger";
                                                                                                                                                                                    $_SESSION['mensaje']="Error al editar el usuario, intente otra vez";
                                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                }
                                                                                                                                                                            }else{
                                                                                                                                                                                unset($_SESSION['usuarios']);
                                                                                                                                                                                $_SESSION['tipo_alert']="danger";
                                                                                                                                                                                $_SESSION['mensaje']="Error al editar el usuario";
                                                                                                                                                                                echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                            }
                                                                                                                                                                            // fin
                                                                                                                                                                    }else{
                                                                                                                                                                        $_SESSION['tipo_alert_editar']="danger";
                                                                                                                                                                        $_SESSION['mensajeEditar']="Error, supervisor inexistente";
                                                                                                                                                                        echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                    }
                                                                                                                                                                }elseif($eRol == 3){
                                                                                                                                                                    $consultarSupervisor = $consulta->consultarSupervisorE($eSupervisor,2);
                                                                                                                                                                    if($consultarSupervisor){
                                                                                                                                                                        $editarUsuario = $consulta->editarUsuario($eN2,$eA2,$etDoc,$enDoc,$eRol,$eGenero,$efechaNacimiento,$eCorreo,$eTelefono,$efechaFinContrato,$eDepartamento,$eMunicipio,$editor);
                                                                                                                                                                        $editarSupervisor = $consulta->editarSupervisor($enDoc,$eSupervisor);    
                                                                                                                                                                        if (session_status() !== PHP_SESSION_ACTIVE) {
                                                                                                                                                                                // Si no está iniciada, la iniciamos
                                                                                                                                                                                session_start();
                                                                                                                                                                            }
                                                                                                                                                                            if($editarUsuario){
                                                                                                                                                                            
                                                                                                                                                                            
                                                                                                                                                                                if($enDoc == $_SESSION['num_doc']){
                                                                                                                                                                                    $_SESSION['nombres']=$eN2;
                                                                                                                                                                                    $_SESSION['apellidos']=$eA2;
                                                                                                                                                                                    $_SESSION['T_doc']=$etDoc;
                                                                                                                                                                                    $_SESSION['genero']=$eGenero;
                                                                                                                                                                                    $_SESSION['rol']=$eRol;
                                                                                                                                                                                    $_SESSION['fechaNacimiento']=$efechaNacimiento;
                                                                                                                                                                                    $_SESSION['Correo']=$eCorreo;
                                                                                                                                                                                    $_SESSION['Telefono']=$eTelefono;
                                                                                                                                                                                    $_SESSION['fechaFinContrato']=$efechaFinContrato;
                                                                                                                                                                                    unset($_SESSION['usuarios']);
                                                                                                                                                                                    $_SESSION['tipo_alert']="success";
                                                                                                                                                                                    $_SESSION['mensaje']="Usuario editado correctamente";
                                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                }elseif($enDoc != $_SESSION['num_doc']){
                                                                                                                                                                                    unset($_SESSION['usuarios']);
                                                                                                                                                                                    $_SESSION['tipo_alert']="success";
                                                                                                                                                                                    $_SESSION['mensaje']="Usuario editado correctamente";
                                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                }else{
                                                                                                                                                                                    unset($_SESSION['usuarios']);
                                                                                                                                                                                    $_SESSION['tipo_alert']="danger";
                                                                                                                                                                                    $_SESSION['mensaje']="Error al editar el usuario, intente otra vez";
                                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                }
                                                                                                                                                                            }else{
                                                                                                                                                                                unset($_SESSION['usuarios']);
                                                                                                                                                                                $_SESSION['tipo_alert']="danger";
                                                                                                                                                                                $_SESSION['mensaje']="Error al editar el usuario";
                                                                                                                                                                                echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                            }
                                                                                                                                                                            // fin
                                                                                                                                                                    }else{
                                                                                                                                                                        $_SESSION['tipo_alert_editar']="danger";
                                                                                                                                                                        $_SESSION['mensajeEditar']="Error, supervisor inexistente";
                                                                                                                                                                        echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                    }
                                                                                                                                                                }else{
                                                                                                                                                                    $_SESSION['tipo_alert_editar']="danger";
                                                                                                                                                                    $_SESSION['mensajeEditar']="Error, intente otra vez";
                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                }      
                                                                                                                                                            }else{
                                                                                                                                                                $_SESSION['tipo_alert_editar']="danger";
                                                                                                                                                                $_SESSION['mensajeEditar']="Error, intente otra vez";
                                                                                                                                                                echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                            }
                                                                                                                                                        }else{
                                                                                                                                                            $_SESSION['tipo_alert_editar']="danger";
                                                                                                                                                            $_SESSION['mensajeEditar']="Seleccione el supervisor de contrato si el rol es coordinador o instructor";
                                                                                                                                                            echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                        }
                                                                                                                                                    }
                                                                                                                                                    
                                                                                                                                                }else{
                                                                                                                                                    $_SESSION['tipo_alert_editar']="danger";
                                                                                                                                                    $_SESSION['mensajeEditar']="La fecha de finalización de contrato debe ser mayor a la fecha actual";
                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                }
                                                                                                                                            }else{
                                                                                                                                                $_SESSION['tipo_alert_editar']="danger";
                                                                                                                                                $_SESSION['mensajeEditar']="Seleccione una fecha de finalización de contrato";
                                                                                                                                                echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                            }
                                                                                                                                    }else{
                                                                                                                                        $_SESSION['tipo_alert_editar']="danger";
                                                                                                                                        $_SESSION['mensajeEditar']="Ingrese un género valido";
                                                                                                                                        echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                    }
                                                                                                                            }else{
                                                                                                                                $consultarTelefono = $consulta->consultarTelefono($eTelefono);
                                                                                                                                    if($consultarTelefono){
                                                                                                                                        $_SESSION['tipo_alert_editar']="danger";
                                                                                                                                        $_SESSION['mensajeEditar']="El numero telefonico " . $eTelefono . " ya fue resgitrado con otro usuario";
                                                                                                                                        echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                    }else{
                                                                                                                                    $eGenero = trim(isset($_POST['eGenero']) ? $_POST['eGenero']:NULL);
                                                                                                                                        $consultarGenero = $consulta->consultarGenero($eGenero);
                                                                                                                                            if($consultarGenero){
                                                                                                                                                $efechaFinContrato = trim(isset($_POST['efechaFinContrato']) ? $_POST['efechaFinContrato']:NULL);
                                                                                                                                                    if(!empty($efechaFinContrato)){
                                                                                                                                                        if($efechaFinContrato >= $fecha){
                                                                                                                                                            if($eRol == 1 or $eRol == 4){
                                                                                                                                                                $actualizarSupervisor = $consulta->actualizarSupervisor($enDoc);
                                                                                                                                                                $editarUsuario = $consulta->editarUsuario($eN2,$eA2,$etDoc,$enDoc,$eRol,$eGenero,$efechaNacimiento,$eCorreo,$eTelefono,$efechaFinContrato,$eDepartamento,$eMunicipio,$editor);
                                                                                                                                                    
                                                                                                                                                            if (session_status() !== PHP_SESSION_ACTIVE) {
                                                                                                                                                                // Si no está iniciada, la iniciamos
                                                                                                                                                                session_start();
                                                                                                                                                            }
                                                                                                                                                        
                                                                                                                                                            if($editarUsuario){
                                                                                                                                                                if($enDoc == $_SESSION['num_doc']){
                                                                                                                                                                    
                                                                                                                                                                    $_SESSION['nombres']=$eN2;
                                                                                                                                                                    $_SESSION['apellidos']=$eA2;
                                                                                                                                                                    $_SESSION['T_doc']=$etDoc;
                                                                                                                                                                    $_SESSION['genero']=$eGenero;
                                                                                                                                                                    $_SESSION['rol']=$eRol;
                                                                                                                                                                    $_SESSION['fechaNacimiento']=$efechaNacimiento;
                                                                                                                                                                    $_SESSION['Correo']=$eCorreo;
                                                                                                                                                                    $_SESSION['Telefono']=$eTelefono;
                                                                                                                                                                    $_SESSION['fechaFinContrato']=$efechaFinContrato;
                                                                                                                                                                    unset($_SESSION['usuarios']);
                                                                                                                                                                    $_SESSION['tipo_alert']="success";
                                                                                                                                                                    $_SESSION['mensaje']="Usuario editado correctamente";
                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                }elseif($enDoc != $_SESSION['num_doc']){
                                                                                                                                                                    unset($_SESSION['usuarios']);
                                                                                                                                                                    $_SESSION['tipo_alert']="success";
                                                                                                                                                                    $_SESSION['mensaje']="Usuario editado correctamente";
                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                }else{
                                                                                                                                                                    unset($_SESSION['usuarios']);
                                                                                                                                                                    $_SESSION['tipo_alert']="danger";
                                                                                                                                                                    $_SESSION['mensaje']="Error al editar el usuario, intente otra vez";
                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                }
                                                                                                                                                            }else{
                                                                                                                                                                unset($_SESSION['usuarios']);
                                                                                                                                                                $_SESSION['tipo_alert']="danger";
                                                                                                                                                                $_SESSION['mensaje']="Error al editar el usuario";
                                                                                                                                                                echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                            }
                                                                                                                                                            // fin
                                                                                                                                                            }else{
                                                                                                                                                                $eSupervisor = trim(isset($_POST['supervisor']) ? $_POST['supervisor']:NULL);
                                                                                                                                                        if(!empty($eSupervisor)){
                                                                                                                                                            if(is_numeric($eSupervisor)){
                                                                                                                                                                if($eRol == 2){
                                                                                                                                                                    // consulta si existe
                                                                                                                                                                    $consultarSupervisor = $consulta->consultarSupervisorE($eSupervisor,1);
                                                                                                                                                                    if($consultarSupervisor){
                                                                                                                                                                        $editarUsuario = $consulta->editarUsuario($eN2,$eA2,$etDoc,$enDoc,$eRol,$eGenero,$efechaNacimiento,$eCorreo,$eTelefono,$efechaFinContrato,$eDepartamento,$eMunicipio,$editor);
                                                                                                                                                                        $editarSupervisor = $consulta->editarSupervisor($enDoc,$eSupervisor);
                                                                                                                                                                            if (session_status() !== PHP_SESSION_ACTIVE) {
                                                                                                                                                                                // Si no está iniciada, la iniciamos
                                                                                                                                                                                session_start();
                                                                                                                                                                            }
                                                                                                                                                                            if($editarUsuario){
                                                                                                                                                                            
                                                                                                                                                                            
                                                                                                                                                                                if($enDoc == $_SESSION['num_doc']){
                                                                                                                                                                                    $_SESSION['nombres']=$eN2;
                                                                                                                                                                                    $_SESSION['apellidos']=$eA2;
                                                                                                                                                                                    $_SESSION['T_doc']=$etDoc;
                                                                                                                                                                                    $_SESSION['genero']=$eGenero;
                                                                                                                                                                                    $_SESSION['rol']=$eRol;
                                                                                                                                                                                    $_SESSION['fechaNacimiento']=$efechaNacimiento;
                                                                                                                                                                                    $_SESSION['Correo']=$eCorreo;
                                                                                                                                                                                    $_SESSION['Telefono']=$eTelefono;
                                                                                                                                                                                    $_SESSION['fechaFinContrato']=$efechaFinContrato;
                                                                                                                                                                                    unset($_SESSION['usuarios']);
                                                                                                                                                                                    $_SESSION['tipo_alert']="success";
                                                                                                                                                                                    $_SESSION['mensaje']="Usuario editado correctamente";
                                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                }elseif($enDoc != $_SESSION['num_doc']){
                                                                                                                                                                                    unset($_SESSION['usuarios']);
                                                                                                                                                                                    $_SESSION['tipo_alert']="success";
                                                                                                                                                                                    $_SESSION['mensaje']="Usuario editado correctamente";
                                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                }else{
                                                                                                                                                                                    unset($_SESSION['usuarios']);
                                                                                                                                                                                    $_SESSION['tipo_alert']="danger";
                                                                                                                                                                                    $_SESSION['mensaje']="Error al editar el usuario, intente otra vez";
                                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                }
                                                                                                                                                                            }else{
                                                                                                                                                                                unset($_SESSION['usuarios']);
                                                                                                                                                                                $_SESSION['tipo_alert']="danger";
                                                                                                                                                                                $_SESSION['mensaje']="Error al editar el usuario";
                                                                                                                                                                                echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                            }
                                                                                                                                                                            // fin
                                                                                                                                                                    }else{
                                                                                                                                                                        $_SESSION['tipo_alert_editar']="danger";
                                                                                                                                                                        $_SESSION['mensajeEditar']="Error, supervisor inexistente";
                                                                                                                                                                        echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                    }
                                                                                                                                                                }elseif($eRol == 3){
                                                                                                                                                                    $consultarSupervisor = $consulta->consultarSupervisorE($eSupervisor,2);
                                                                                                                                                                    if($consultarSupervisor){
                                                                                                                                                                        $editarUsuario = $consulta->editarUsuario($eN2,$eA2,$etDoc,$enDoc,$eRol,$eGenero,$efechaNacimiento,$eCorreo,$eTelefono,$efechaFinContrato,$eDepartamento,$eMunicipio,$editor);
                                                                                                                                                                        $editarSupervisor = $consulta->editarSupervisor($enDoc,$eSupervisor);    
                                                                                                                                                                        if (session_status() !== PHP_SESSION_ACTIVE) {
                                                                                                                                                                                // Si no está iniciada, la iniciamos
                                                                                                                                                                                session_start();
                                                                                                                                                                            }
                                                                                                                                                                            if($editarUsuario){
                                                                                                                                                                            
                                                                                                                                                                            
                                                                                                                                                                                if($enDoc == $_SESSION['num_doc']){
                                                                                                                                                                                    $_SESSION['nombres']=$eN2;
                                                                                                                                                                                    $_SESSION['apellidos']=$eA2;
                                                                                                                                                                                    $_SESSION['T_doc']=$etDoc;
                                                                                                                                                                                    $_SESSION['genero']=$eGenero;
                                                                                                                                                                                    $_SESSION['rol']=$eRol;
                                                                                                                                                                                    $_SESSION['fechaNacimiento']=$efechaNacimiento;
                                                                                                                                                                                    $_SESSION['Correo']=$eCorreo;
                                                                                                                                                                                    $_SESSION['Telefono']=$eTelefono;
                                                                                                                                                                                    $_SESSION['fechaFinContrato']=$efechaFinContrato;
                                                                                                                                                                                    unset($_SESSION['usuarios']);
                                                                                                                                                                                    $_SESSION['tipo_alert']="success";
                                                                                                                                                                                    $_SESSION['mensaje']="Usuario editado correctamente";
                                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                }elseif($enDoc != $_SESSION['num_doc']){
                                                                                                                                                                                    unset($_SESSION['usuarios']);
                                                                                                                                                                                    $_SESSION['tipo_alert']="success";
                                                                                                                                                                                    $_SESSION['mensaje']="Usuario editado correctamente";
                                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                }else{
                                                                                                                                                                                    unset($_SESSION['usuarios']);
                                                                                                                                                                                    $_SESSION['tipo_alert']="danger";
                                                                                                                                                                                    $_SESSION['mensaje']="Error al editar el usuario, intente otra vez";
                                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                }
                                                                                                                                                                            }else{
                                                                                                                                                                                unset($_SESSION['usuarios']);
                                                                                                                                                                                $_SESSION['tipo_alert']="danger";
                                                                                                                                                                                $_SESSION['mensaje']="Error al editar el usuario";
                                                                                                                                                                                echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                            }
                                                                                                                                                                            // fin
                                                                                                                                                                    }else{
                                                                                                                                                                        $_SESSION['tipo_alert_editar']="danger";
                                                                                                                                                                        $_SESSION['mensajeEditar']="Error, supervisor inexistente";
                                                                                                                                                                        echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                    }
                                                                                                                                                                }else{
                                                                                                                                                                    $_SESSION['tipo_alert_editar']="danger";
                                                                                                                                                                    $_SESSION['mensajeEditar']="Error, intente otra vez";
                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                }      
                                                                                                                                                            }else{
                                                                                                                                                                $_SESSION['tipo_alert_editar']="danger";
                                                                                                                                                                $_SESSION['mensajeEditar']="Error, intente otra vez";
                                                                                                                                                                echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                            }
                                                                                                                                                        }else{
                                                                                                                                                            $_SESSION['tipo_alert_editar']="danger";
                                                                                                                                                            $_SESSION['mensajeEditar']="Seleccione el supervisor de contrato si el rol es coordinador o instructor";
                                                                                                                                                            echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                        }
                                                                                                                                                            }
                                                                                                                                                            
                                                                                                                                                        }else{
                                                                                                                                                            $_SESSION['tipo_alert_editar']="danger";
                                                                                                                                                            $_SESSION['mensajeEditar']="La fecha de finalización de contrato debe ser mayor a la fecha actual";
                                                                                                                                                            echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                        }
                                                                                                                                                    }else{
                                                                                                                                                        $_SESSION['tipo_alert_editar']="danger";
                                                                                                                                                        $_SESSION['mensajeEditar']="Seleccione una fecha de finalización de contrato";
                                                                                                                                                        echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                    }
                                                                                                                                            }else{
                                                                                                                                                $_SESSION['tipo_alert_editar']="danger";
                                                                                                                                                $_SESSION['mensajeEditar']="Ingrese un género valido";
                                                                                                                                                echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                            }
                                                                                                                                    }
                                                                                                                            }
    
                                                                                                                        
                                                                                                                        
                                                                                                                        }else{
                                                                                                                            $_SESSION['tipo_alert_editar']="danger";
                                                                                                                            $_SESSION['mensajeEditar']="Ingrese numero telefonico valido";
                                                                                                                            echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                        }
                                                                                                                }else{
                                                                                                                    $_SESSION['tipo_alert_editar']="danger";
                                                                                                                    $_SESSION['mensajeEditar']="Error de numero de telefono";
                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                }
                                                                                                            }else{
                                                                                                                $_SESSION['tipo_alert_editar']="danger";
                                                                                                                $_SESSION['mensajeEditar']="Ingrese numero telefonico";
                                                                                                                echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                            }
                                                                                                        }else{
                                                                                                            $consultarCorreo = $consulta->consultarCorreo($eCorreo);
                                                                                                            if($consultarCorreo){
                                                                                                                $_SESSION['tipo_alert_editar']="danger";
                                                                                                                $_SESSION['mensajeEditar']="El correo electrónico " . $eCorreo .  " ya esta en uso con otro usuario";
                                                                                                                echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                            }else{
                                                                                                                $eTelefono = trim(isset($_POST['eTelefono']) ? $_POST['eTelefono']:NULL);
                                                                                                                if(!empty($eTelefono)){
                                                                                                                    if(is_numeric($eTelefono)){
                                                                                                                        $num = strlen($eTelefono);
                                                                                                                            if($num == 10){
                                                                                                                                $consultarTelefono = $consulta->consultarTelefono($eTelefono);
                                                                                                                                    if($consultarTelefono){
                                                                                                                                        $_SESSION['tipo_alert_editar']="danger";
                                                                                                                                        $_SESSION['mensajeEditar']="El numero telefonico " . $eTelefono . " ya fue resgitrado con otro usuario";
                                                                                                                                        echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                    }else{
                                                                                                                                        $eGenero = trim(isset($_POST['eGenero']) ? $_POST['eGenero']:NULL);
                                                                                                                                        $consultarGenero = $consulta->consultarGenero($eGenero);
                                                                                                                                            if($consultarGenero){
                                                                                                                                                $efechaFinContrato = trim(isset($_POST['efechaFinContrato']) ? $_POST['efechaFinContrato']:NULL);
                                                                                                                                                    if(!empty($efechaFinContrato)){
                                                                                                                                                        if($efechaFinContrato >= $fecha){
                                                                                                                                                            if($eRol == 1 or $eRol == 4){
                                                                                                                                                                $actualizarSupervisor = $consulta->actualizarSupervisor($enDoc);
                                                                                                                                                                $editarUsuario = $consulta->editarUsuario($eN2,$eA2,$etDoc,$enDoc,$eRol,$eGenero,$efechaNacimiento,$eCorreo,$eTelefono,$efechaFinContrato,$eDepartamento,$eMunicipio,$editor);
                                                                                                                                                            if (session_status() !== PHP_SESSION_ACTIVE) {
                                                                                                                                                                // Si no está iniciada, la iniciamos
                                                                                                                                                                session_start();
                                                                                                                                                            }
                                                                                                                                                            if($editarUsuario){
                                                                                                                                                                if($enDoc == $_SESSION['num_doc']){
                                                                                                                                                                    
                                                                                                                                                                    $_SESSION['nombres']=$eN2;
                                                                                                                                                                    $_SESSION['apellidos']=$eA2;
                                                                                                                                                                    $_SESSION['T_doc']=$etDoc;
                                                                                                                                                                    $_SESSION['genero']=$eGenero;
                                                                                                                                                                    $_SESSION['rol']=$eRol;
                                                                                                                                                                    $_SESSION['fechaNacimiento']=$efechaNacimiento;
                                                                                                                                                                    $_SESSION['Correo']=$eCorreo;
                                                                                                                                                                    $_SESSION['Telefono']=$eTelefono;
                                                                                                                                                                    unset($_SESSION['usuarios']);
                                                                                                                                                                    $_SESSION['tipo_alert']="success";
                                                                                                                                                                    $_SESSION['mensaje']="Usuario editado correctamente";
                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                }elseif($enDoc != $_SESSION['num_doc']){
                                                                                                                                                                    unset($_SESSION['usuarios']);
                                                                                                                                                                    $_SESSION['tipo_alert']="success";
                                                                                                                                                                    $_SESSION['mensaje']="Usuario editado correctamente";
                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                }else{
                                                                                                                                                                    unset($_SESSION['usuarios']);
                                                                                                                                                                    $_SESSION['tipo_alert']="danger";
                                                                                                                                                                    $_SESSION['mensaje']="Error al editar el usuario, intente otra vez";
                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                }
                                                                                                                                                            }else{
                                                                                                                                                                unset($_SESSION['usuarios']);
                                                                                                                                                                $_SESSION['tipo_alert']="danger";
                                                                                                                                                                $_SESSION['mensaje']="Error al editar el usuario";
                                                                                                                                                                echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                            }
                                                                                                                                                            // fin
                                                                                                                                                            }else{
                                                                                                                                                                $eSupervisor = trim(isset($_POST['supervisor']) ? $_POST['supervisor']:NULL);
                                                                                                                                                        if(!empty($eSupervisor)){
                                                                                                                                                            if(is_numeric($eSupervisor)){
                                                                                                                                                                if($eRol == 2){
                                                                                                                                                                    // consulta si existe
                                                                                                                                                                    $consultarSupervisor = $consulta->consultarSupervisorE($eSupervisor,1);
                                                                                                                                                                    if($consultarSupervisor){
                                                                                                                                                                        $editarUsuario = $consulta->editarUsuario($eN2,$eA2,$etDoc,$enDoc,$eRol,$eGenero,$efechaNacimiento,$eCorreo,$eTelefono,$efechaFinContrato,$eDepartamento,$eMunicipio,$editor);
                                                                                                                                                                        $editarSupervisor = $consulta->editarSupervisor($enDoc,$eSupervisor);
                                                                                                                                                                            if (session_status() !== PHP_SESSION_ACTIVE) {
                                                                                                                                                                                // Si no está iniciada, la iniciamos
                                                                                                                                                                                session_start();
                                                                                                                                                                            }
                                                                                                                                                                            if($editarUsuario){
                                                                                                                                                                            
                                                                                                                                                                            
                                                                                                                                                                                if($enDoc == $_SESSION['num_doc']){
                                                                                                                                                                                    $_SESSION['nombres']=$eN2;
                                                                                                                                                                                    $_SESSION['apellidos']=$eA2;
                                                                                                                                                                                    $_SESSION['T_doc']=$etDoc;
                                                                                                                                                                                    $_SESSION['genero']=$eGenero;
                                                                                                                                                                                    $_SESSION['rol']=$eRol;
                                                                                                                                                                                    $_SESSION['fechaNacimiento']=$efechaNacimiento;
                                                                                                                                                                                    $_SESSION['Correo']=$eCorreo;
                                                                                                                                                                                    $_SESSION['Telefono']=$eTelefono;
                                                                                                                                                                                    $_SESSION['fechaFinContrato']=$efechaFinContrato;
                                                                                                                                                                                    unset($_SESSION['usuarios']);
                                                                                                                                                                                    $_SESSION['tipo_alert']="success";
                                                                                                                                                                                    $_SESSION['mensaje']="Usuario editado correctamente";
                                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                }elseif($enDoc != $_SESSION['num_doc']){
                                                                                                                                                                                    unset($_SESSION['usuarios']);
                                                                                                                                                                                    $_SESSION['tipo_alert']="success";
                                                                                                                                                                                    $_SESSION['mensaje']="Usuario editado correctamente";
                                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                }else{
                                                                                                                                                                                    unset($_SESSION['usuarios']);
                                                                                                                                                                                    $_SESSION['tipo_alert']="danger";
                                                                                                                                                                                    $_SESSION['mensaje']="Error al editar el usuario, intente otra vez";
                                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                }
                                                                                                                                                                            }else{
                                                                                                                                                                                unset($_SESSION['usuarios']);
                                                                                                                                                                                $_SESSION['tipo_alert']="danger";
                                                                                                                                                                                $_SESSION['mensaje']="Error al editar el usuario";
                                                                                                                                                                                echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                            }
                                                                                                                                                                            // fin
                                                                                                                                                                    }else{
                                                                                                                                                                        $_SESSION['tipo_alert_editar']="danger";
                                                                                                                                                                        $_SESSION['mensajeEditar']="Error, supervisor inexistente";
                                                                                                                                                                        echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                    }
                                                                                                                                                                }elseif($eRol == 3){
                                                                                                                                                                    $consultarSupervisor = $consulta->consultarSupervisorE($eSupervisor,2);
                                                                                                                                                                    if($consultarSupervisor){
                                                                                                                                                                        $editarUsuario = $consulta->editarUsuario($eN2,$eA2,$etDoc,$enDoc,$eRol,$eGenero,$efechaNacimiento,$eCorreo,$eTelefono,$efechaFinContrato,$eDepartamento,$eMunicipio,$editor);
                                                                                                                                                                        $editarSupervisor = $consulta->editarSupervisor($enDoc,$eSupervisor);    
                                                                                                                                                                        if (session_status() !== PHP_SESSION_ACTIVE) {
                                                                                                                                                                                // Si no está iniciada, la iniciamos
                                                                                                                                                                                session_start();
                                                                                                                                                                            }
                                                                                                                                                                            if($editarUsuario){
                                                                                                                                                                            
                                                                                                                                                                            
                                                                                                                                                                                if($enDoc == $_SESSION['num_doc']){
                                                                                                                                                                                    $_SESSION['nombres']=$eN2;
                                                                                                                                                                                    $_SESSION['apellidos']=$eA2;
                                                                                                                                                                                    $_SESSION['T_doc']=$etDoc;
                                                                                                                                                                                    $_SESSION['genero']=$eGenero;
                                                                                                                                                                                    $_SESSION['rol']=$eRol;
                                                                                                                                                                                    $_SESSION['fechaNacimiento']=$efechaNacimiento;
                                                                                                                                                                                    $_SESSION['Correo']=$eCorreo;
                                                                                                                                                                                    $_SESSION['Telefono']=$eTelefono;
                                                                                                                                                                                    $_SESSION['fechaFinContrato']=$efechaFinContrato;
                                                                                                                                                                                    unset($_SESSION['usuarios']);
                                                                                                                                                                                    $_SESSION['tipo_alert']="success";
                                                                                                                                                                                    $_SESSION['mensaje']="Usuario editado correctamente";
                                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                }elseif($enDoc != $_SESSION['num_doc']){
                                                                                                                                                                                    unset($_SESSION['usuarios']);
                                                                                                                                                                                    $_SESSION['tipo_alert']="success";
                                                                                                                                                                                    $_SESSION['mensaje']="Usuario editado correctamente";
                                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                }else{
                                                                                                                                                                                    unset($_SESSION['usuarios']);
                                                                                                                                                                                    $_SESSION['tipo_alert']="danger";
                                                                                                                                                                                    $_SESSION['mensaje']="Error al editar el usuario, intente otra vez";
                                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                                }
                                                                                                                                                                            }else{
                                                                                                                                                                                unset($_SESSION['usuarios']);
                                                                                                                                                                                $_SESSION['tipo_alert']="danger";
                                                                                                                                                                                $_SESSION['mensaje']="Error al editar el usuario";
                                                                                                                                                                                echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                            }
                                                                                                                                                                            // fin
                                                                                                                                                                    }else{
                                                                                                                                                                        $_SESSION['tipo_alert_editar']="danger";
                                                                                                                                                                        $_SESSION['mensajeEditar']="Error, supervisor inexistente";
                                                                                                                                                                        echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                    }
                                                                                                                                                                }else{
                                                                                                                                                                    $_SESSION['tipo_alert_editar']="danger";
                                                                                                                                                                    $_SESSION['mensajeEditar']="Error, intente otra vez";
                                                                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                                }      
                                                                                                                                                            }else{
                                                                                                                                                                $_SESSION['tipo_alert_editar']="danger";
                                                                                                                                                                $_SESSION['mensajeEditar']="Error, intente otra vez";
                                                                                                                                                                echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                            }
                                                                                                                                                        }else{
                                                                                                                                                            $_SESSION['tipo_alert_editar']="danger";
                                                                                                                                                            $_SESSION['mensajeEditar']="Seleccione el supervisor de contrato si el rol es coordinador o instructor";
                                                                                                                                                            echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                        }
                                                                                                                                                            }
                                                                                                                                                            
                                                                                                                                                        }else{
                                                                                                                                                            $_SESSION['tipo_alert_editar']="danger";
                                                                                                                                                            $_SESSION['mensajeEditar']="La fecha de finalización de contrato debe ser mayor a la fecha actual";
                                                                                                                                                            echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                        }                
                                                                                                                                                    }else{
                                                                                                                                                        $_SESSION['tipo_alert_editar']="danger";
                                                                                                                                                        $_SESSION['mensajeEditar']="Seleccione una fecha de finalización de contrato";
                                                                                                                                                        echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                                    }
                                                                                                                                            }else{
                                                                                                                                                $_SESSION['tipo_alert_editar']="danger";
                                                                                                                                                $_SESSION['mensajeEditar']="Ingrese un género valido";
                                                                                                                                                echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                                            }
                                                                                                                                    }
                                                                                                                            }else{
                                                                                                                                $_SESSION['tipo_alert_editar']="danger";
                                                                                                                                $_SESSION['mensajeEditar']="Ingrese numero telefonico valido";
                                                                                                                                echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                            }
                                                                                                                    }else{
                                                                                                                        $_SESSION['tipo_alert_editar']="danger";
                                                                                                                        $_SESSION['mensajeEditar']="Error de numero de telefono";
                                                                                                                        echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                    }
                                                                                                                }else{
                                                                                                                    $_SESSION['tipo_alert_editar']="danger";
                                                                                                                    $_SESSION['mensajeEditar']="Ingrese numero telefonico";
                                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                                }
                                                                                                            }
                                                                                                        }
                                                                                                    }else{
                                                                                                        // else de correo vacio empty
                                                                                                        $_SESSION['tipo_alert_editar']="danger";
                                                                                                        $_SESSION['mensajeEditar']="Ingrese un correo electronico";
                                                                                                        echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                    }
    
                                                                                                }else{
                                                                                                    $_SESSION['tipo_alert_editar']="danger";
                                                                                                    $_SESSION['mensajeEditar']="Municipio/ciudad de residencia de residencia inexistente";
                                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                                }
                                                                                            }else{
                                                                                                $_SESSION['tipo_alert_editar']="danger";
                                                                                                $_SESSION['mensajeEditar']="Error en el municipio/ciudad de residencia";
                                                                                                echo "<script>location.href='../views/registrar.php'</script>";
                                                                                            }
                                                                                        }else{
                                                                                            $_SESSION['tipo_alert_editar']="danger";
                                                                                            $_SESSION['mensajeEditar']="Seleccione el municipio/ciudad de residencia";
                                                                                            echo "<script>location.href='../views/registrar.php'</script>";
                                                                                        }
                                                                                    }else{
                                                                                        $_SESSION['tipo_alert_editar']="danger";
                                                                                        $_SESSION['mensajeEditar']="Departamento de residencia inexistente";
                                                                                        echo "<script>location.href='../views/registrar.php'</script>";
                                                                                    }
                                                                                }else{
                                                                                    $_SESSION['tipo_alert_editar']="danger";
                                                                                    $_SESSION['mensajeEditar']="Error en el departamento de residencia";
                                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                                }
                                                                            }else{
                                                                                $_SESSION['tipo_alert_editar']="danger";
                                                                                $_SESSION['mensajeEditar']="Seleccione el departamento de residencia";
                                                                                echo "<script>location.href='../views/registrar.php'</script>";
                                                                            }
                                                                    }else{
                                                                        $_SESSION['tipo_alert_editar']="danger";
                                                                        $_SESSION['mensajeEditar']="La fecha de nacimiento debe ser menor a la fecha actual";
                                                                        echo "<script>location.href='../views/registrar.php'</script>";
                                                                    }    
                                                                }else{
                                                                    $_SESSION['tipo_alert_editar']="danger";
                                                                    $_SESSION['mensajeEditar']="Ingrese la fecha de nacimiento";
                                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                                }
                                                        }else{
                                                            $_SESSION['tipo_alert_editar']="danger";
                                                            $_SESSION['mensajeEditar']="Rol inexistente";
                                                            echo "<script>location.href='../views/registrar.php'</script>";
                                                        }
                                                }else{
                                                    $_SESSION['tipo_alert_editar']="danger";
                                                    $_SESSION['mensajeEditar']="Error de rol";
                                                    echo "<script>location.href='../views/registrar.php'</script>";
                                                }
                                            }else{
                                                $_SESSION['tipo_alert_editar']="danger";
                                                $_SESSION['mensajeEditar']="Seleccione un rol";
                                                echo "<script>location.href='../views/registrar.php'</script>";
                                            }
                                    }else{
                                        $_SESSION['tipo_alert_editar']="danger";
                                        $_SESSION['mensajeEditar']="Tipo de documento inexistente";
                                        echo "<script>location.href='../views/registrar.php'</script>";
                                    }
                            }else{
                                $_SESSION['tipo_alert_editar']="danger";
                                $_SESSION['mensajeEditar']="Error de tipo de documento";
                                echo "<script>location.href='../views/registrar.php'</script>";
                            }
                        }else{
                            $_SESSION['tipo_alert_editar']="danger";
                            $_SESSION['mensajeEditar']="Seleccione un tipo de documento";
                            echo "<script>location.href='../views/registrar.php'</script>";
                        }
                }else{
                    $_SESSION['tipo_alert_editar']="danger";
                    $_SESSION['mensajeEditar']="Ingrese los apellidos del usuario";
                    echo "<script>location.href='../views/registrar.php'</script>";
                }
        }else{
            $_SESSION['tipo_alert_editar']="danger";
            $_SESSION['mensajeEditar']="Ingrese los nombres del usuario";
            echo "<script>location.href='../views/registrar.php'</script>";
        }
        
    }else{

        $_SESSION['tipo_alert_editar']="danger";
        $_SESSION['mensajeEditar']="Ingrese el perfil academico del usuario";
        echo "<script>location.href='../views/registrar.php'</script>";

    }
    



    

}

// Fin de editar usuario


// Eliminar usuario
    if(isset($_GET['eliminar'])){ 
        if (session_status() !== PHP_SESSION_ACTIVE) {
            // Si no está iniciada, la iniciamos
            session_start();
        }
        $editor = $_SESSION['num_doc'];
        $id = $_GET['eliminar'];
        $consultarUsuario = $consulta->consultarUsuario($id);
        if($consultarUsuario){
            
            if($_SESSION['id'] == $id){
                $_SESSION['tipo_alert']="warning";
                $_SESSION['mensaje']="Usted mismo no puede borrar su usuario";
                echo "<script>location.href='../views/registrar.php'</script>";
            }elseif($_SESSION['rol'] == 2 && ($consultarUsuario[0]['rol'] == 1 OR $consultarUsuario[0]['rol'] == 4)){       
                $_SESSION['tipo_alert']="warning";
                $_SESSION['mensaje']="Usted mismo no puede borrar un usuario con un cargo mayor a el suyo";
                echo "<script>location.href='../views/registrar.php'</script>";
            }else{
                $eliminarUsuario = $consulta->eliminarUsuario($id,$editor);
                if($eliminarUsuario){
                    if (session_status() !== PHP_SESSION_ACTIVE) {
                        // Si no está iniciada, la iniciamos
                        session_start();
                    }
                   
                        $_SESSION['tipo_alert']="success";
                        $_SESSION['mensaje']="Usuario eliminado correctamente";
                        echo "<script>location.href='../views/registrar.php'</script>";
                   
                }else{
                    if (session_status() !== PHP_SESSION_ACTIVE) {
                        // Si no está iniciada, la iniciamos
                        session_start();
                    }
                    $_SESSION['tipo_alert']="danger";
                    $_SESSION['mensaje']="Error al eliminar, intente otra vez";
                    echo "<script>location.href='../views/registrar.php'</script>";
                }
            } 
        }else{
            if (session_status() !== PHP_SESSION_ACTIVE) {
                // Si no está iniciada, la iniciamos
                session_start();
            }
            $_SESSION['tipo_alert']="danger";
            $_SESSION['mensaje']="Usuario a eliminar no existe";
            echo "<script>location.href='../views/registrar.php'</script>";
        }
    }
// Fin de Eliminar usuario

// Eliminar comentario
if(isset($_GET['eliminarComentario'])){ 
    if (session_status() !== PHP_SESSION_ACTIVE) {
        // Si no está iniciada, la iniciamos
        session_start();
    }
    $id = $_GET['eliminarComentario'];
    $consultarComentario = $consulta->consultarComentario($id);
    if($consultarComentario){
        $eliminarComentario = $consulta->eliminarComentario($id);
        if($eliminarComentario){
            $_SESSION['tipo_alert_contacto']="success";
            $_SESSION['mensajeContacto']="Comentario eliminado correctamente";
            echo "<script>location.href='../views/contacto.php'</script>"; 
        }else{
            $_SESSION['tipo_alert_contacto']="danger";
            $_SESSION['mensajeContacto']="Error al eliminar el comentario, intente otra vez";
            echo "<script>location.href='../views/contacto.php'</script>";
        }     
    }else{
        $_SESSION['tipo_alert_contacto']="danger";
        $_SESSION['mensajeContacto']="Comentario a eliminar no existe";
        echo "<script>location.href='../views/contacto.php'</script>";
    }
}
// Fin de Eliminar comentario
?>