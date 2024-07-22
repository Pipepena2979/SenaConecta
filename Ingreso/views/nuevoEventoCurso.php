<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
  // Si no está iniciada, la iniciamos
  session_start();
}

date_default_timezone_set("America/Bogota");
setlocale(LC_ALL,"es_ES");
//$hora = date("g:i:A");


require("config.php");
$nDoc          = $_REQUEST['instructor'];
// $nivel          = $_REQUEST['nivel'];
// $nTitulacion            = $_REQUEST['nTitulacion'];
$rubro          = $_REQUEST['rubro'];
$tCompetencia          = $_REQUEST['tCompetencia'];
$Competencia          = $_REQUEST['Competencia'];
$hora_Inicio          = $_REQUEST['hora_Inicio'];
$hora_Fin          = $_REQUEST['hora_Fin'];
$nivel = $_SESSION['calendarioCurso'][0]['nivel'];
$nTitulacion = $_SESSION['calendarioCurso'][0]['codigo_prog'];
$ambiente = $_REQUEST['ambiente'];


$f_inicio          = $_REQUEST['fecha_inicio'];
 

date_default_timezone_set("America/Bogota");
$fechaProgramacion = date("Y-m-d h:i:s");

$registrador = $_SESSION['num_doc'];


$fechas             = $_REQUEST['fechas'];



switch ($tCompetencia) {
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

$i = 0;
$iT = '';
$j= 0;
$jT= '';

if(count($fechas) > count(array_unique($fechas))){
  header("Location:calendarioCursos.php?eRep=1");
}else{

  foreach($fechas AS $p){

    $fecha_inicio      = date('Y-m-d H:i:s', strtotime($p. " " . $hora_Inicio )); 
  
    $f_fin             = $_REQUEST['fecha_fin']; 
    $fecha_fin         = date('Y-m-d H:i:s', strtotime($p . ' ' . $hora_Fin)); 
  
    $UpdateEven = 
      ("SELECT * FROM asignacion_instructor 
      WHERE (nDocInstructor=$nDoc)
      AND
      (fecha_inicio <= '$fecha_fin' AND fecha_fin >= '$fecha_inicio')");
      $resultEven = mysqli_query($con, $UpdateEven);
      $contador = $resultEven->num_rows ;
  
      if($i == 0){
        $i = $contador;
      }
      if($contador > 0){
        if($iT == ""){
          $iT = $p;
        }else{
          $iT = $iT . " - " . $p;
        }
        
      }
  
    $UpdateEven2 = 
      ("SELECT * FROM asignacion_instructor 
        WHERE (nom_titulacion=$nTitulacion)
        AND
        (fecha_inicio <= '$fecha_fin' AND fecha_fin >= '$fecha_inicio')");
  
    $resultEven2 = mysqli_query($con, $UpdateEven2);
    $contador2 = $resultEven2->num_rows ;
  
    if($j == 0){
      $j = $contador2;
    }
    
    if($contador2 > 0){
      if($jT == ""){
        $jT= $p;
      }else{
        $jT= $jT . " - " . $p;
      }
    }
  
  }
  
  
    if($i > 0){
      header("Location:calendarioCursos.php?eD=" . $iT);
    }else{
      if($j > 0){
        header("Location:calendarioCursos.php?eE=" . $jT);
      }else{
        if($hora_Fin > $hora_Inicio){
          $InsertNuevoEvento = "INSERT INTO asignacion_instructor(
            nDocInstructor,
            nivel,
            nom_titulacion,
            tipocompetencia,
            competencia,
            color_evento,
            fecha_inicio,
            fecha_fin,
            fechaAsignacion,
            nDocRegistradoPor,
            rubro,
            id_ambiente
          )
          VALUES (
            $nDoc,
            $nivel,
            $nTitulacion,
            $tCompetencia,
            $Competencia,
            '" .$color_evento. "',
            '". $fecha_inicio."',
            '" .$fecha_fin. "',
            '$fechaProgramacion',
            $registrador,
            $rubro,
            $ambiente
          )";
          $resultadoNuevoEvento = mysqli_query($con, $InsertNuevoEvento);
          
          header("Location:calendarioCursos.php?e=1");  
        }else{
          header("Location:calendario.php?eHora=1");
        }
      
      }
    }

}






?>