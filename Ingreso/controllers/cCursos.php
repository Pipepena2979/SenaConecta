<?php
 include("../models/mconsultas.php");
   
    $consulta = new Consultas(); // Objecto

    $programas = $consulta->programas();
    $nivelcurso = $consulta->consultarNivel();

    $competenciascursos = $consulta->Competenciascursos();
    $tipocompetenciacursos = $consulta->mostrartipocompetencia();

    $perfilesinstrutores = $consulta->perfilesinstrutores();
    $region = $consulta->mostrarregion();

    $cursos =  $consulta->cursos();
    $competencias =  $consulta->competencias();
    $jornada = $consulta->mostrarjornada();




if(isset($_POST['programas'])){
    if (session_status() !== PHP_SESSION_ACTIVE) {
        // Si no está iniciada, la iniciamos
        session_start();
    }
    $programa = trim(isset($_POST['programas']) ? $_POST['programas']:NULL);
        $consultarCurso = $consulta->consultarCurso($programa);
            if($consultarCurso){
                $competencias = $consulta->perfiles($programa);
                $cursoseleccionado = $consulta->cursoseleccionado($programa);
                $_SESSION['cursoseleccionado'] = $cursoseleccionado;

                $_SESSION['cursocodigoseleccionado'] = $consulta->cursoseleccionado2($programa);
        
                if(empty($competencias)){
                    $_SESSION['mensajeCurso'] = 'Este curso no tiene competencias asignadas';
                    $_SESSION['tipo_alert_Curso'] = 'danger';
                    $_SESSION['competenciasvacias'] = true;
                    $_SESSION['select'] = $programa;
                    unset($_SESSION['competencias']);
                    echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                }else{
                    $_SESSION['competenciasvacias'] = 'Asigar nueva competencia';
                    $_SESSION['competencias'] = $competencias;
                    $_SESSION['select'] = $programa;
                    echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                }
            }else{
                $_SESSION['mensajeCurso'] = 'Curso con el codigo ' . $programa  . ' es inexistente';
                $_SESSION['tipo_alert_Curso'] = 'danger';
                echo "<script>location.href='../views/tablaperfilcu.php'</script>";
            }
}



