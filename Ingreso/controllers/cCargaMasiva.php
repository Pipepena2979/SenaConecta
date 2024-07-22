<?php

    include("../models/mconsultas.php");
   
    $consulta = new Consultas(); // Objecto

    if(isset($_GET['carga'])){
         
        // $idco = $_GET['editarevento'];
        //$eventoOne = $consulta->editareventoone($idco);
        if (session_status() !== PHP_SESSION_ACTIVE) {
            // Si no está iniciada, la iniciamos
            session_start();
        }
        unset($_SESSION['errorRegistrar']);
        $_SESSION['cargaMasiva'] =1;
        echo "<script>location.href='../views/registrar.php'</script>";

    }
    if(isset($_GET['cancelx'])){
        if (session_status() !== PHP_SESSION_ACTIVE) {
            // Si no está iniciada, la iniciamos
            session_start();
        }
        
        unset($_SESSION['cargaMasiva']);
        echo "<script>location.href='../views/registrar.php'</script>";
    }
    if(isset($_GET['plantilla'])){   
        $file = "../cargaMasiva/cargaMasiva.xlsx";
        if (is_file($file)) {
          $filename = "Plantilla_Carga_Masiva.xlsx"; // el nombre con el que se descargará, puede ser diferente al original
          /*header("Content-Type: application/octet-stream");*/
          header("Content-Type: application/force-download");
          header("Content-Disposition: attachment; filename=\"$filename\"");
          readfile($file);
        } else {
          die("Error: no se encontró el archivo '$file'");
        }    
    }
    if(isset($_POST['action'])){
        if (session_status() !== PHP_SESSION_ACTIVE) {
            // Si no está iniciada, la iniciamos
            session_start();
        }
        $archivo=$_FILES['cargaMasiva']['name'];
        $tipo=$_FILES['cargaMasiva']['type'];
        $fecha_actual = date("d-m-Y h:i:s");
        $destino="cargaMasiva_".$archivo;

        $formatos_permitidos =  array('xlsx');
        $archivo = $_FILES['cargaMasiva']['name'];
        $extension = pathinfo($archivo, PATHINFO_EXTENSION);

        if(in_array($extension, $formatos_permitidos) ) {
            if(copy($_FILES['cargaMasiva']['tmp_name'],$destino)){
                if (file_exists("cargaMasiva_".$archivo)){
                    // echo "Hola";
                    require_once('../vendor/PHPExcel/Classes/PHPExcel.php');
                    require_once('../vendor/PHPExcel/Classes/PHPExcel/Reader/Excel2007.php');
                    
                    
                    $objReader = new PHPExcel_reader_Excel2007();
                    $objPHPExcel = $objReader->load($destino);
                    // $objFecha=new PHPExcel_Shared_Date();
                    $objPHPExcel->setActiveSheetIndex(0);
                    $columnas=$objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
                    $filas=$objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

                    // inicio de for
                    for($i=3;$i<=$filas;$i++){

                        // if ($objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue() != null && $objPHPExcel->getActiveSheet()->getCell('L'.$i)->getCalculatedValue() != null) {
                        if ($objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue() != null && $objPHPExcel->getActiveSheet()->getCell('L'.$i)->getCalculatedValue() != "") {
                        $_DATA_EXCEL[$i]["T_doc"]= $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
                        $_DATA_EXCEL[$i]["num_doc"]=$objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
                        $_DATA_EXCEL[$i]["genero"]=$objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
                        $_DATA_EXCEL[$i]["rol"]=$objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
                        $_DATA_EXCEL[$i]["Correo"]=$objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
                        $_DATA_EXCEL[$i]["nombres"]=$objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue();
                        $_DATA_EXCEL[$i]["apellidos"]=$objPHPExcel->getActiveSheet()->getCell('H'.$i)->getCalculatedValue();
                        $_DATA_EXCEL[$i]["Telefono"]=$objPHPExcel->getActiveSheet()->getCell('I'.$i)->getCalculatedValue();
                        $_DATA_EXCEL[$i]["fechaNacimiento"]=$objPHPExcel->getActiveSheet()->getCell('J'.$i)->getCalculatedValue();
                        $_DATA_EXCEL[$i]["fechaContrato"]=$objPHPExcel->getActiveSheet()->getCell('K'.$i)->getCalculatedValue();
                        $_DATA_EXCEL[$i]["supervisor"]=$objPHPExcel->getActiveSheet()->getCell('L'.$i)->getCalculatedValue();
                        $_DATA_EXCEL[$i]["perfilProfesinal"]=$objPHPExcel->getActiveSheet()->getCell('M'.$i)->getCalculatedValue();
                            // var_dump($_DATA_EXCEL[$i]["perfilProfesinal"] , $i);
                            // die();
                        }
                    }
                    date_default_timezone_set("America/Bogota");
                    $fechaRegistro = date("Y-m-d h:i:s");
                    $fechaSession = date("Y-m-d h:i:s");
                    foreach($_DATA_EXCEL as $campo => $value){
                        // var_dump($_DATA_EXCEL);
                        // die();
                        $sql = "INSERT INTO person (`T_doc`, `num_doc`, `genero`, `rol`, `Correo`, `nombres`, 
                        `apellidos`, `Telefono`,`fechaNacimiento`,  
                        `fechaFinContrato`, `supervisor`, 
                        `contrasena`, `departamento`, `municipio`,`fechaRegistro`,`fechaSession`,`estado`,`editadoUltimaVez`,`registradoPor`) 
                        VALUES (";
                            foreach($value as $campo2 => $value2){
                                if($campo2=="T_doc"){
                                    $sql.="$value2,";
                                }elseif($campo2=="num_doc"){
                                    $contraCarga = $value2;
                                    $pas = substr($value2, -4);
                                    $pass= sha1(md5($pas));
                                    $sql.="$value2";
                                }else if($campo2=="genero"){
                                    $sql.=",$value2";
                                }else if($campo2=="rol"){
                                    $sql.=",$value2";
                                }else if($campo2=="Correo"){
                                    $sql.=",'$value2'";
                                }else if($campo2=="nombres"){
                                    $sql.=",'$value2'";
                                }else if($campo2=="apellidos"){
                                    $sql.=",'$value2'";
                                }else if($campo2=="Telefono"){
                                    $sql.=",$value2";
                                }else if($campo2=="fechaNacimiento"){
                                    $sql.=",'$value2'";
                                }else if($campo2=="fechaContrato"){
                                    $sql.=",'$value2'";
                                }else if($campo2=="supervisor"){
                                    // var_dump($value2);
                                    // die();
                                    if ($value2 === 0 ) {
                                        $sql.="," . NULL;
                                        // var_dump($sql);
                                        // die();
                                    }else{
                                        $sql.=",$value2";
                                        // var_dump("no entro");
                                        // die();
                                    }
                                }
                            }
                            

                            $sql.=",'$pass'"; // contraseña
                            $sql.=","  . $_SESSION['departamentoUsu']; // departamento
                            $sql.="," . $_SESSION['municipioUsu']; // municipio
                            $sql.=", '$fechaRegistro' "; // fechaRegistro
                            $sql.=", '$fechaSession' "; // fechaSession
                            $sql.="," . 1; // estado
                            $sql.="," . $_SESSION['num_doc']; // editado ultima vez
                            $sql.="," . $_SESSION['num_doc']; // registrado por
                            $sql.=");";
                            // var_dump($sql);
                            // die();

                            $insert=$consulta->guardar_carga_masiva_usuario($sql);

                            foreach($value as $campo2 => $value2){
                                if($campo2=="num_doc"){
                                    $contraCarga = $value2;
                                }elseif($campo2=="perfilProfesinal"){
                                    if ($value2 == "") {
                                        $perfil = "Por definir";
                                        $insert=$consulta->guardarCargaMasivaPerfil($contraCarga,$perfil,$fechaRegistro);
                                    }else{
                                        $insert=$consulta->guardarCargaMasivaPerfil($contraCarga,$value2,$fechaRegistro);
                                    }
                                    
                                }
                            }
                    }

    



                    if($insert){
                        if (session_status() !== PHP_SESSION_ACTIVE) {
                            // Si no está iniciada, la iniciamos
                            session_start();
                        }
                        $_SESSION['tipo_alert_carga']="success";
                        $_SESSION['mensajeCarga']="Carga masiva exitosa";
                        echo "<script>location.href='../views/registrar.php'</script>";
                    
                    }else{
                    
                        if (session_status() !== PHP_SESSION_ACTIVE) {
                            // Si no está iniciada, la iniciamos
                            session_start();
                        }
                        $_SESSION['tipo_alert_carga']="danger";
                        $_SESSION['mensajeCarga']="Error al cargar";
                        echo "<script>location.href='../views/registrar.php'</script>";
                    }

                }
            }else{
                // echo "Error al cargar archivo";
                if (session_status() !== PHP_SESSION_ACTIVE) {
                    // Si no está iniciada, la iniciamos
                    session_start();
                }
                $_SESSION['tipo_alert_carga']="danger";
                $_SESSION['mensajeCarga']="Error al cargar archivo";
                echo "<script>location.href='../views/registrar.php'</script>"; 
            }
        }else{
            if (session_status() !== PHP_SESSION_ACTIVE) {
                // Si no está iniciada, la iniciamos
                session_start();
            }
            $_SESSION['tipo_alert_carga']="danger";
            $_SESSION['mensajeCarga']="Error en la extension del archivo";
            echo "<script>location.href='../views/registrar.php'</script>"; 
        }
    }
?>