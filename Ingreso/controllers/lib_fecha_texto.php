<?php
 

function fechaATexto($fecha){
  $fecha_separada=explode("-", $fecha);

//   $dia= strtolower(numtoletras($fecha_separada[0]));
$dia= $fecha_separada[2];
  switch ($fecha_separada[1]) {
    
    case "01":
        $mes="Enero";
      break;
    case "02":
        $mes="Febrero";
      break;
    case "03":
        $mes="Marzo";
      break;
    case "04":
        $mes="Abril";
      break;
    case "05":
        $mes="Mayo";
      break;
    case "06":
        $mes="Junio";
      break;
    case "07":
        $mes="Julio";
      break;
    case "08":
        $mes="Agosto";
      break;
    case "09":
        $mes="Septiembre";
      break;
    case "10":
        $mes="Octubre";
      break;
    case "11":
        $mes="Noviembre";
      break;
    case "12":
        $mes="Diciembre";
      break;

    default:
      break;
  }
  
//   $anio= strtolower(numtoletras($fecha_separada[2]));
$anio=$fecha_separada[0];
  
  return "$dia $mes";
}
function fechaATexto2($fecha){
    $fecha_separada=explode("-", $fecha);
  
  //   $dia= strtolower(numtoletras($fecha_separada[0]));
  $dia= $fecha_separada[2];
    switch ($fecha_separada[1]) {
      
      case "01":
          $mes="Enero";
        break;
      case "02":
          $mes="Febrero";
        break;
      case "03":
          $mes="Marzo";
        break;
      case "04":
          $mes="Abril";
        break;
      case "05":
          $mes="Mayo";
        break;
      case "06":
          $mes="Junio";
        break;
      case "07":
          $mes="Julio";
        break;
      case "08":
          $mes="Agosto";
        break;
      case "09":
          $mes="Septiembre";
        break;
      case "10":
          $mes="Octubre";
        break;
      case "11":
          $mes="Noviembre";
        break;
      case "12":
          $mes="Diciembre";
        break;
  
      default:
        break;
    }
    
  //   $anio= strtolower(numtoletras($fecha_separada[2]));
  $anio=$fecha_separada[0];
    
    return "$dia de $mes del $anio";
}
function fechaATexto4($fecha){
  $fecha_separada=explode("-", $fecha);

//   $dia= strtolower(numtoletras($fecha_separada[0]));
$dia= $fecha_separada[2];
  switch ($fecha_separada[1]) {
    
    case "01":
        $mes="Enero";
      break;
    case "02":
        $mes="Febrero";
      break;
    case "03":
        $mes="Marzo";
      break;
    case "04":
        $mes="Abril";
      break;
    case "05":
        $mes="Mayo";
      break;
    case "06":
        $mes="Junio";
      break;
    case "07":
        $mes="Julio";
      break;
    case "08":
        $mes="Agosto";
      break;
    case "09":
        $mes="Septiembre";
      break;
    case "10":
        $mes="Octubre";
      break;
    case "11":
        $mes="Noviembre";
      break;
    case "12":
        $mes="Diciembre";
      break;

    default:
      break;
  }
  
//   $anio= strtolower(numtoletras($fecha_separada[2]));
$anio=$fecha_separada[0];
  
  return "$dia/$mes/$anio";
}
?>