if(isset($_POST['codigo'])){
    if (session_status() !== PHP_SESSION_ACTIVE) {
        // Si no está iniciada, la iniciamos
        session_start();
    }   
   $codigo = trim(isset($_POST['codigo']) ? $_POST['codigo']:NULL);
    if(!empty($codigo)){
        if(is_numeric($codigo)){
            $consultarCurso = $consulta->consultarCurso($codigo);
                if($consultarCurso){
                    $_SESSION['tipo_alert_Curso']="danger";
                    $_SESSION['mensajeCurso']="El codigo " . $codigo . " ya fue registrado con otro curso";
                    echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                }else{
                    $version = trim(isset($_POST['version']) ? $_POST['version']:NULL);
                        if(!empty($version)){
                            if(is_numeric($version)){
                                if($version > 0){
                                    $n= trim(isset($_POST['nombre']) ? $_POST['nombre']:NULL);
                                        if(!empty($n)){
                                            $N1 = strtolower($n);
                                            $nombre = ucwords($N1);
                                            $nivel = trim(isset($_POST['nivel']) ? $_POST['nivel']:NULL);
                                                if(!empty(($nivel))){
                                                    if(is_numeric($nivel)){
                                                        $jornada = trim(isset($_POST['jornada']) ? $_POST['jornada']:NULL);
                                                            if(!empty($jornada)){
                                                                if(is_numeric($jornada)){
                                                                    $descripcion = trim(isset($_POST['descripcion']) ? $_POST['descripcion']:NULL);
                                                                        if(!empty($descripcion)){
                                                                            if (session_status() !== PHP_SESSION_ACTIVE) {
                                                                                // Si no está iniciada, la iniciamos
                                                                                session_start();
                                                                            }
                                                                            
                                                                                $region = trim(isset($_POST['zona']) ? $_POST['zona']:NULL);
                                                                                    if(!empty($region)){
                                                                                        if(is_numeric($region)){
                                                                                            $municipio = trim(isset($_POST['Ciudad']) ? $_POST['Ciudad']:NULL);
                                                                                            $nuevocurso = $consulta->nuevocurso($codigo,$version,$nombre,$nivel,$jornada,$descripcion,$region,$municipio);
                                                                                                if($nuevocurso){
                                                                                                    $_SESSION['tipo_alert_Curso']="success";
                                                                                                    $_SESSION['mensajeCurso']="Curso registrado correctamente";
                                                                                                    echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                                                                                                    unset($_SESSION['select']);
                                                                                                }else{
                                                                                                    $_SESSION['tipo_alert_Curso']="danger";
                                                                                                    $_SESSION['mensajeCurso']="Error al registrar el curso, intente otra vez";
                                                                                                    echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                                                                                                    unset($_SESSION['select']);
                                                                                                }
                                                                                        }else{
                                                                                            $_SESSION['tipo_alert_Curso']="danger";
                                                                                            $_SESSION['mensajeCurso']="Error en la region de el curso a crear";
                                                                                            echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                                                                                        }
                                                                                    }else{
                                                                                        $_SESSION['tipo_alert_Curso']="danger";
                                                                                        $_SESSION['mensajeCurso']="Seleccione una region para el curso a crear";
                                                                                        echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                                                                                    }
                                            
                                                                        }else{
                                                                            $_SESSION['tipo_alert_Curso']="danger";
                                                                            $_SESSION['mensajeCurso']="Ingrese la descripción del curso a crear";
                                                                            echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                                                                        }
                                                                }else{
                                                                    $_SESSION['tipo_alert_Curso']="danger";
                                                                    $_SESSION['mensajeCurso']="Error en la jornada academica del curso a crear";
                                                                    echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                                                                }
                                                            }else{
                                                                $_SESSION['tipo_alert_Curso']="danger";
                                                                $_SESSION['mensajeCurso']="Seleccione la jornada academica del curso a crear";
                                                                echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                                                            }
                                                    }else{
                                                        $_SESSION['tipo_alert_Curso']="danger";
                                                        $_SESSION['mensajeCurso']="Error en el nivel academico del curso a crear";
                                                        echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                                                    }
                                                }else{
                                                    $_SESSION['tipo_alert_Curso']="danger";
                                                    $_SESSION['mensajeCurso']="Seleccione el nivel academico del curso a crear";
                                                    echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                                                }
                                        }else{
                                            $_SESSION['tipo_alert_Curso']="danger";
                                            $_SESSION['mensajeCurso']="Ingrese el nombre del curso a crear";
                                            echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                                        }
                                }else{
                                    $_SESSION['tipo_alert_Curso']="danger";
                                    $_SESSION['mensajeCurso']="La version del curso a crear debe ser mayor a 0";
                                    echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                                }
                            }else{
                                $_SESSION['tipo_alert_Curso']="danger";
                                $_SESSION['mensajeCurso']="Error en la version del curso a crear";
                                echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                            }
                        }else{
                            $_SESSION['tipo_alert_Curso']="danger";
                            $_SESSION['mensajeCurso']="Ingrese la version del curso a crear";
                            echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                        }
                }
        }else{
            $_SESSION['tipo_alert_Curso']="danger";
            $_SESSION['mensajeCurso']="Error en el codigo del curso a crear";
            echo "<script>location.href='../views/tablaperfilcu.php'</script>";
        }
    }else{
        $_SESSION['tipo_alert_Curso']="danger";
        $_SESSION['mensajeCurso']="Ingrese un codigo del curso a crear";
        echo "<script>location.href='../views/tablaperfilcu.php'</script>";
    } 
}


//  Nueva competencia

