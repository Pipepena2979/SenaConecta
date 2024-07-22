<?php
include('../models/mconsultas.php');
$consulta= new Consultas();
if(isset($_POST['id'])){
	// echo json_encode("ura en ajax_municipios con id de ".$_POST['id']);
	$id=$_POST['id'];
	$municipio = $consulta->get_titulacion($id);
	$html="<option value='' disabled selected>Selecciona una opción</option>";  
	if(count($municipio) > 0){
		foreach($municipio as $m){
			$html.="<option value=".$m['codigo_prog'].">" . "Codigo " . $m['codigo_prog']. " - ". $m['denominacion_prog'] . " - Jornada " . $m['nombreJornada'] . "</option>";
		}
	}else{
		$html="<option value='' disabled selected>No hay titulaciones registradas del tipo seleccionado, por favor registralas</option>"; 
	}
	

	$row=array(
		'municipio'=>$html
	);
	
	if(is_array($row)){
		echo json_encode($row);
	}
}
?>