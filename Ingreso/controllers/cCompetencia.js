



$('#tipocompe').change(function(){
	let parametros = "id="+$('#tipocompe').val();
	console.log(parametros);
	$.ajax({
		data: parametros,
		url: '../controllers/cCompetencia.php',
		type: 'POST',
		beforeSend: function() { },
		dataType:"json",
		success:function(response){
			console.log(response);
			$('#compeasignada').html(response.municipio);
			$('#displayCompetencia').show();

		},
		error:function(){
			alert('ocurrio un Errorsito!!');
		}
	});
})


$('#etCompetencia').change(function(){
	let parametros = "id="+$('#etCompetencia').val();
	console.log(parametros);
	$.ajax({
		data: parametros,
		url: '../controllers/cCompetencia.php',
		type: 'POST',
		beforeSend: function() { },
		dataType:"json",
		success:function(response){
			console.log(response);
			$('#eCompetencia').html(response.municipio);
			$('#displayCompetencia').show();

		},
		error:function(){
			alert('ocurrio un Errorsito!!');
		}
	});
})