if (session_status() !== PHP_SESSION_ACTIVE) {
    // Si no está iniciada, la iniciamos
    session_start();
}

 if(isset($_POST['tCompetencia'])){

    $tCompetencia = trim(isset($_POST['tCompetencia']) ? $_POST['tCompetencia']:NULL);
        if(!empty($tCompetencia)){
            if(is_numeric($tCompetencia)){
                $consultartCompetencia = $consulta->consultartCompetencia($tCompetencia);
                    if($consultartCompetencia){
                        $codigocompe = trim(isset($_POST['codigocompe']) ? $_POST['codigocompe']:NULL);
                        if(!empty($codigocompe)){
                            if(is_numeric($codigocompe)){
                                $consultarCodigocompe = $consulta->consultarCodigocompe($codigocompe);
                                    if($consultarCodigocompe){
                                        //echo "<script>alert('ya existe el codigo de la competencia')</script>";
                                        $_SESSION['tipo_alert_Curso']="danger";
                                        $_SESSION['mensajeCurso']="El codigo de la competencia " . $codigocompe . " ya fue resgistrado con otra competencia";
                                        echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                                    }else{
                                        $no= trim(isset($_POST['nombrecompe']) ? $_POST['nombrecompe']:NULL);
                                            if(!empty($no)){
                                                $no1 = strtolower($no);
                                                $nombrecompe = ucfirst($no1);
                                                $cHoras = trim(isset($_POST['cHoras']) ? $_POST['cHoras']:NULL);
                                                if(!empty($cHoras)){
                                                    if(is_numeric($cHoras)){
                                                        if($cHoras > 0){
                                                            $rAprendizaje = trim(isset($_POST['rAprendizaje']) ? $_POST['rAprendizaje']:NULL);
                                                                if(!empty($rAprendizaje)){
                                                                    if(is_numeric($rAprendizaje)){
                                                                        if($rAprendizaje > 0){
                                                                            if (session_status() !== PHP_SESSION_ACTIVE) {
                                                                                // Si no está iniciada, la iniciamos
                                                                                session_start();
                                                                            }
                                                                        
                                                                            $nuevacompetencia = $consulta->nuevacompetencia($tCompetencia,$codigocompe,$nombrecompe,$cHoras,$rAprendizaje);
                                                                            
                                                                            if($nuevacompetencia){
                                                                                $_SESSION['tipo_alert_Curso']="success";
                                                                                $_SESSION['mensajeCurso']="Competencia registrada correctamente";
                                                                                echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                                                                            }else{
                                                                                $_SESSION['tipo_alert_Curso']="danger";
                                                                                $_SESSION['mensajeCurso']="Error al registrar la nueva competencia, intente otra vez";
                                                                                echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                                                                            }
                                                                        }else{
                                                                            // echo "<script>alert('resultados de aprendizaje debe ser mayor a 0')</script>";
                                                                            $_SESSION['tipo_alert_Curso']="danger";
                                                                            $_SESSION['mensajeCurso']="Los resultados de aprendizaje de la competencia debe ser mayor a 0";
                                                                            echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                                                                        }
                                                                    }else{
                                                                        $_SESSION['tipo_alert_Curso']="danger";
                                                                        $_SESSION['mensajeCurso']="Error en resultados de aprendizaje de la competencia";
                                                                        echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                                                                    }
                                                                }else{
                                                                    $_SESSION['tipo_alert_Curso']="danger";
                                                                    $_SESSION['mensajeCurso']="Ingrese la cantidad de resultados de aprendizaje de la competencia";
                                                                    echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                                                                }
                                                        }else{
                                                            $_SESSION['tipo_alert_Curso']="danger";
                                                            $_SESSION['mensajeCurso']="La cantidad de horas de la competencia debe ser mayor a 0";
                                                            echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                                                        }
                                                    }else{
                                                        $_SESSION['tipo_alert_Curso']="danger";
                                                        $_SESSION['mensajeCurso']="Error en la cantidad de horas de la competencia";
                                                        echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                                                    }
                                                }else{
                                                    $_SESSION['tipo_alert_Curso']="danger";
                                                    $_SESSION['mensajeCurso']="Ingrese la cantidad de horas de la competencia";
                                                    echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                                                }
                                            }else{
                                                $_SESSION['tipo_alert_Curso']="danger";
                                                $_SESSION['mensajeCurso']="Ingrese el nombre de la competencia";
                                                echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                                            }
                                    }
                            }else{
                                $_SESSION['tipo_alert_Curso']="danger";
                                $_SESSION['mensajeCurso']="Error codigo de la competencia";
                                echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                            }
                        }else{
                            $_SESSION['tipo_alert_Curso']="danger";
                            $_SESSION['mensajeCurso']="Ingrese el codigo de la competencia";
                            echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                        }
                    }else{
                        $_SESSION['tipo_alert_Curso']="danger";
                        $_SESSION['mensajeCurso']="Tipo de competencia no existente";
                        echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                    }
            }else{
                $_SESSION['tipo_alert_Curso']="danger";
                $_SESSION['mensajeCurso']="Error en tipo de competencia";
                echo "<script>location.href='../views/tablaperfilcu.php'</script>";
            }
        }else{
            $_SESSION['tipo_alert_Curso']="danger";
            $_SESSION['mensajeCurso']="Seleccione un tipo de competencia";
            echo "<script>location.href='../views/tablaperfilcu.php'</script>";
        }   
 }

 // Asignar Nueva competencia

 if(isset($_POST['compeasignada'])){

    if (session_status() !== PHP_SESSION_ACTIVE) {
        // Si no está iniciada, la iniciamos
        session_start();
    }

    if(isset($_SESSION['cursocodigoseleccionado'])){
        $codigocursoasignado = $_SESSION['cursocodigoseleccionado'][0]['codigo_prog'];
            if(is_numeric($codigocursoasignado)){
                $tipocompe = trim(isset($_POST['tipocompe']) ? $_POST['tipocompe']:NULL);
                    if(!empty($tipocompe)){
                        if(is_numeric($tipocompe)){
                            $consultartCompetencia = $consulta->consultartCompetencia($tipocompe);
                                if($consultartCompetencia){
                                    $compeasignada = trim(isset($_POST['compeasignada']) ? $_POST['compeasignada']:NULL);
                                        if(!empty($compeasignada)){
                                            if(is_numeric($compeasignada)){
                                                $consultarCompe = $consulta->consultarCompe($compeasignada);
                                                    if($consultarCompe){
                                                        $tipoperfilasignada = trim(isset($_POST['tipoperfilasignada']) ? $_POST['tipoperfilasignada']:NULL);
                                                            if(!empty($tipoperfilasignada)){
                                                                if(is_numeric($tipoperfilasignada)){
                                                                    $consultarPerfil = $consulta->consultarPerfilRequerido($tipoperfilasignada);
                                                                        if($consultarPerfil){

                                                                            $asignacioncompetencia = $consulta->asignacioncompetencia($codigocursoasignado,$tipocompe,$compeasignada,$tipoperfilasignada);

                                                                            if($asignacioncompetencia){
                                                                                $competencias = $consulta->perfiles($codigocursoasignado);
                                                                                    if($competencias){
                                                                                        $_SESSION['competencias'] = $competencias;
                                                                                        $_SESSION['tipo_alert_Curso']="success";
                                                                                        $_SESSION['mensajeCurso']="Registro de la asignación de la competencia";
                                                                                        echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                                                                                    }
                                                                            }else{
                                                                                $_SESSION['tipo_alert_Curso']="danger";
                                                                                $_SESSION['mensajeCurso']="Error en la asiganción de la competencia";
                                                                                echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                                                                            }
                                                                        }else{
                                                                            $_SESSION['tipo_alert_Curso']="danger";
                                                                            $_SESSION['mensajeCurso']="Perfil requerido inexistente";
                                                                            echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                                                                        }
                                                                }else{
                                                                    $_SESSION['tipo_alert_Curso']="danger";
                                                                    $_SESSION['mensajeCurso']="Error en el perfil requerido";
                                                                    echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                                                                }
                                                            }else{
                                                                $_SESSION['tipo_alert_Curso']="danger";
                                                                $_SESSION['mensajeCurso']="Seleccione un perfil requerido";
                                                                echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                                                            }
                                                    }else{
                                                        $_SESSION['tipo_alert_Curso']="danger";
                                                        $_SESSION['mensajeCurso']="Competencia inexistente";
                                                        echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                                                    }
                                            }else{
                                                $_SESSION['tipo_alert_Curso']="danger";
                                                $_SESSION['mensajeCurso']="Error en la competencia";
                                                echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                                            }
                                        }else{
                                            $_SESSION['tipo_alert_Curso']="danger";
                                            $_SESSION['mensajeCurso']="Seleccione una competencia";
                                            echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                                        }
                                }else{
                                    $_SESSION['tipo_alert_Curso']="danger";
                                    $_SESSION['mensajeCurso']="Tipo de competencia inexistente";
                                    echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                                }
                        }else{
                            $_SESSION['tipo_alert_Curso']="danger";
                            $_SESSION['mensajeCurso']="Error en el tipo de competencia";
                            echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                        }
                    }else{
                        $_SESSION['tipo_alert_Curso']="danger";
                        $_SESSION['mensajeCurso']="Seleccione un tipo de competencia";
                        echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                    }
            }else{
                $_SESSION['tipo_alert_Curso']="danger";
                $_SESSION['mensajeCurso']="Error, intente de nuevo seleccionando un curso";
                echo "<script>location.href='../views/tablaperfilcu.php'</script>";
            }
    }else{
        $_SESSION['tipo_alert_Curso']="danger";
        $_SESSION['mensajeCurso']="Error, intente de nuevo seleccionando un curso";
        echo "<script>location.href='../views/tablaperfilcu.php'</script>";
    }    
}

 // Eliminar competecia

 if(isset($_GET['eliminarcompe'])){
    if (session_status() !== PHP_SESSION_ACTIVE) {
        // Si no está iniciada, la iniciamos
        session_start();
    }
        if(isset($_SESSION['cursocodigoseleccionado'])){
            $codigoseleccionado = $_SESSION['cursocodigoseleccionado'][0]['codigo_prog'];
            $compeborrada = trim(isset($_GET['eliminarcompe']) ? $_GET['eliminarcompe']:NULL);
                if(!empty($compeborrada)){
                    $eliminado = $consulta->eliminarcompetencia($compeborrada);
                    if($eliminado){
                
                        $competenciasafterdelete = $consulta->perfiles($codigoseleccionado);
                
                        if($competenciasafterdelete){
                            $_SESSION['mensajeCurso'] = 'Competencia eliminada correctamente';
                            $_SESSION['tipo_alert_Curso'] = 'success';
                            $_SESSION['competencias'] = $competenciasafterdelete;
                            echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                        }else{
                            $_SESSION['mensajeCurso'] = 'Este curso no tiene competencias asignadas';
                            $_SESSION['tipo_alert_Curso'] = 'danger';
                            $_SESSION['competenciasvacias'] = 'Asignar competencia';
                            unset($_SESSION['competencias']);
                            echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                        }
                    }
                }else{
                    $_SESSION['mensajeCurso'] = 'Error, intente otra vez';
                    $_SESSION['tipo_alert_Curso'] = 'danger';
                    echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                }
        }else{
            $_SESSION['mensajeCurso'] = 'Error, intente otra vez';
            $_SESSION['tipo_alert_Curso'] = 'danger';
            echo "<script>location.href='../views/tablaperfilcu.php'</script>";
        }
}


