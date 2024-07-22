<?php

    if (session_status() !== PHP_SESSION_ACTIVE) {
        // Si no está iniciada, la iniciamos
        session_start();
    }

    include("../models/mconsultas.php");
    

    $consulta = new Consultas(); // Objecto
    //$recurso = $consulta->registrarcurso();

    $tDocs = $consulta->tDoc();
    $ndoc = $consulta->ndoc();
    $rol = $consulta->rol();
    //$muni = $consulta->mostrarmuni();
    $departamento = $consulta->mostrardepartamento();

    $nombres = $consulta->mostrarnombres();
    $nombresIns = $consulta->mostrarnombresIns();
    $nombresIns2 = $consulta->mostrarnombresIns2($_SESSION["num_doc"]);
    $nivel = $consulta->mostrarnivel() ;
    $rubro = $consulta->mostrarRubro();
    $jornada = $consulta->mostrarjornada();
    $titulacion = $consulta->mostrartitu();
    $region = $consulta->mostrarregion();
    $muni = $consulta->mostrarmuni();

    $municipios = $consulta->mostrarmunicipios();


    $competencia = $consulta->mostrarcompe();
    $tipocompetencia = $consulta->mostrartipocompetencia ();
    $ambiente = $consulta->mostrarambiente();
    $asignacion = $consulta->asignacion();

    $asignacion2 = $consulta->asignacion2($_SESSION["num_doc"]);


