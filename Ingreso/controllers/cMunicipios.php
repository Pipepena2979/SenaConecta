<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
	// Si no está iniciada, la iniciamos
	session_start();
} 

include('../models/mconsultas.php');
$consulta= new Consultas();


if(isset($_POST['rol'])){
	//echo json_encode("ura en ajax_municipios con id de ".$_POST['id']);
	$id=$_POST['rol'];
	$municipio = $consulta->get_supervisor($id);
	$i = 0;

	date_default_timezone_set("America/Bogota");
    $fecha = date("Y-m-d");

	if(count($municipio) > 0){
		foreach($municipio AS $m){
			if($m['fechaFinContrato'] > $fecha && $m['estado'] == 1){
				$i = 1;
			}
			
		}
		if($i > 0){
		
				$html="<option disabled selected>Selecciona una opción</option>";  
				foreach($municipio as $m){
					if($m['fechaFinContrato'] > $fecha && $m['estado'] == 1){
						$html.="<option value=".$m['num_doc']." >".$m['nombres']. " " .$m['apellidos']."</option>";
					}
				}
			
		}else{
			$html="<option value='' disabled selected>No hay usuarios registrados con el tipo de rol seleccionado, por favor registralos</option>";
		}	
	}else{
		$html="<option value='' disabled selected>No hay usuarios registrados con el tipo de rol seleccionado, por favor registralos</option>";  
	}
	

	$row=array(
		'municipio'=>$html
	);
	
	if(is_array($row)){
		echo json_encode($row);
	}
}


if(isset($_POST['eRol'])){
	//echo json_encode("ura en ajax_municipios con id de ".$_POST['id']);
	$id=$_POST['eRol'];
	$municipio = $consulta->get_supervisor($id);
	$i = 0;
	$j = 0;
	date_default_timezone_set("America/Bogota");
    $fecha = date("Y-m-d");
	$nDoc =$_SESSION['usuarios'][0]['num_doc'];
	if(count($municipio) > 0){
		foreach($municipio AS $m){
			if($m['fechaFinContrato'] > $fecha && $m['estado'] == 1){
				$i = 1;
			}
			if($m['num_doc'] != $nDoc){
				$j =1;
			}
		}
		if($i > 0){
			if($j > 0 ){
				$html="<option disabled selected>Selecciona una opción</option>";  
				foreach($municipio as $m){
					if($m['fechaFinContrato'] > $fecha && $m['estado'] == 1){
						if($m['num_doc'] != $nDoc){
							$html.="<option value=".$m['num_doc']." >".$m['nombres']. " " .$m['apellidos']."</option>";
						}
						
					}
				}
			}else{
				$html="<option value='' disabled selected>No hay mas usuarios registrados con el tipo de rol seleccionado, por favor registralos</option>";
			}
		}else{
			$html="<option value='' disabled selected>No hay usuarios registrados con el tipo de rol seleccionado, por favor registralos</option>";
		}	
	}else{
		$html="<option value='' disabled selected>No hay usuarios registrados con el tipo de rol seleccionado, por favor registralos</option>";  
	}
	

	$row=array(
		'municipio'=>$html
	);
	
	if(is_array($row)){
		echo json_encode($row);
	}
}

if(isset($_POST['id'])){
	// echo json_encode("ura en ajax_municipios con id de ".$_POST['id']);
	$id=$_POST['id'];
	$municipio = $consulta->get_muni($id);
	$html="<option value='' disabled selected>Selecciona una opción</option>";  
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