// Ver cursos

if(isset($_GET['curReg'])){
    if (session_status() !== PHP_SESSION_ACTIVE) {
        // Si no está iniciada, la iniciamos
        session_start();
    }
    
    $_SESSION['curReg'] = 1;
    unset($_SESSION['competenciasvacias']);
    unset($_SESSION['comReg']);
    unset($_SESSION['cursocodigoseleccionado']);
    unset($_SESSION['select']);
    unset($_SESSION['competencias']);
    echo "<script>location.href='../views/tablaperfilcu.php'</script>";
}

// Fin de ver cursos

// Ver cursos

if(isset($_GET['volver'])){
    if (session_status() !== PHP_SESSION_ACTIVE) {
        // Si no está iniciada, la iniciamos
        session_start();
    }
    unset($_SESSION['competenciasvacias']);
    unset($_SESSION['comReg']);
    unset($_SESSION['curReg']);
    unset($_SESSION['cursocodigoseleccionado']);
    unset($_SESSION['select']);
    unset($_SESSION['competencias']);
    echo "<script>location.href='../views/tablaperfilcu.php'</script>";
}

// Fin de ver cursos


// Ver competencias

if(isset($_GET['comReg'])){
    if (session_status() !== PHP_SESSION_ACTIVE) {
        // Si no está iniciada, la iniciamos
        session_start();
    }
    
    $_SESSION['comReg'] = 1;
    UNSET($_SESSION['editarCursos']);
    UNSET($_SESSION['editarCompetencia']);

    unset($_SESSION['competenciasvacias']);
    unset($_SESSION['curReg']);
    unset($_SESSION['cursocodigoseleccionado']);
    unset($_SESSION['select']);
    unset($_SESSION['competencias']);
    echo "<script>location.href='../views/tablaperfilcu.php'</script>";
}

