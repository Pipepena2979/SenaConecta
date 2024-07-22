<?php
include('../models/mconsultas.php');
$consulta= new Consultas();
if(isset($_POST['id'])){
	// echo json_encode("ura en ajax_municipios con id de ".$_POST['id']);
	$id=$_POST['id'];
	$municipio = $consulta->get_muni2($id);
	$html="<option>Selecciona una opción</option>";  
	foreach($municipio as $m){
		$html.="<option value=".$m['id'].">".$m['Nom_municipio']."</option>";
	}

	$row=array(
		'municipio'=>$html
	);
	
	if(is_array($row)){
		echo json_encode($row);
	}
}
?>