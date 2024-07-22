<?php
date_default_timezone_set("America/Bogota");
setlocale(LC_ALL,"es_ES");

include('config.php');
                        
$idEvento         = $_POST['idEvento'];
$enDoc          = $_REQUEST['enDoc'];
$rubro          = $_REQUEST['enrubro'];
$enivel          = $_REQUEST['enivel'];
$enTitulacion          = $_REQUEST['enTitulacion'];
$etCompetencia          = $_REQUEST['etCompetencia'];
$eCompetencia = $_REQUEST['eCompetencia'];
$eambiente = $_REQUEST['eambiente'];


$f_inicio          = $_REQUEST['efecha_asignacion'];
$ehora_Inicio          = $_REQUEST['ehora_Inicio'];
$fecha_inicio      = date('Y-m-d H:i:s', strtotime($f_inicio. " " . $ehora_Inicio )); 

$f_fin             = $_REQUEST['efecha_asignacion']; 
$ehora_Fin          = $_REQUEST['ehora_Fin'];
$fecha_fin         = date('Y-m-d H:i:s', strtotime($f_fin . ' ' . $ehora_Fin)); 

switch ($etCompetencia) {
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

  $UpdateEven1 = ("SELECT * FROM asignacion_instructor 
    WHERE (nDocInstructor=$enDoc AND id!=$idEvento)
    AND
    (fecha_inicio <= '$fecha_fin' AND fecha_fin >= '$fecha_inicio')");

    $resultEven1 = mysqli_query($con, $UpdateEven1);

    $contador = $resultEven1->num_rows;

    $UpdateEven2 = 
    ("SELECT * FROM asignacion_instructor 
        WHERE (nom_titulacion=$enTitulacion AND id!=$idEvento)
        AND
        (fecha_inicio <= '$fecha_fin' AND fecha_fin >= '$fecha_inicio')");

    $resultEven2 = mysqli_query($con, $UpdateEven2);

    $contador2 = $resultEven2->num_rows ;

    if($contador > 0){
        header("Location:calendario.php?eD=1");
    }elseif($contador == 0){

        if($contador2 > 0){
            header("Location:calendario.php?eE=1");
        }elseif($contador2 == 0){
            if($ehora_Fin > $ehora_Inicio){
                $UpdateProd = ("UPDATE asignacion_instructor
                SET 
                    nDocInstructor = $enDoc,
                    nivel= $enivel,
                    nom_titulacion=$enTitulacion,
                    tipocompetencia= $etCompetencia,
                    competencia= $eCompetencia,
                    fecha_inicio ='$fecha_inicio',
                    fecha_fin ='$fecha_fin',
                    color_evento ='$color_evento',
                    rubro = $rubro,
                    id_ambiente= $eambiente
                WHERE id='".$idEvento."' ");
    
                $result = mysqli_query($con, $UpdateProd);
        
                header("Location:calendario.php?ea=1");
            }else{
                header("Location:calendario.php?eHora=1");
            }
        }
    }
?>