// Fin de competencias
 
if(isset($_GET['volverCom'])){
    if (session_status() !== PHP_SESSION_ACTIVE) {
        // Si no está iniciada, la iniciamos
        session_start();
    }
    unset($_SESSION['competenciasvacias']);
    unset($_SESSION['comReg']);
    unset($_SESSION['curReg']);
    unset($_SESSION['cursocodigoseleccionado']);
    unset($_SESSION['select']);
    unset($_SESSION['competencias']);
    echo "<script>location.href='../views/tablaperfilcu.php'</script>";
}


// Eliminar competencia
if(isset($_GET['eliminarCompetencia'])){ 
    if (session_status() !== PHP_SESSION_ACTIVE) {
        // Si no está iniciada, la iniciamos
        session_start();
    }
    $codigoCompetencia = $_GET['eliminarCompetencia'];
        $consultarCodigocompe = $consulta->consultarCodigocompe($codigoCompetencia);
            if($consultarCodigocompe){
                $eliminarCompetencia = $consulta->eliminarCompetencias($codigoCompetencia);
                if($eliminarCompetencia){
                    $_SESSION['mensajeCurso'] = 'Competencia eliminada correctamente';
                    $_SESSION['tipo_alert_Curso'] = 'success';
                    echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                }else{
                    $_SESSION['mensajeCurso'] = 'Error al eliminar la competencia, intente otra vez por favor';
                    $_SESSION['tipo_alert_Curso'] = 'danger';
                    echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                }
            }else{
                $_SESSION['mensajeCurso'] = 'La competencia es inexistente, intente otra vez por favor';
                $_SESSION['tipo_alert_Curso'] = 'danger';
                echo "<script>location.href='../views/tablaperfilcu.php'</script>";
            }
}
// Fin de Eliminar competencia