// Aisgnar programacion

    if (session_status() !== PHP_SESSION_ACTIVE) {
        // Si no está iniciada, la iniciamos
        session_start();
    }

    if(isset($_POST['nDoc'])){
        $nDoc= trim(isset($_POST['nDoc']) ? $_POST['nDoc']:NULL);
            if(!empty($nDoc)){
                if(is_numeric($nDoc)){
                    $consultarnDoc = $consulta->consultarnDoc($nDoc);
                    if($consultarnDoc){
                            $nivel= trim(isset($_POST['nivel']) ? $_POST['nivel']:NULL);
                            if(!empty($nivel)){
                                if(is_numeric($nivel)){
                                    $consultarNivel = $consulta->consultarNivel($nivel);
                                        if($consultarNivel){
                                            $rubro= trim(isset($_POST['rubro']) ? $_POST['rubro']:NULL);
                                                if (!empty($rubro)) {
                                                    if (is_numeric($rubro)) {
                                                        $consultarRubro = $consulta->consultarRubro($rubro);
                                                        if ($consultarRubro) {
                                                            $titulacion = trim(isset($_POST['mTitulacion']) ? $_POST['mTitulacion']:NULL);
                                                if(!empty($titulacion)){
                                                    if(is_numeric($titulacion)){
                                                        $consultarTitulacion = $consulta->consultarTitulacion($titulacion);
                                                            if($consultarTitulacion){
                                                                $tipocompetencia = trim(isset($_POST['tCompetencia']) ? $_POST['tCompetencia']:NULL);
                                                                    if(!empty($tipocompetencia)){
                                                                        if(is_numeric($tipocompetencia)){
                                                                            $consultartipocompetencia = $consulta->consultartipocompetencia($tipocompetencia);
                                                                                if($consultartipocompetencia){
                                                                                    $competencia = trim(isset($_POST['competencia']) ? $_POST['competencia']:NULL);
                                                                                        if(!empty($competencia)){
                                                                                            if(is_numeric($competencia)){
                                                                                                $consultarCompetencia = $consulta->consultarCompetencia($competencia);
                                                                                                // echo $consultarCompetencia[0]['tipoCompetencia'];
                                                                                                // die();
                                                                                                    if($consultarCompetencia){
                                                                                                        $fechaRealizar = (isset($_POST['fechainicio']) ? $_POST['fechainicio']:NULL);
                                                                                                        
                                                                                                            if(!empty($fechaRealizar)){
                                                                                                                $horaInicio = trim(isset($_POST['horaInicio']) ? $_POST['horaInicio']:NULL);
                                                                                                                    if(!empty($horaInicio)){
                                                                                                                        $horaFin = trim(isset($_POST['horaFin']) ? $_POST['horaFin']:NULL);
                                                                                                                            if(!empty($horaFin)){
                                                                                                                                    $ambiente= trim(isset($_POST['tAmbiente']) ? $_POST['tAmbiente']:NULL);
                                                                                                                                if(!empty($ambiente)){
                                                                                                                                $consultarCompetenciaAjax = $consulta->consultarCompetenciaAjax($consultarCompetencia[0]['tipoCompetencia']);
                                                                                                                                if(count($fechaRealizar) > count(array_unique($fechaRealizar))){
                                                                                                                                    unset($_SESSION['asignar']);
                                                                                                                                    $_SESSION['equivocado'] = true;
                                                                                                                                    $_SESSION['equivocadonDoc'] = $nDoc;
                                                                                                                                    $_SESSION['equivocadoNivel'] = $nivel;
                                                                                                                                    $_SESSION['eqivocadoRubro'] = $rubro;
                                                                                                                                    $_SESSION['equivocadoTitulacion']=$titulacion;
                                                                                                                                    $_SESSION['equivocadoTipoCompetencia']=$tipocompetencia;
                                                                                                                                    $_SESSION['equivocadoCompetencia']=$competencia;
                                                                                                                                    $_SESSION['equivocadoCompetenciaAjaxx']=$consultarCompetenciaAjax;
                                                                                                                                    // $_SESSION['equivocadoFechaRealizar']=$fechaRealizar;
                                                                                                                                    $_SESSION['equivocadoHoraInicio']=$horaInicio;
                                                                                                                                    $_SESSION['equivocadoHoraFin']=$horaFin;
                                                                                                                                    $_SESSION['tipo_alert_programacion']="danger";
                                                                                                                                    $_SESSION['mensajeProgramacion']="Asegurese que los dias de la programación no esten repetidos";
                                                                                                                                    echo "<script>location.href='../views/programacion.php'</script>";
                                                                                                                                }else{
                                                                                                                                
                                                                                                                                    
                                                                                                                                foreach($fechaRealizar AS $p){
                                                                                                                                $fecha_inicio      = date('Y-m-d H:i:s', strtotime($p. " " . $horaInicio)); 
                                                                                                                                $fecha_fin         = date('Y-m-d H:i:s', strtotime($p . ' ' . $horaFin)); 
                                                                                                                                $consultarOcupadoInstructor = $consulta->consultarOcupado($nDoc,$fecha_inicio,$fecha_fin);
                                                                                                                                
                                                                                                                                    if($consultarOcupadoInstructor){
                                                                                                                                        unset($_SESSION['asignar']);
                                                                                                                                        $_SESSION['equivocado'] = true;
                                                                                                                                        $_SESSION['equivocadonDoc'] = $nDoc;
                                                                                                                                        $_SESSION['equivocadoNivel'] = $nivel;
                                                                                                                                        $_SESSION['eqivocadoRubro'] = $rubro;
                                                                                                                                        $_SESSION['equivocadoTitulacion']=$titulacion;
                                                                                                                                        $_SESSION['equivocadoTipoCompetencia']=$tipocompetencia;

                                                                                                                                        $_SESSION['equivocadoCompetencia']=$competencia;
                                                                                                                                        $_SESSION['equivocadoCompetenciaAjaxx']=$consultarCompetenciaAjax;

                                                                                                                                        //$_SESSION['equivocadoFechaRealizar']=$fechaRealizar;
                                                                                                                                        $_SESSION['equivocadoHoraInicio']=$horaInicio;
                                                                                                                                        $_SESSION['equivocadoHoraFin']=$horaFin;
                                                                                                                                        $_SESSION['equivocadoambiente']=$ambiente;
                                                                                                                                        $_SESSION['tipo_alert_programacion']="danger";
                                                                                                                                        $_SESSION['mensajeProgramacion']="El instructor ya esta asigando en este horario";
                                                                                                                                      
                                                                                                                                        echo "<script>location.href='../views/programacion.php'</script>";
                                                                                                                                    }else{
                                                                                                                                        $consultarOcupadoCurso = $consulta->consultarOcupadoCurso($titulacion,$fecha_inicio,$fecha_fin);
                                                                                                                                            if($consultarOcupadoCurso){
                                                                                                                                                unset($_SESSION['asignar']);
                                                                                                                                                $_SESSION['equivocado'] = true;
                                                                                                                                                $_SESSION['equivocadonDoc'] = $nDoc;
                                                                                                                                                $_SESSION['equivocadoNivel'] = $nivel;
                                                                                                                                                $_SESSION['eqivocadoRubro'] = $rubro;
                                                                                                                                                $_SESSION['equivocadoTitulacion']=$titulacion;
                                                                                                                                                $_SESSION['equivocadoTipoCompetencia']=$tipocompetencia;
                                                                                                                                                $_SESSION['equivocadoCompetencia']=$competencia;
                                                                                                                                                $_SESSION['equivocadoCompetenciaAjaxx']=$consultarCompetenciaAjax;
                                                                                                                                                //$_SESSION['equivocadoFechaRealizar']=$fechaRealizar;
                                                                                                                                                $_SESSION['equivocadoHoraInicio']=$horaInicio;
                                                                                                                                                $_SESSION['equivocadoHoraFin']=$horaFin;
                                                                                                                                                $_SESSION['equivocadoambiente']=$ambiente;
                                                                                                                                                $_SESSION['tipo_alert_programacion']="danger";
                                                                                                                                                $_SESSION['mensajeProgramacion']="El instructor ya esta asigando en este horario";
                                                                                                                                                echo "<script>location.href='../views/programacion.php'</script>";
                                                                                                                                            }else{
                                                                                                                                                if($p > $consultarnDoc[0]['fechaFinContrato']){
                                                                                                                                                    unset($_SESSION['asignar']);
                                                                                                                                                    $_SESSION['equivocado'] = true;
                                                                                                                                                    $_SESSION['equivocadonDoc'] = $nDoc;
                                                                                                                                                    $_SESSION['equivocadoNivel'] = $nivel;
                                                                                                                                                    $_SESSION['eqivocadoRubro'] = $rubro;
                                                                                                                                                    $_SESSION['equivocadoTitulacion']=$titulacion;
                                                                                                                                                    $_SESSION['equivocadoTipoCompetencia']=$tipocompetencia;
                                                                                                                                                    $_SESSION['equivocadoCompetencia']=$competencia;
                                                                                                                                                    $_SESSION['equivocadoCompetenciaAjaxx']=$consultarCompetenciaAjax;
                                                                                                                                                    //$_SESSION['equivocadoFechaRealizar']=$fechaRealizar;
                                                                                                                                                    $_SESSION['equivocadoHoraInicio']=$horaInicio;
                                                                                                                                                    $_SESSION['equivocadoHoraFin']=$horaFin;
                                                                                                                                                    $_SESSION['equivocadoambiente']=$ambiente;
                                                                                                                                                    $_SESSION['tipo_alert_programacion']="danger";
                                                                                                                                                    $_SESSION['mensajeProgramacion']="El instructor " . $consultarnDoc[0]['nombres'] . " " . $consultarnDoc[0]['apellidos'] . " se le vence el contrato el ".$consultarnDoc[0]['fechaFinContrato'] . " por lo tanto no se puede realizar la programación";
                                                                                                                                                    echo "<script>location.href='../views/programacion.php'</script>";
                                                                                                                                                }else{

                                                                                                                                                    if($horaFin <= $horaInicio){
                                                                                                                                                        unset($_SESSION['asignar']);
                                                                                                                                                        $_SESSION['equivocado'] = true;
                                                                                                                                                        $_SESSION['equivocadonDoc'] = $nDoc;
                                                                                                                                                        $_SESSION['equivocadoNivel'] = $nivel;
                                                                                                                                                        $_SESSION['eqivocadoRubro'] = $rubro;
                                                                                                                                                        $_SESSION['equivocadoTitulacion']=$titulacion;
                                                                                                                                                        $_SESSION['equivocadoTipoCompetencia']=$tipocompetencia;
                                                                                                                                                        $_SESSION['equivocadoCompetencia']=$competencia;
                                                                                                                                                        $_SESSION['equivocadoCompetenciaAjaxx']=$consultarCompetenciaAjax;
                                                                                                                                                        //$_SESSION['equivocadoFechaRealizar']=$fechaRealizar;
                                                                                                                                                        $_SESSION['equivocadoHoraInicio']=$horaInicio;
                                                                                                                                                        $_SESSION['equivocadoHoraFin']=$horaFin;
                                                                                                                                                        $_SESSION['equivocadoambiente']=$ambiente;
                                                                                                                                                        $_SESSION['tipo_alert_programacion']="danger";
                                                                                                                                                        $_SESSION['mensajeProgramacion']="Asegurese que la hora de inicio sea mayor a la hora de fin";
                                                                                                                                                        echo "<script>location.href='../views/programacion.php'</script>";
                                                                                                                                                    }else{
                                                                                                                                                        $consultarnDoc = $consulta->consultarnDoc($nDoc);  
                                                                                                                                                        date_default_timezone_set("America/Bogota");
                                                                                                                                                        $fechaProgramacion = date("Y-m-d h:i:s");
                                                                                                                                                        $asignada = $_SESSION['num_doc'];   
                                                                                                                                                        
                                                                                                                                                        // $tipocompetencia
                                                                                                                                                        switch ($tipocompetencia) {
                                                                                                                                                            case 1:
                                                                                                                                                                $color_evento = '#8BC34A';
                                                                                                                                                                break;
                                                                                                                                                            case 2:
                                                                                                                                                                $color_evento = '#2196F3';
                                                                                                                                                                break;
                                                                                                                                                            case 3:
                                                                                                                                                                $color_evento = '#FF5722';
                                                                                                                                                                break;
                                                                                                                                                          }
                                                                                                                                                        $guardarProgramacion = $consulta->guardarProgramacion($nDoc,$nivel,$titulacion,$tipocompetencia,$competencia,$ambiente,$color_evento,$fecha_inicio,$fecha_fin,$fechaProgramacion,$asignada,$rubro);
                                                                                                                                                            if($guardarProgramacion){
                                                                                                                                                                unset($_SESSION['asignar']);
                                                                                                                                                                unset($_SESSION['equivocado']);
                                                                                                                                                                $_SESSION['tipo_alert_programacion']="success";
                                                                                                                                                                $_SESSION['mensajeProgramacion']="Programación asignada correctamente";
                                                                                                                                                                echo "<script>location.href='../views/programacion.php'</script>";
                                                                                                                                                            }else{
                                                                                                                                                                unset($_SESSION['equivocado']);
                                                                                                                                                                unset($_SESSION['asignar']);
                                                                                                                                                                $_SESSION['tipo_alert_programacion']="danger";
                                                                                                                                                                $_SESSION['mensajeProgramacion']="Error en la programacón al instructor, intente otra vez";
                                                                                                                                                                echo "<script>location.href='../views/programacion.php'</script>";
                                                                                                                                                            }
                                                                                                                                                        
                                                                                                                                                    }
                                                                                                                                                }
                                                                                                                                            }
                                                                                                                                    } 

                                                                                                                                }
                                                                                                                            }
                                                                                                                            
                                                                                                                            }else{
                                                                                                                                        $_SESSION['tipo_alert_programacion']="danger";
                                                                                                                                        $_SESSION['mensajeProgramacion']="Error de ambiente";
                                                                                                                                        echo "<script>location.href='../views/programacion.php'</script>";
                                                                                                                                    }
                                                                                                                            }else{
                                                                                                                                $_SESSION['tipo_alert_programacion']="danger";
                                                                                                                                $_SESSION['mensajeProgramacion']="Error de hora de fin";
                                                                                                                                echo "<script>location.href='../views/programacion.php'</script>";
                                                                                                                            }
                                                                                                                    }else{
                                                                                                                        $_SESSION['tipo_alert_programacion']="danger";
                                                                                                                        $_SESSION['mensajeProgramacion']="Error de hora de inicio";
                                                                                                                        echo "<script>location.href='../views/programacion.php'</script>";
                                                                                                                    }
                                                                                                            }else{
                                                                                                                $_SESSION['tipo_alert_programacion']="danger";
                                                                                                                $_SESSION['mensajeProgramacion']="Error de fecha a realizar";
                                                                                                                echo "<script>location.href='../views/programacion.php'</script>";
                                                                                                            }                   
                                                                                    
                                                                                                    }else{
                                                                                                        $_SESSION['tipo_alert_programacion']="danger";
                                                                                                        $_SESSION['mensajeProgramacion']="Error de competencia no existe";
                                                                                                        echo "<script>location.href='../views/programacion.php'</script>";
                                                                                                    }
                                                                                            }else{
                                                                                                $_SESSION['tipo_alert_programacion']="danger";
                                                                                                $_SESSION['mensajeProgramacion']="Error";
                                                                                                echo "<script>location.href='../views/programacion.php'</script>";
                                                                                            }
                                                                                        }else{
                                                                                            $_SESSION['tipo_alert_programacion']="danger";
                                                                                            $_SESSION['mensajeProgramacion']="Error de competencia";
                                                                                            echo "<script>location.href='../views/programacion.php'</script>";
                                                                                        }
                                                                                }else{
                                                                                    $_SESSION['tipo_alert_programacion']="danger";
                                                                                    $_SESSION['mensajeProgramacion']="Error tipo de competencia no existe";
                                                                                    echo "<script>location.href='../views/programacion.php'</script>";
                                                                                }
                                                                        }else{
                                                                            $_SESSION['tipo_alert_programacion']="danger";
                                                                            $_SESSION['mensajeProgramacion']="Error";
                                                                            echo "<script>location.href='../views/programacion.php'</script>";
                                                                        }
                                                                    }else{
                                                                        $_SESSION['tipo_alert_programacion']="danger";
                                                                        $_SESSION['mensajeProgramacion']="Error en tipo de competencia";
                                                                        echo "<script>location.href='../views/programacion.php'</script>";
                                                                    }
                                                            }else{
                                                                $_SESSION['tipo_alert_programacion']="danger";
                                                                $_SESSION['mensajeProgramacion']="Error titulacion no existe";
                                                                echo "<script>location.href='../views/programacion.php'</script>";
                                                            }
                                                    }else{
                                                        $_SESSION['tipo_alert_programacion']="danger";
                                                        $_SESSION['mensajeProgramacion']="Error";
                                                        echo "<script>location.href='../views/programacion.php'</script>"; 
                                                    }
                                                }else{
                                                    $_SESSION['tipo_alert_programacion']="danger";
                                                    $_SESSION['mensajeProgramacion']="Error en titulacion";
                                                    echo "<script>location.href='../views/programacion.php'</script>";
                                                }
                                                        }else{
                                                            $_SESSION['tipo_alert_programacion']="danger";
                                                            $_SESSION['mensajeProgramacion']="Error rubro";
                                                            echo "<script>location.href='../views/programacion.php'</script>"; 
                                                        }
                                                    }else{
                                                        $_SESSION['tipo_alert_programacion']="danger";
                                                        $_SESSION['mensajeProgramacion']="Error ya colocado";
                                                        echo "<script>location.href='../views/programacion.php'</script>"; 
                                                    }
                                                }else{
                                                    $_SESSION['tipo_alert_programacion']="danger";
                                                    $_SESSION['mensajeProgramacion']="Error rubro";
                                                    echo "<script>location.href='../views/programacion.php'</script>"; 
                                                }
                                        }else{
                                            $_SESSION['tipo_alert_programacion']="danger";
                                            $_SESSION['mensajeProgramacion']="Error nivel no existe";
                                            echo "<script>location.href='../views/programacion.php'</script>";
                                        }
                                }else{
                                    $_SESSION['tipo_alert_programacion']="danger";
                                    $_SESSION['mensajeProgramacion']="Error";
                                    echo "<script>location.href='../views/programacion.php'</script>"; 
                                }
                            }else{
                                $_SESSION['tipo_alert_programacion']="danger";
                                $_SESSION['mensajeProgramacion']="Error en nivel";
                                echo "<script>location.href='../views/programacion.php'</script>"; 
                            }
                    }else{
                        $_SESSION['tipo_alert_programacion']="danger";
                        $_SESSION['mensajeProgramacion']="Error usuario no existe";
                        echo "<script>location.href='../views/programacion.php'</script>";
                    }
                }else{
                    $_SESSION['tipo_alert_programacion']="danger";
                    $_SESSION['mensajeProgramacion']="Error";
                    echo "<script>location.href='../views/programacion.php'</script>"; 
                }
            }else{
                $_SESSION['tipo_alert_programacion']="danger";
                $_SESSION['mensajeProgramacion']="Error en numero de documento";
                echo "<script>location.href='../views/programacion.php'</script>"; 
            }
    }

