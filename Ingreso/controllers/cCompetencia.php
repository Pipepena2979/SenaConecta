<?php
include('../models/mconsultas.php');
$consulta= new Consultas();


if(isset($_POST['id'])){
	// echo json_encode("ura en ajax_municipios con id de ".$_POST['id']);
	$id=$_POST['id'];
	$municipio = $consulta->get_compe($id);

	if(count($municipio) > 0){
		$html="<option disabled selected>Selecciona una opción</option>";  
		foreach($municipio as $m){
			$html.="<option value=".$m['cod_competencia']." >".$m['nom_competencia']."</option>";
		}
	}else{
		$html="<option value='' disabled selected>No hay competencias registradas del tipo seleccionado, por favor registralas</option>";  
	}
	

	$row=array(
		'municipio'=>$html
	);
	
	if(is_array($row)){
		echo json_encode($row);
	}
}
?>