// abrir formulario editar curso

if(isset($_GET['editCursos'])){ 
    $codigoCurso = $_GET['editCursos'];
        if(!empty($codigoCurso)){
            if(is_numeric($codigoCurso)){
                if($codigoCurso > 0){
                    $consultarCurso = $consulta->consultarCurso($codigoCurso);
                        if($consultarCurso){
                            $_SESSION['editarCursos'] = $consultarCurso;
                            echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                        }else{
                            $_SESSION['tipo_alert_Curso']="danger";
                            $_SESSION['mensajeCurso']="Curso inexistente";
                            echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                        }
                }else{
                    $_SESSION['tipo_alert_Curso']="danger";
                    $_SESSION['mensajeCurso']="El codigo del curso debe ser mayor a 0";
                    echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                }
            }else{
                $_SESSION['tipo_alert_Curso']="danger";
                $_SESSION['mensajeCurso']="El codigo del curso debe ser numerico";
                echo "<script>location.href='../views/tablaperfilcu.php'</script>";
            }
        }else{
            $_SESSION['tipo_alert_Curso']="danger";
            $_SESSION['mensajeCurso']="Error";
            echo "<script>location.href='../views/tablaperfilcu.php'</script>";
        }
}

// Fin de abrir formulario editar curso

// Editar curso

if(isset($_POST['eNombreCurso'])){
    if (session_status() !== PHP_SESSION_ACTIVE) {
        // Si no está iniciada, la iniciamos
        session_start();
    }
    $eN = trim(isset($_POST['eNombreCurso']) ? $_POST['eNombreCurso']:NULL);
        if(!empty($eN)){
            $eN1 = strtolower($eN);
            $eNombreCurso = ucwords($eN1);
            $eNivelCurso = trim(isset($_POST['eNivelCurso']) ? $_POST['eNivelCurso']:NULL);
                if(!empty($eNivelCurso)){
                    if(is_numeric($eNivelCurso)){
                        $consultarNivel = $consulta->consultarNivelC($eNivelCurso);
                            if($consultarNivel){
                                $eVersionCurso = trim(isset($_POST['eVersionCurso']) ? $_POST['eVersionCurso']:NULL);
                                    if(!empty($eVersionCurso)){
                                        if(is_numeric($eVersionCurso)){
                                            if($eVersionCurso > 0){
                                                $eD= trim(isset($_POST['eDescripcionCurso']) ? $_POST['eDescripcionCurso']:NULL);
                                                    if(!empty($eD)){
                                                        $eDlenght = strlen($eD);
                                                            if($eDlenght <= 499){
                                                                $eD1 = strtolower($eD);
                                                                $eDescripcionCurso = ucfirst($eD1);

                                                                $codigo = $_SESSION['editarCursos'][0]['codigo_prog'];
                                                                
                                                                $editarCurso = $consulta->editarCurso($eNombreCurso,$eNivelCurso,$eVersionCurso,$eDescripcionCurso,$codigo);

                                                                if($editarCurso){
                                                                    
                                                                    $_SESSION['tipo_alert_Curso']="success";
                                                                    $_SESSION['mensajeCurso']="Curso con codigo " . $codigo . " fue editado correctamente";
                                                                    unset($_SESSION['editarCursos']);
                                                                    echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                                                                }else{
                                                                    unset($_SESSION['editarCursos']);
                                                                    $_SESSION['tipo_alert_Curso']="danger";
                                                                    $_SESSION['mensajeCurso']="Error al editar el curso, intente otra vez";
                                                                    echo "<script>location.href='../views/tablaperfilcu.php'</script>"; 
                                                                }
                                                                
                                                            }else{
                                                                $_SESSION['tipo_alert_Curso']="danger";
                                                                $_SESSION['mensajeCurso']="La descripción del curso debe ser menor o igual a 499 caracteres";
                                                                echo "<script>location.href='../views/tablaperfilcu.php'</script>"; 
                                                            }
                                                    }else{
                                                        $_SESSION['tipo_alert_Curso']="danger";
                                                        $_SESSION['mensajeCurso']="Ingrese la descripción del curso";
                                                        echo "<script>location.href='../views/tablaperfilcu.php'</script>"; 
                                                    }
                                            }else{
                                                $_SESSION['tipo_alert_Curso']="danger";
                                                $_SESSION['mensajeCurso']="La version del curso debe ser mayor a 0";
                                                echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                                            }
                                        }else{
                                            $_SESSION['tipo_alert_Curso']="danger";
                                            $_SESSION['mensajeCurso']="Error en la version del curso";
                                            echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                                        }
                                    }else{
                                        $_SESSION['tipo_alert_Curso']="danger";
                                        $_SESSION['mensajeCurso']="Ingrese la version del curso";
                                        echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                                    }
                            }else{
                                $_SESSION['tipo_alert_Curso']="danger";
                                $_SESSION['mensajeCurso']="El nivel academico no existe";
                                echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                            }
                    }else{
                        $_SESSION['tipo_alert_Curso']="danger";
                        $_SESSION['mensajeCurso']="Error en nivel academico del curso";
                        echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                    }
                }else{
                    $_SESSION['tipo_alert_Curso']="danger";
                    $_SESSION['mensajeCurso']="Seleccione el nivel academico del curso";
                    echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                }       
        }else{
            $_SESSION['tipo_alert_Curso']="danger";
            $_SESSION['mensajeCurso']="Ingrese el nombre del curso";
            echo "<script>location.href='../views/tablaperfilcu.php'</script>";
        }

}