// Fin de Aisgnar programacion

    if(isset($_GET['asig'])){
         
        $id = $_GET['asig'];
        
        $consultarnDoc = $consulta->consultarnDoc($id);
        if($consultarnDoc){
            if (session_status() !== PHP_SESSION_ACTIVE) {
                // Si no está iniciada, la iniciamos
                session_start();
            }
            $_SESSION['asignar'] =$id;
            echo "<script>location.href='../views/programacion.php'</script>";
        }else{
            echo "<script>location.href='../views/instructores.php'</script>";
        }



    }

    if(isset($_GET['cancelEdit'])){
        if (session_status() !== PHP_SESSION_ACTIVE) {
            // Si no está iniciada, la iniciamos
            session_start();
        }
        unset($_SESSION['asignar']);
        echo "<script>location.href='../views/instructores.php'</script>";
    }

    if(isset($_GET['ediprog'])){
         
        $nDoc = $_GET['ediprogramacion'];
        $ediprog = $consulta->editarasig($nDoc);
        // var_dump($pro);
        // die();
        if (session_status() !== PHP_SESSION_ACTIVE) {
            // Si no está iniciada, la iniciamos
            session_start();
        }
        $_SESSION['ediprogramacion'] =$ediprog;
        echo "<script>location.href='../views/programacion.php'</script>";

    }

    // editar programacion

    if(isset($_POST['eNdoc'])){
        if (session_status() !== PHP_SESSION_ACTIVE) {
            // Si no está iniciada, la iniciamos
            session_start();
        }
        $eNdoc= trim(isset($_POST['eNdoc']) ? $_POST['eNdoc']:NULL);
            if(!empty($eNdoc)){
                if(is_numeric($eNdoc)){
                    $x = $_SESSION['editarprogramacion'];
                    $y = $x[0]['nDocInstructor'];
                    $z = $x[0]['id'];
                        if($y == $eNdoc){
                            $nivel= trim(isset($_POST['eNivel']) ? $_POST['eNivel']:NULL);
                                if(!empty($nivel)){
                                    if(is_numeric($nivel)){
                                        $consultarNivel = $consulta->consultarNivel($nivel);
                                            if($consultarNivel){
                                                $rubro= trim(isset($_POST['rubro']) ? $_POST['rubro']:NULL);
                                                if (!empty($rubro)) {
                                                    if (is_numeric($rubro)) {
                                                        $consultarRubro = $consulta->consultarRubro($rubro);
                                                        if ($consultarRubro) {
                                                $titulacion = trim(isset($_POST['eNomtitulacion']) ? $_POST['eNomtitulacion']:NULL);
                                                    if(!empty($titulacion)){
                                                        if(is_numeric($titulacion)){
                                                            $consultarTitulacion = $consulta->consultarTitulacion($titulacion);
                                                                if($consultarTitulacion){
                                                                    $tipocompetencia = trim(isset($_POST['etcompetencia']) ? $_POST['etcompetencia']:NULL);
                                                                        if(!empty($tipocompetencia)){
                                                                            if(is_numeric($tipocompetencia)){
                                                                                $consultartipocompetencia = $consulta->consultartipocompetencia($tipocompetencia);
                                                                                    if($consultartipocompetencia){
                                                                                        $competencia = trim(isset($_POST['ecompetencia']) ? $_POST['ecompetencia']:NULL);
                                                                                            if(!empty($competencia)){
                                                                                                if(is_numeric($competencia)){
                                                                                                    $consultarCompetencia = $consulta->consultarCompetencia($competencia);
                                                                                                        if($consultarCompetencia){                      
                                                                                                                $efechaRealizar = trim(isset($_POST['efechaRealizar']) ? $_POST['efechaRealizar']:NULL);
                                                                                                                    if(!empty($efechaRealizar)){
                                                                                                                        $eHoraInicio = trim(isset($_POST['eHoraInicio']) ? $_POST['eHoraInicio']:NULL);
                                                                                                                            if(!empty($eHoraInicio)){
                                                                                                                                $eHoraFin = trim(isset($_POST['eHoraFin']) ? $_POST['eHoraFin']:NULL);
                                                                                                                                    if(!empty($eHoraFin)){
                                                                                                                                        $eambiente = trim(isset($_POST['eambiente']) ? $_POST['eambiente']:NULL);
                                                                                                                                        if(!empty($eambiente)){
                                                                                                                                        switch ($tipocompetencia) {
                                                                                                                                            case 1:
                                                                                                                                                $color_evento = '#8BC34A';
                                                                                                                                                break;
                                                                                                                                            case 2:
                                                                                                                                                $color_evento = '#2196F3';
                                                                                                                                                break;
                                                                                                                                            case 3:
                                                                                                                                                $color_evento = '#FF5722';
                                                                                                                                                break;
                                                                                                                                            }
                                                                                                                                        if($eHoraFin > $eHoraInicio){
                                                                                                                                            $fecha_inicio         = date('Y-m-d H:i:s', strtotime($efechaRealizar . ' ' . $eHoraInicio));
                                                                                                                                            $fecha_fin         = date('Y-m-d H:i:s', strtotime($efechaRealizar . ' ' . $eHoraFin));  
                                                                                                                                            $id =  $x[0]['id'];
                                                                                                                                        
                                                                                                                                            $consultarOcupadoInstructor = $consulta->consultarOcupado2($eNdoc,$id,$fecha_inicio,$fecha_fin);
                                                                                                                                            if(!$consultarOcupadoInstructor){
                                                                                                                                                $consultarOcupadoCurso = $consulta->consultarOcupadoCurso2($titulacion,$id,$fecha_inicio,$fecha_fin);
                                                                                                                                                    if(!$consultarOcupadoCurso){
                                                                                                                                                        $editarProgramacion = $consulta->editarprog($eNdoc,$nivel,$titulacion,$tipocompetencia,$competencia,$color_evento,$fecha_inicio,$fecha_fin,$z,$rubro,$eambiente);
                                                                                                                                                        if($editarProgramacion){
                                                                                                                                                            if (session_status() !== PHP_SESSION_ACTIVE) {
                                                                                                                                                            // Si no está iniciada, la iniciamos
                                                                                                                                                                session_start();
                                                                                                                                                            }
                                                                                                                                                            unset($_SESSION['editarprogramacion']);
                                                                                                                                                            $_SESSION['tipo_alert_programacion']="success";
                                                                                                                                                            $_SESSION['mensajeProgramacion']="Programacion editada correctamente";
                                                                                                                                                            echo "<script>location.href='../views/programacion.php'</script>";
                                                                                                                                                        }else{
                                                                                                                                                            unset($_SESSION['editarprogramacion']);
                                                                                                                                                            $_SESSION['tipo_alert_programacion']="danger";
                                                                                                                                                            $_SESSION['mensajeProgramacion']="Error al editar";
                                                                                                                                                            echo "<script>location.href='../views/programacion.php'</script>";
                                                                                                                                                        }
                                                                                                                                                    }else{
                                                                                                                                                        $_SESSION['tipo_alert_programacion']="danger";
                                                                                                                                                        $_SESSION['mensajeProgramacion']="Esta titulación ya esta asiganda en este horario";
                                                                                                                                                        echo "<script>location.href='../views/programacion.php'</script>";
                                                                                                                                                    }
                                                                                                                                            }else{
                                                                                                                                                $_SESSION['tipo_alert_programacion']="danger";
                                                                                                                                                $_SESSION['mensajeProgramacion']="Este instructor ya esta asigando en este horario";
                                                                                                                                                echo "<script>location.href='../views/programacion.php'</script>";
                                                                                                                                            }
                                                                                                                                        }else{
                                                                                                                                            $_SESSION['tipo_alert_programacion']="danger";
                                                                                                                                            $_SESSION['mensajeProgramacion']="Asegurese que la hora de inicio sea mayor a la hora de fin";
                                                                                                                                            echo "<script>location.href='../views/programacion.php'</script>";
                                                                                                                                        }
                                                                                                                                        }else{
                                                                                                                                        $_SESSION['tipo_alert_programacion']="danger";
                                                                                                                                        $_SESSION['mensajeProgramacion']="Seleccione un ambiente";
                                                                                                                                        echo "<script>location.href='../views/programacion.php'</script>";
                                                                                                                                    }      
                                                                                                                                    }else{
                                                                                                                                        $_SESSION['tipo_alert_programacion']="danger";
                                                                                                                                        $_SESSION['mensajeProgramacion']="Seleccione una hora de fin";
                                                                                                                                        echo "<script>location.href='../views/programacion.php'</script>";
                                                                                                                                    }     
                                                                                                                            }else{
                                                                                                                                $_SESSION['tipo_alert_programacion']="danger";
                                                                                                                                $_SESSION['mensajeProgramacion']="Seleccione una hora de inicio";
                                                                                                                                echo "<script>location.href='../views/programacion.php'</script>";
                                                                                                                            }
                                                                                                                    }else{
                                                                                                                        $_SESSION['tipo_alert_programacion']="danger";
                                                                                                                        $_SESSION['mensajeProgramacion']="Seleccione una fecha a asignar";
                                                                                                                        echo "<script>location.href='../views/programacion.php'</script>";
                                                                                                                    }     
                                                                                                                
                                                                                                        }else{
                                                                                                            $_SESSION['tipo_alert_programacion']="danger";
                                                                                                            $_SESSION['mensajeProgramacion']="Competencia inexistente";
                                                                                                            echo "<script>location.href='../views/programacion.php'</script>";
                                                                                                        }
                                                                                                }else{
                                                                                                    $_SESSION['tipo_alert_programacion']="danger";
                                                                                                    $_SESSION['mensajeProgramacion']="Error de competencia";
                                                                                                    echo "<script>location.href='../views/programacion.php'</script>";
                                                                                                }
                                                                                            }else{
                                                                                                $_SESSION['tipo_alert_programacion']="danger";
                                                                                                $_SESSION['mensajeProgramacion']="Seleccione una competencia";
                                                                                                echo "<script>location.href='../views/programacion.php'</script>";
                                                                                            }
                                                                                    }else{
                                                                                        $_SESSION['tipo_alert_programacion']="danger";
                                                                                        $_SESSION['mensajeProgramacion']="Tipo de competencia inexistente";
                                                                                        echo "<script>location.href='../views/programacion.php'</script>";
                                                                                    }
                                                                            }else{
                                                                                $_SESSION['tipo_alert_programacion']="danger";
                                                                                $_SESSION['mensajeProgramacion']="Error de tipo de competencia";
                                                                                echo "<script>location.href='../views/programacion.php'</script>";
                                                                            }
                                                                        }else{
                                                                            $_SESSION['tipo_alert_programacion']="danger";
                                                                            $_SESSION['mensajeProgramacion']="Seleccione un tipo de competencia";
                                                                            echo "<script>location.href='../views/programacion.php'</script>";
                                                                        }
                                                                }else{
                                                                    $_SESSION['tipo_alert_programacion']="danger";
                                                                    $_SESSION['mensajeProgramacion']="Titulacion inexistente";
                                                                    echo "<script>location.href='../views/programacion.php'</script>";
                                                                }
                                                        }else{
                                                            $_SESSION['tipo_alert_programacion']="danger";
                                                            $_SESSION['mensajeProgramacion']="Error de titulacion";
                                                            echo "<script>location.href='../views/programacion.php'</script>";
                                                        }
                                                    }else{
                                                        $_SESSION['tipo_alert_programacion']="danger";
                                                        $_SESSION['mensajeProgramacion']="Seleccione una titulacion";
                                                        echo "<script>location.href='../views/programacion.php'</script>";
                                                    }}else{
                                                            $_SESSION['tipo_alert_programacion']="danger";
                                                            $_SESSION['mensajeProgramacion']="Error rubro";
                                                            echo "<script>location.href='../views/programacion.php'</script>"; 
                                                        }
                                                    }else{
                                                        $_SESSION['tipo_alert_programacion']="danger";
                                                        $_SESSION['mensajeProgramacion']="Error rubro";
                                                        echo "<script>location.href='../views/programacion.php'</script>"; 
                                                    }
                                                }else{
                                                    $_SESSION['tipo_alert_programacion']="danger";
                                                    $_SESSION['mensajeProgramacion']="Error rubro";
                                                    echo "<script>location.href='../views/programacion.php'</script>"; 
                                                }
                                            }else{
                                                $_SESSION['tipo_alert_programacion']="danger";
                                                $_SESSION['mensajeProgramacion']="Nivel inexistente";
                                                echo "<script>location.href='../views/programacion.php'</script>";
                                            }
                                    }else{
                                        $_SESSION['tipo_alert_programacion']="danger";
                                        $_SESSION['mensajeProgramacion']="Error en nivel";
                                        echo "<script>location.href='../views/programacion.php'</script>";
                                    }
                                }else{
                                    $_SESSION['tipo_alert_programacion']="danger";
                                    $_SESSION['mensajeProgramacion']="Seleccione un nivel";
                                    echo "<script>location.href='../views/programacion.php'</script>";
                                }
                        }else{
                            $consultarnDoc = $consulta->consultarnDoc($eNdoc);
                            if($consultarnDoc){
                                $nivel= trim(isset($_POST['eNivel']) ? $_POST['eNivel']:NULL);
                                if(!empty($nivel)){
                                    if(is_numeric($nivel)){
                                        $consultarNivel = $consulta->consultarNivel($nivel);
                                            if($consultarNivel){
                                                $titulacion = trim(isset($_POST['eNomtitulacion']) ? $_POST['eNomtitulacion']:NULL);
                                                    if(!empty($titulacion)){
                                                        if(is_numeric($titulacion)){
                                                            $consultarTitulacion = $consulta->consultarTitulacion($titulacion);
                                                                if($consultarTitulacion){
                                                                    $tipocompetencia = trim(isset($_POST['etcompetencia']) ? $_POST['etcompetencia']:NULL);
                                                                        if(!empty($tipocompetencia)){
                                                                            if(is_numeric($tipocompetencia)){
                                                                                $consultartipocompetencia = $consulta->consultartipocompetencia($tipocompetencia);
                                                                                    if($consultartipocompetencia){
                                                                                        $competencia = trim(isset($_POST['ecompetencia']) ? $_POST['ecompetencia']:NULL);
                                                                                            if(!empty($competencia)){
                                                                                                if(is_numeric($competencia)){
                                                                                                    $consultarCompetencia = $consulta->consultarCompetencia($competencia);
                                                                                                        if($consultarCompetencia){        
                                                                                                        $efechaRealizar = trim(isset($_POST['efechaRealizar']) ? $_POST['efechaRealizar']:NULL);
                                                                                                            if(!empty($efechaRealizar)){
                                                                                                                $eHoraInicio = trim(isset($_POST['eHoraInicio']) ? $_POST['eHoraInicio']:NULL);
                                                                                                                    if(!empty($eHoraInicio)){
                                                                                                                        $eHoraFin = trim(isset($_POST['eHoraFin']) ? $_POST['eHoraFin']:NULL);
                                                                                                                            if(!empty($eHoraFin)){
                                                                                                                                switch ($tipocompetencia) {
                                                                                                                                    case 1:
                                                                                                                                        $color_evento = '#8BC34A';
                                                                                                                                        break;
                                                                                                                                    case 2:
                                                                                                                                        $color_evento = '#2196F3';
                                                                                                                                        break;
                                                                                                                                    case 3:
                                                                                                                                        $color_evento = '#FF5722';
                                                                                                                                        break;
                                                                                                                                  }
                                                                                                                                  if($eHoraFin > $eHoraInicio){

                                                                        
                                                                                                                                    $fecha_inicio         = date('Y-m-d H:i:s', strtotime($efechaRealizar . ' ' . $eHoraInicio));
                                                                                                                                    $fecha_fin         = date('Y-m-d H:i:s', strtotime($efechaRealizar . ' ' . $eHoraFin)); 
                                                                                                                                    $id =  $x[0]['id'];
                                                                                                                                    if(!$consultarOcupadoInstructor){
                                                                                                                                        $consultarOcupadoCurso = $consulta->consultarOcupadoCurso2($titulacion,$id,$fecha_inicio,$fecha_fin);
                                                                                                                                            if(!$consultarOcupadoCurso){
                                                                                                                                                $editarProgramacion = $consulta->editarprog($eNdoc,$nivel,$titulacion,$tipocompetencia,$competencia,$color_evento,$fecha_inicio,$fecha_fin,$z,$rubro,$eambiente);
                                                                                                                                                    if($editarProgramacion){
                                                                                                                                                        if (session_status() !== PHP_SESSION_ACTIVE) {
                                                                                                                                                            // Si no está iniciada, la iniciamos
                                                                                                                                                            session_start();
                                                                                                                                                        }
                                                                                                                                                        unset($_SESSION['editarprogramacion']);
                                                                                                                                                        $_SESSION['tipo_alert_programacion']="success";
                                                                                                                                                        $_SESSION['mensajeProgramacion']="Programación editada correctamente";
                                                                                                                                                        echo "<script>location.href='../views/programacion.php'</script>";
                                                                                                                                                    }else{
                                                                                                                                                        unset($_SESSION['editarprogramacion']);
                                                                                                                                                        $_SESSION['tipo_alert_programacion']="danger";
                                                                                                                                                        $_SESSION['mensajeProgramacion']="Error al editar la programación, intente otra vez";
                                                                                                                                                        echo "<script>location.href='../views/programacion.php'</script>";
                                                                                                                                                    }
                                                                                                                                            }else{
                                                                                                                                                $_SESSION['tipo_alert_programacion']="danger";
                                                                                                                                                $_SESSION['mensajeProgramacion']="Esta titulación ya esta asiganda en este horario";
                                                                                                                                                echo "<script>location.href='../views/programacion.php'</script>";
                                                                                                                                            }
                                                                                                                                    }else{
                                                                                                                                        $_SESSION['tipo_alert_programacion']="danger";
                                                                                                                                        $_SESSION['mensajeProgramacion']="Este instructor ya esta asigando en este horario";
                                                                                                                                        echo "<script>location.href='../views/programacion.php'</script>";
                                                                                                                                    }
                                                                                                                                  }else{
                                                                                                                                    $_SESSION['tipo_alert_programacion']="danger";
                                                                                                                                    $_SESSION['mensajeProgramacion']="Asegurese que la hora de inicio sea mayor a la hora de fin";
                                                                                                                                    echo "<script>location.href='../views/programacion.php'</script>";
                                                                                                                                  }                                                                                                               
                                                                                                                            }else{
                                                                                                                                $_SESSION['tipo_alert_programacion']="danger";
                                                                                                                                $_SESSION['mensajeProgramacion']="Seleccione una hora de fin";
                                                                                                                                echo "<script>location.href='../views/programacion.php'</script>";
                                                                                                                            } 
                                                                                                                    }else{
                                                                                                                        $_SESSION['tipo_alert_programacion']="danger";
                                                                                                                        $_SESSION['mensajeProgramacion']="Seleccione una hora de inicio";
                                                                                                                        echo "<script>location.href='../views/programacion.php'</script>";
                                                                                                                    }
                                                                                                            }else{
                                                                                                                $_SESSION['tipo_alert_programacion']="danger";
                                                                                                                $_SESSION['mensajeProgramacion']="Seleccione una fecha de asignación";
                                                                                                                echo "<script>location.href='../views/programacion.php'</script>";
                                                                                                            }
                                                                                                        }else{
                                                                                                            $_SESSION['tipo_alert_programacion']="danger";
                                                                                                            $_SESSION['mensajeProgramacion']="Competencia inexistente";
                                                                                                            echo "<script>location.href='../views/programacion.php'</script>";
                                                                                                        }
                                                                                                }else{
                                                                                                    $_SESSION['tipo_alert_programacion']="danger";
                                                                                                    $_SESSION['mensajeProgramacion']="Error de competencia";
                                                                                                    echo "<script>location.href='../views/programacion.php'</script>";
                                                                                                }
                                                                                            }else{
                                                                                                $_SESSION['tipo_alert_programacion']="danger";
                                                                                                $_SESSION['mensajeProgramacion']="Seleccione una competencia";
                                                                                                echo "<script>location.href='../views/programacion.php'</script>";
                                                                                            }
                                                                                    }else{
                                                                                        $_SESSION['tipo_alert_programacion']="danger";
                                                                                        $_SESSION['mensajeProgramacion']="Tipo de competencia inexistente";
                                                                                        echo "<script>location.href='../views/programacion.php'</script>";
                                                                                    }
                                                                            }else{
                                                                                $_SESSION['tipo_alert_programacion']="danger";
                                                                                $_SESSION['mensajeProgramacion']="Error de tipo de competencia";
                                                                                echo "<script>location.href='../views/programacion.php'</script>";
                                                                            }
                                                                        }else{
                                                                            $_SESSION['tipo_alert_programacion']="danger";
                                                                            $_SESSION['mensajeProgramacion']="Seleccione un tipo de competencia";
                                                                            echo "<script>location.href='../views/programacion.php'</script>";
                                                                        }
                                                                }else{
                                                                    $_SESSION['tipo_alert_programacion']="danger";
                                                                    $_SESSION['mensajeProgramacion']="Titulacion inexistente";
                                                                    echo "<script>location.href='../views/programacion.php'</script>";
                                                                }
                                                        }else{
                                                            $_SESSION['tipo_alert_programacion']="danger";
                                                            $_SESSION['mensajeProgramacion']="Error de titulacion";
                                                            echo "<script>location.href='../views/programacion.php'</script>";
                                                        }
                                                    }else{
                                                        $_SESSION['tipo_alert_programacion']="danger";
                                                        $_SESSION['mensajeProgramacion']="Seleccione una titulacion";
                                                        echo "<script>location.href='../views/programacion.php'</script>";
                                                    }
                                            }else{
                                                $_SESSION['tipo_alert_programacion']="danger";
                                                $_SESSION['mensajeProgramacion']="Nivel inexistente";
                                                echo "<script>location.href='../views/programacion.php'</script>";
                                            }
                                    }else{
                                        $_SESSION['tipo_alert_programacion']="danger";
                                        $_SESSION['mensajeProgramacion']="Error en nivel";
                                        echo "<script>location.href='../views/programacion.php'</script>";
                                    }
                                }else{
                                    $_SESSION['tipo_alert_programacion']="danger";
                                    $_SESSION['mensajeProgramacion']="Seleccione un nivel";
                                    echo "<script>location.href='../views/programacion.php'</script>";
                                }
                            }else{
                                $_SESSION['tipo_alert_programacion']="danger";
                                $_SESSION['mensajeProgramacion']="Seleccione un instructor existente";
                                echo "<script>location.href='../views/programacion.php'</script>"; 
                            }
                        }
                }else{
                    $_SESSION['tipo_alert_programacion']="danger";
                    $_SESSION['mensajeProgramacion']="Error en el instructor";
                    echo "<script>location.href='../views/programacion.php'</script>"; 
                }
            }else{
                $_SESSION['tipo_alert_programacion']="danger";
                $_SESSION['mensajeProgramacion']="Seleccione un instructor existente";
                echo "<script>location.href='../views/programacion.php'</script>"; 
            }
       

        
        
        
        

        

    }

    // Fin de editar programacion


    if(isset($_GET['editprog'])){
        if (session_status() !== PHP_SESSION_ACTIVE) {
            // Si no está iniciada, la iniciamos
            session_start();
        } 
        $id = $_GET['editprog'];
        $ediprog = $consulta->editarasig($id);
        if($ediprog){
            $tc = $ediprog[0]['tipocompetencia'];
            $buscarCompes = $consulta->compes_buscar($tc);
                if($buscarCompes){
                    $_SESSION['editarCompetencias'] =$buscarCompes;
                    $_SESSION['editarprogramacion'] =$ediprog;
                    echo "<script>location.href='../views/programacion.php'</script>";
                }else{
                    echo "<script>location.href='../views/programacion.php'</script>";
                }
        }else{
            echo "<script>location.href='../views/programacion.php'</script>";
        }
        
        

    }
    if(isset($_GET['cancelx'])){
        if (session_status() !== PHP_SESSION_ACTIVE) {
            // Si no está iniciada, la iniciamos
            session_start();
        }
        unset($_SESSION['editarprogramacion']);
        echo "<script>location.href='../views/programacion.php'</script>";
    }

    if(isset($_GET['eliminar_id'])){
        $idprog = $_GET['eliminar_id'];
        $eliminar = $consulta->eliminar_asig($idprog);
        if($eliminar){
            if (session_status() !== PHP_SESSION_ACTIVE) {
            // Si no está iniciada, la iniciamos
            session_start();
            }
            $_SESSION['tipo_alert_programacion']="danger";
            $_SESSION['mensajeProgramacion']="Programación eliminada correctamente";
            echo "<script>location.href='../views/programacion.php'</script>";
        }else{
            $_SESSION['tipo_alert_programacion']="danger";
            $_SESSION['mensajeProgramacion']="Error, intente otra vez";
            echo "<script>location.href='../views/programacion.php'</script>";
        }
    }



?>