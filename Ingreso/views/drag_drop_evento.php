<?php
date_default_timezone_set("America/Bogota");
setlocale(LC_ALL,"es_ES");

include('config.php');
                        
$idEvento         = $_POST['idEvento'];
$nDocIns = $_POST['nDocIns'];
$codT = $_POST['codT'];
$start            = $_REQUEST['start'];

$fechaRealizar     = date('Y-m-d', strtotime($start)); 

$fecha_inicio     = date('Y-m-d H:i:s', strtotime($start)); 
$end              = $_REQUEST['end']; 
$fecha_fin        = date('Y-m-d H:i:s', strtotime($end));  



$UpdateEven = 
("SELECT * FROM asignacion_instructor 
WHERE (nDocInstructor=$nDocIns AND id!=$idEvento)
AND
  (fecha_inicio <= '$fecha_fin' AND fecha_fin >= '$fecha_inicio')");

$resultEven = mysqli_query($con, $UpdateEven);

$contador = $resultEven->num_rows ;

$UpdateEven2 = 
("SELECT * FROM asignacion_instructor 
WHERE (nom_titulacion=$codT AND id!=$idEvento)
AND
(fecha_inicio <= '$fecha_fin' AND fecha_fin >= '$fecha_inicio')");

$resultEven2 = mysqli_query($con, $UpdateEven2);

$contador2 = $resultEven2->num_rows ;

// $prueba = mysqli_fetch_array($resultEven2);

if($contador > 0){
    echo json_encode($contador, JSON_UNESCAPED_UNICODE);
}else{
    if($contador2 > 0){
        echo json_encode($contador2, JSON_UNESCAPED_UNICODE);
    }else{
        $UpdateProd = ("UPDATE asignacion_instructor
        SET 
            fecha_inicio ='$fecha_inicio',
            fecha_fin ='$fecha_fin'
    
        WHERE id='".$idEvento."' ");
        $result = mysqli_query($con, $UpdateProd);
    }
}

?>