// fin de editar curso

// Cancerlar editar curso
if(isset($_GET['cancelCurso'])){
    if (session_status() !== PHP_SESSION_ACTIVE) {
        // Si no está iniciada, la iniciamos
        session_start();
    }
    
    unset($_SESSION['editarCursos']);
    echo "<script>location.href='../views/tablaperfilcu.php'</script>";
}
// fin cancelar editar curso


// Eliminar curso
if(isset($_GET['eliminarCursos'])){ 
    if (session_status() !== PHP_SESSION_ACTIVE) {
        // Si no está iniciada, la iniciamos
        session_start();
    }
    $codigoCurso = $_GET['eliminarCursos'];
        $consultarCodigoCurso = $consulta->consultarCurso($codigoCurso);
            if($consultarCodigoCurso){
                $eliminarCurso = $consulta->eliminarCurso($codigoCurso);
                if($eliminarCurso){
                    $_SESSION['mensajeCurso'] = 'Curso eliminado correctamente';
                    $_SESSION['tipo_alert_Curso'] = 'success';
                    echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                }else{
                    $_SESSION['mensajeCurso'] = 'Error al eliminar el curso, intente otra vez por favor';
                    $_SESSION['tipo_alert_Curso'] = 'danger';
                    echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                }
            }else{
                $_SESSION['mensajeCurso'] = 'El curso es inexistente, intente otra vez por favor';
                $_SESSION['tipo_alert_Curso'] = 'danger';
                echo "<script>location.href='../views/tablaperfilcu.php'</script>";
            }
}
// Fin de Eliminar curso


// abrir formulario editar competencia

if(isset($_GET['editCompetencias'])){ 
    $codigoCompetencia = $_GET['editCompetencias'];
        if(!empty($codigoCompetencia)){
            if(is_numeric($codigoCompetencia)){
                if($codigoCompetencia > 0){
                    $consultarCompetencia = $consulta->consultarCompe($codigoCompetencia);
                        if($consultarCompetencia){
                            $_SESSION['editarCompetencia'] = $consultarCompetencia;
                            echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                        }else{
                            $_SESSION['tipo_alert_Curso']="danger";
                            $_SESSION['mensajeCurso']="La competencia con " . $codigoCompetencia . " es inexistente";
                            echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                        }
                }else{
                    $_SESSION['tipo_alert_Curso']="danger";
                    $_SESSION['mensajeCurso']="El codigo de la competencia debe ser mayor a 0";
                    echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                }
            }else{
                $_SESSION['tipo_alert_Curso']="danger";
                $_SESSION['mensajeCurso']="El codigo de la competencia debe ser numerico";
                echo "<script>location.href='../views/tablaperfilcu.php'</script>";
            }
        }else{
            $_SESSION['tipo_alert_Curso']="danger";
            $_SESSION['mensajeCurso']="Error";
            echo "<script>location.href='../views/tablaperfilcu.php'</script>";
        }
}

// Fin de abrir formulario editar competencia

// Cancerlar editar competencia
if(isset($_GET['cancelCompetencia'])){
    if (session_status() !== PHP_SESSION_ACTIVE) {
        // Si no está iniciada, la iniciamos
        session_start();
    }
    
    unset($_SESSION['editarCompetencia']);
    echo "<script>location.href='../views/tablaperfilcu.php'</script>";
}
// fin cancelar editar competencia


// Editar competencia

if(isset($_POST['eNombreCompetencia'])){
    if (session_status() !== PHP_SESSION_ACTIVE) {
        // Si no está iniciada, la iniciamos
        session_start();
    }
    $eN = trim(isset($_POST['eNombreCompetencia']) ? $_POST['eNombreCompetencia']:NULL);
    if(!empty($eN)){
        $eN1 = strtolower($eN);
        $eNombreCompetencia = ucwords($eN1);
        $eTipoCompetencia = trim(isset($_POST['eTipoCompetencia']) ? $_POST['eTipoCompetencia']:NULL);
            if(!empty($eTipoCompetencia)){
                if(is_numeric($eTipoCompetencia)){
                    $consultarTipoCompetencia = $consulta->consultartCompetencia($eTipoCompetencia);
                        if($consultarTipoCompetencia){
                            $eHoras = trim(isset($_POST['eHoras']) ? $_POST['eHoras']:NULL);
                                if(!empty($eHoras)){
                                    if(is_numeric($eHoras)){
                                        if($eHoras > 0){
                                            $eResultadosAprendizaje = trim(isset($_POST['eResultadosAprendizaje']) ? $_POST['eResultadosAprendizaje']:NULL);
                                                if(!empty($eResultadosAprendizaje)){
                                                    if(is_numeric($eResultadosAprendizaje)){
                                                        if($eResultadosAprendizaje > 0){
                                                            $codigoCompetencia = $_SESSION['editarCompetencia'][0]['cod_competencia'];
                                                                $editarCompetencia = $consulta->editarCompetencia($eNombreCompetencia,$eTipoCompetencia,$eHoras,$eResultadosAprendizaje,$codigoCompetencia);

                                                                if($editarCompetencia){
                                                                    unset($_SESSION['editarCompetencia']);
                                                                    $_SESSION['tipo_alert_Curso']="success";
                                                                    $_SESSION['mensajeCurso']="La competencia con codigo " . $codigoCompetencia . " fue editada correctamente";
                                                                    echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                                                                }else{
                                                                    unset($_SESSION['editarCompetencia']);
                                                                    $_SESSION['tipo_alert_Curso']="danger";
                                                                    $_SESSION['mensajeCurso']="Error al editar la competencia, intente otra vez";
                                                                    echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                                                                }
                                                        }else{
                                                            $_SESSION['tipo_alert_Curso']="danger";
                                                            $_SESSION['mensajeCurso']="Los resultados de aprendizaje de la competencia deben ser mayor a 0";
                                                            echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                                                        }
                                                    }else{
                                                        $_SESSION['tipo_alert_Curso']="danger";
                                                        $_SESSION['mensajeCurso']="Error en los resultados de aprendizaje de la competencia";
                                                        echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                                                    }
                                                }else{
                                                    $_SESSION['tipo_alert_Curso']="danger";
                                                    $_SESSION['mensajeCurso']="Ingrese los resultados de aprendizaje de la competencia";
                                                    echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                                                }
                                        }else{
                                            $_SESSION['tipo_alert_Curso']="danger";
                                            $_SESSION['mensajeCurso']="Las horas de duración de la competencia deben ser mayor a 0";
                                            echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                                        }
                                    }else{
                                        $_SESSION['tipo_alert_Curso']="danger";
                                        $_SESSION['mensajeCurso']="Error en las horas de duración de la competencia";
                                        echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                                    }
                                }else{
                                    $_SESSION['tipo_alert_Curso']="danger";
                                    $_SESSION['mensajeCurso']="Ingrese las horas de duración de la competencia";
                                    echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                                }
                        }else{
                            $_SESSION['tipo_alert_Curso']="danger";
                            $_SESSION['mensajeCurso']="Tipo de competencia inexistente";
                            echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                        }
                }else{
                    $_SESSION['tipo_alert_Curso']="danger";
                    $_SESSION['mensajeCurso']="Error en el tipo de competencia";
                    echo "<script>location.href='../views/tablaperfilcu.php'</script>";
                }
            }else{
                $_SESSION['tipo_alert_Curso']="danger";
                $_SESSION['mensajeCurso']="Seleccione el tipo competencia";
                echo "<script>location.href='../views/tablaperfilcu.php'</script>";
            }
    }else{
        $_SESSION['tipo_alert_Curso']="danger";
        $_SESSION['mensajeCurso']="Ingrese el nombre de la competencia";
        echo "<script>location.href='../views/tablaperfilcu.php'</script>";
    }
}

// fin de Editar competencia

?>